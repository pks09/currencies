<?php
namespace console\components\import\currency;

use Yii;
use common\models\Currency;
use yii\helpers\VarDumper;
use console\components\import\ProviderInterface;

class Importer {

    protected $api;

    function __construct(ProviderInterface $api)
    {
        $this->api = $api;
    }

    /**
     * Запускает процесс импорта. Полученные данные сохраняются в базу данных
     */
    public function run()
    {
        /** @var mixed $data */
        $data = $this->api->getData();
        /** @var string[] $codes */
        $codes = array_column($data, 'charCode');
        /** @var Currency[] $models */
        $models = Currency::find()->where(['charCode' => $codes])->indexBy('charCode')->all();
        foreach ($data as $row) {
            $model = $models[$row['charCode']] ?? new Currency();
            $model->load($row, '');
            if (!$model->save()) {
                Yii::warning("Currency saving error: "
                    . VarDumper::dumpAsString($model->getErrors())
                    . '. Raw data: ' . VarDumper::dumpAsString($row), 'currency-import');
            }
        }
    }
}