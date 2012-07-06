<?php

class CreateOrderResponse extends TMWebApiResponse {
    const TMWEB_ALREADY_EXISTS = 100;

    /**
     * {@inheritdoc}
     */
    public function __construct($responseString)
    {
        $this->error_messages = $this->error_messages + array(
            self::TMWEB_ALREADY_EXISTS  => 'Заказ с такими параметрами уже создан'
        );
    }
}