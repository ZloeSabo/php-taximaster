<?php

class CreateOrderRequest extends TMWebApiRequest {
    protected $request_params = array();
    protected $api_method = 'create_order';
    private $required = array('phone', 'source', 'source_time');

    const REQUEST_MISSING_PARAM = -3;

    /**
     * {@inheritdoc}
     */
    public function __construct($ip, $port, $secret)
    {
        $this->error_messages = $this->error_messages + array(
            self::REQUEST_MISSING_PARAM        => 'Отсутствует обязательный параметр'
        );

        parent::__construct($ip, $port, $secret);
        $this->request_params['source_time'] = date('YmdHis');
        $this->request_params['comment'] = '/Веб-заказ/';
    }

    /**
     * Установить номер телефона заказа
     * @param $number
     * @return CreateOrderRequest
     */
    public function setPhone($number)
    {
        $this->request_params['phone'] = $number;

        return $this;
    }

    /**
     * Установить адрес подачи
     * @param $address
     * @return CreateOrderRequest
     */
    public function setSource($address)
    {
        $this->request_params['source'] = $address;

        return $this;
    }

    /**
     * Установить адрес назначения
     * @param $destination
     * @return CreateOrderRequest
     */
    public function setDest($destination)
    {
        $this->request_params['dest'] = $destination;

        return $this;
    }

    /**
     * Установить заказчика
     * @param $customer
     * @return CreateOrderRequest
     */
    public function setCustomer($customer)
    {
        $this->request_params['dest'] = $customer;

        return $this;
    }

    /**
     * Установить комментарий к заказу
     * @param $comment
     * @return CreateOrderRequest
     */
    public function setComment($comment)
    {
        $this->request_params['comment'] = '/Веб-заказ/ ' . $comment;

        return $this;
    }

    /**
     * Установить номер экипажа
     * @param $crewGroupId
     * @return CreateOrderRequest
     */
    public function setCrewGroupId($crewGroupId)
    {
        $this->request_params['crew_group_id'] = intval($crewGroupId);

        return $this;
    }

    /**
     * Установить номер службы ЭДС
     * @param $udsId
     * @return CreateOrderRequest
     */
    public function setUdsId($udsId)
    {
        $this->request_params['uds_id'] = intval($udsId);

        return $this;
    }

    /**
     * Отослать запрос на создание нового заказа
     * @return CreateOrderRequest
     */
    public function send()
    {
        foreach($this->required as $requiredParameter)
        {
            if(empty($this->request_params[$requiredParameter])) {
                $this->status_code = self::REQUEST_MISSING_PARAM;
                break;
            }
        }

        if($this->status_code != self::REQUEST_MISSING_PARAM) {
            $requestData = http_build_query($this->request_params);
            $this->request_data = $requestData;

            $this->sendPOSTRequest($this->api_method, $requestData);
        }

        return $this;
    }

    /**
     * {@inheritdoc}
     * @return CreateOrderResponse|TMWebApiResponse
     */
    public function getResponse()
    {
        return new CreateOrderResponse($this->response);
    }
}