<?php

namespace console\components\import\currency;

use console\components\import\AbstractRequestProvider;
use console\components\import\UnexpectedXmlException;
use yii\base\InvalidParamException;
use Yii;
use yii\helpers\VarDumper;

class CbrProvider extends AbstractRequestProvider
{

    /**
     * @inheritdoc
     */
    protected function parseData($rawData): array
    {
        /** @var \SimpleXMLElement $xml */
        $xml = simplexml_load_string($rawData);
        if (!$xml) {
            throw new InvalidParamException('Invalid xml passed as a rawData parameter');
        }
        $result = [];
        foreach ($xml->children() as $item) {
            if (!isset($item->Value, $item->Nominal, $item->CharCode, $item->Name)) {
                throw new UnexpectedXmlException('Unexpected xml structure '.VarDumper::dumpAsString($item));
            }
            $nominal = (int)$item->Nominal;
            if (!($nominal > 0)) {
                Yii::warning('Incorrect Nominal value: '.VarDumper::dumpAsString($item), 'currency-import');
                continue;
            }
            $rate = str_replace(',', '.', (string)$item->Value);
            $rate = $rate / $nominal;
            $row = [
                'charCode' => (string)$item->CharCode,
                'name' => (string)$item->Name,
                'rate' => (float)$rate,
            ];
            $result[] = $row;
        }
        return $result;
    }
}



