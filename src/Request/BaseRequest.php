<?php
/**
 * Created by PhpStorm.
 * User: zyuskin_en
 * Date: 26.12.14
 * Time: 18:35
 */

namespace It2k\TMApi\Request;

use It2k\TMApi\Response\BaseResponse;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class BaseRequest
 * Базовый шаблон
 *
 * @package It2k\TMApi\Request
 */
abstract class BaseRequest
{
    const ROOT_NAMESPACE = 'It2k\\TMApi';

    const METHOD_GET = 0;

    const METHOD_POST = 1;

    const REQUEST_OK          = 0;

    const REQUEST_TIMEOUT     = -1;

    const REQUEST_OTHER_ERROR = -2;


    /**
     * @var array
     */
    protected $options;

    /**
     * @var string
     */
    protected $apiVersion = '1.0';

    /**
     * @var string
     */
    protected $apiNamespace = 'common_api';

    /**
     * @var string
     */
    protected $apiMethod = '';
    /**
     * @var int
     */
    protected $method = self::METHOD_GET;

    /**
     * @var bool
     */
    protected $sendRequestParamsAsJson = false;

    /**
     * @var array
     */
    protected $requestParams = array();

    /**
     * @var array
     */
    protected $requestParamsRequired = array();

    /**
     * @var array
     */
    protected $requestParamsExists = array();

    /**
     * @var
     */
    protected $response;

    /**
     * @var string
     */
    protected $responseClass = '';

    /**
     * @var
     */
    protected $statusCode;

    /**
     * @var string
     */
    protected $externalStatus = '';

    /**
     * @var array|string
     */
    protected $requestData;

    /**
     * @var array
     */
    protected $errorMessages = array(
        self::REQUEST_OK            => 'OK',
        self::REQUEST_TIMEOUT       => 'Истекло время ожидания ответа',
        self::REQUEST_OTHER_ERROR   => 'Ошибка во время исполнения запроса'
    );

    /**
     * Конструктор
     * @param array $options
     */
    public function __construct(array $options = array())
    {
        $resolver = new OptionsResolver();
        $resolver->setDefaults(array(
            'schema' => 'https',
            'ip' => '127.0.0.1',
            'port' => 8089,
            'timeout' => 10,
            'curl_debug' => false,
        ));

        $resolver->setRequired(array('secret_key', 'ip', 'port'));

        $this->options = $resolver->resolve($options);

        if (!$this->responseClass) {
            $className = $this->get_class_name();
            $this->responseClass = 'BaseResponse';

            if (class_exists(self::ROOT_NAMESPACE . '\\Response\\' . $className)) {
                $this->responseClass = $className;
            }
        }
    }

    /**
     * Отослать в API запрос с данными
     * @param string $requestData данные, передаваемые в API
     */
    private function sendRequest($requestData)
    {
        $ch = curl_init();
        if ($this->method == self::METHOD_POST) {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $requestData);
            curl_setopt($ch, CURLOPT_URL, $this->getUri());

        } else {
            curl_setopt($ch, CURLOPT_POST, false);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
            curl_setopt($ch, CURLOPT_URL, $this->getUri() . '?' . $requestData);
        }
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, $this->options['timeout']);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        if ($this->options['curl_debug']) {
            curl_setopt($ch, CURLOPT_VERBOSE, 1);
        }
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Signature: ' .  $this->generateSignature($requestData),
            'Content-Type: '. (($this->sendRequestParamsAsJson) ? 'application/json' : 'application/x-www-form-urlencode'),
        ));

        $this->response = curl_exec($ch);

        if ($this->options['curl_debug']) {
            print "Request: " . $requestData . "\n";
            print "Response: " . $this->response . "\n";
        }

        $errorCode = curl_errno($ch);

        switch($errorCode) {
            case CURLE_OK:
                $this->statusCode = self::REQUEST_OK;
                break;
            case CURLE_OPERATION_TIMEOUTED:
                $this->statusCode = self::REQUEST_TIMEOUT;
                break;
            default:
                $this->statusCode = self::REQUEST_OTHER_ERROR;
                $this->externalStatus = " curl: {$errorCode}";
                break;
        }

        curl_close($ch);
    }

    /**
     * Формирует запрос и отправляет его на сервер
     * @param array $params
     */
    public function send(array $params)
    {
        $resolver = new OptionsResolver();
        //$resolver->setDefined() Optional($this->requestParamsExists);
        foreach ($this->requestParamsExists as $param) {
            $resolver->setDefault($param, null);
        }
        $resolver->setRequired($this->requestParamsRequired);

        if ($this->sendRequestParamsAsJson) {
            $this->requestData = json_encode($resolver->resolve($params));
        } else {
            $this->requestData = http_build_query($resolver->resolve($params));
        }

        $this->sendRequest($this->requestData);
    }

    /**
     * Сформировать адрес для запроса api
     * @return string
     * @throws \Exception
     */
    private function getUri()
    {
        if ($this->apiMethod == '') {
            throw new \Exception('Api method not set');
        }

        return "{$this->options['schema']}://{$this->options['ip']}:{$this->options['port']}/{$this->apiNamespace}/{$this->apiVersion}/{$this->apiMethod}";
    }

    /**
     * Обернуть ответ API в класс
     * @return BaseResponse
     */
    public function getResponse()
    {
        $responseClassName = self::ROOT_NAMESPACE . '\\Response\\' . $this->responseClass;

        return new $responseClassName($this->response);
    }

    /**
     * Сформировать подпись запроса
     *
     * @param string $requestData данные, передаваемые в API
     *
     * @return string
     */
    private function generateSignature($requestData)
    {
        return md5($requestData . $this->options['secret_key']);
    }

    /**
     * Получить числовой статус запроса
     * @return mixed
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * Получить текстовое описание статуса запроса
     * @return string
     */
    public function getStatusMessage()
    {
        return $this->errorMessages[$this->statusCode] . ($this->statusCode == self::REQUEST_OTHER_ERROR ? $this->externalStatus : "");
    }

    /**
     * Успешно ли выполнен запрос
     * @return bool
     */
    public function isSuccessful()
    {
        return $this->statusCode == self::REQUEST_OK;
    }

    /**
     * Получить данные, передаваемые API в виде строки
     * @return mixed
     */
    public function getRequestData()
    {
        return $this->requestData;
    }

    /**
     * Возвращает имя класса без учета пространства имен
     *
     * @param object|string $object
     *
     * @return string
     */
    private function get_class_name($object = null)
    {
        if (!$object) {
            $object = $this;
        }

        if (!is_object($object) && !is_string($object)) {
            return false;
        }

        $class = explode('\\', (is_string($object) ? $object : get_class($object)));

        return $class[count($class) - 1];
    }
}