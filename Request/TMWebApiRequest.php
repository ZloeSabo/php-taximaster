<?php

class TMWebApiRequest {
    protected $schema = 'https';
    protected $ip;
    protected $port;
    protected $secret;
    protected $api_version = '1.0';
    protected $api_namespace = 'common_api';
    protected $response;

    protected $status_code;
    protected $external_status = '';
    protected $request_data;

    const REQUEST_OK            = 0;
    const REQUEST_TIMEOUT       = -1;
    const REQUEST_OTHER_ERROR   = -2;

    protected $error_messages = array(
        self::REQUEST_OK            => 'OK',
        self::REQUEST_TIMEOUT       => 'Истекло время ожидания ответа',
        self::REQUEST_OTHER_ERROR   => 'Ошибка во время исполнения запроса'
    );

    /**
     * Конструктор
     * @param $ip       адрес доступа к API
     * @param $port     порт доступа к API
     * @param $secret   секретный ключ клиента
     */
    public function __construct($ip, $port, $secret)
    {
        $this->ip = $ip;
        $this->port = $port;
        $this->secret = $secret;
    }

    /**
     * Отослать в API POST запрос с данными
     * @param $apiMethod                    вызываемый метод API
     * @param $requestData                  данные, передаваемые в API
     * @param string $additionalGETParams   дополнительные GET параметры
     */
    public function sendPOSTRequest($apiMethod, $requestData, $additionalGETParams = '')
    {
        $ch = curl_init($this->getUri($apiMethod) . $additionalGETParams);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $requestData);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Signature: ' . $this->generateSignature($requestData),
            'Content-Type: application/x-www-form-urlencode'
        ));

        $this->response = curl_exec($ch);

        $errorCode = curl_errno($ch);

        switch($errorCode) {
            case CURLE_OK:
                $this->status_code = self::REQUEST_OK;
                break;
            case CURLE_OPERATION_TIMEOUTED:
                $this->status_code = self::REQUEST_TIMEOUT;
                break;
            default:
                $this->status_code = self::REQUEST_OTHER_ERROR;
                $this->external_status = " curl: {$errorCode}";

                break;
        }

        curl_close($ch);
    }

    /**
     * Сформировать адрес для запроса api
     * @param $apiMethod    вызываемый метод API
     * @return string
     */
    private function getUri($apiMethod)
    {
        return "{$this->schema}://{$this->ip}:{$this->port}/{$this->api_namespace}/{$this->api_version}/{$apiMethod}";
    }

    /**
     * Обернуть ответ API в класс
     * @return TMWebApiResponse
     */
    public function getResponse()
    {
        return new TMWebApiResponse($this->response);
    }

    /**
     * Сформировать подпись запроса
     * @param $requestData  данные, передаваемые в API
     * @return string
     */
    private function generateSignature($requestData)
    {
        return md5($requestData . $this->secret);
    }

    /**
     * Получить числовой статус запроса
     * @return mixed
     */
    public function getStatusCode()
    {
        return $this->status_code;
    }

    /**
     * Получить текстовое описание статуса запроса
     * @return string
     */
    public function getStatusMessage()
    {
        return $this->error_messages[$this->status_code] . ($this->status_code == self::REQUEST_OTHER_ERROR ? $this->external_status : "");
    }

    /**
     * Успешно ли выполнен запрос
     * @return bool
     */
    public function isSucessful()
    {
        return $this->status_code == self::REQUEST_OK;
    }

    /**
     * Получить данные, передаваемые API в виде строки
     * @return mixed
     */
    public function getRequestData()
    {
        return $this->request_data;
    }
}