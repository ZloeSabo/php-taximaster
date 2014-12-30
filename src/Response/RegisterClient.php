<?php
/**
 * Created by PhpStorm.
 * User: zyuskin_en
 * Date: 29.12.14
 * Time: 11:10
 */

namespace It2k\TMApi\Response;

/**
 * Class RegisterClient
 *
 * @package It2k\TMApi\Response
 */
class RegisterClient extends BaseResponse
{
    const TMWEB_PHONE_ALREADY_EXISTS = 100;
    const TMWEB_LOGIN_ALREADY_EXISTS = 101;

    protected $additionalErrorMessages =  array(
        self::TMWEB_PHONE_ALREADY_EXISTS => 'Клиент с ИД=ID имеет такой же номер телефона=PHONE',
        self::TMWEB_LOGIN_ALREADY_EXISTS => 'Клиент с логином=LOGIN уже существует',
    );
}