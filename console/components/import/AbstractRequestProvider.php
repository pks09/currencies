<?php
namespace console\components\import;

use yii\httpclient\Client;
use yii\httpclient\Exception;
use Yii;

abstract class AbstractRequestProvider implements ProviderInterface
{
    public $headers;
    protected $url;

    /**
     * Преобразует полученные "сырые" данные к массив массивов с ключами, совпадающими с
     * полями соответствующей таблицы БД
     * @param string $rawData
     * @return array
     */
    abstract protected function parseData($rawData);

    function __construct($url)
    {
        $this->url = $url;
        $this->headers = Yii::$app->params['requestProvidersHeaders'];
    }

    /*
     * Возвращает массив массивов с ключами, совпадающими с
     * полями соответствующей таблицы БД
     */
    public function getData(): array
    {
        $rawData = $this->request($this->url);
        return $this->parseData($rawData);
    }

    /*
     * Возвращает результат http запроса
     * @param string $url адрес запроса
     * @param string[] $params параметры запроса
     * @param string $method метод запроса
     * @param string $transport экземпляр или название класса, наследника от yii\httpclient\Transport
     */
    protected function request($url, $params = [], $method = 'get', $transport = 'yii\httpclient\CurlTransport'): string
    {
        $client = new Client();
        $client->setTransport($transport);
        $response = $client->createRequest()
            ->addHeaders($this->headers)
            ->setMethod($method)
            ->setUrl($url)
            ->setData($params)
            ->send()
        ;
        if (!$response->isOk) {
            throw new Exception('Request error: ' . $response->getStatusCode());
        }

        return $response->getContent();
    }

}