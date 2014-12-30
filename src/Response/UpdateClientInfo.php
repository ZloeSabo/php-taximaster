<?php
/**
 * Created by PhpStorm.
 * User: zyuskin_en
 * Date: 29.12.14
 * Time: 11:10
 */

namespace It2k\TMApi\Response;

/**
 * Class UpdateClientInfo
 *
 * @package It2k\TMApi\Response
 */
class UpdateClientInfo extends BaseResponse
{
    const TMWEB_PHONE_ALREADY_EXISTS  = 100;
    const TMWEB_PHONE_ALREADY_EXISTS2 = 101;
    const TMWEB_LOGIN_ALREADY_EXISTS  = 102;

    protected $additionalErrorMessages =  array(
        self::TMWEB_PHONE_ALREADY_EXISTS  => 'Клиент с номером телефона=PHONE уже существует',
        self::TMWEB_PHONE_ALREADY_EXISTS2 => 'Клиент с ИД=ID имеет такой же номер телефона=PHONE',
        self::TMWEB_LOGIN_ALREADY_EXISTS  => 'Клиент с логином=LOGIN уже существует',
    );
}