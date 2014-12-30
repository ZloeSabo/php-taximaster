<?php
/**
 * Created by PhpStorm.
 * User: zyuskin_en
 * Date: 29.12.14
 * Time: 11:10
 */

namespace It2k\TMApi\Response;


/**
 * Class CheckAuthorization
 *
 * @package It2k\TMApi\Response
 */
class CheckAuthorization extends BaseResponse
{
    const TMWEB_WRONG_LOGIN_OR_PASSWORD = 100;

    protected $additionalErrorMessages =  array(
        self::TMWEB_WRONG_LOGIN_OR_PASSWORD => 'Не найден клиент с логином LOGIN и/или неверный пароль',
    );
}