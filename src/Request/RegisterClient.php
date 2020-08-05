<?php
/**
 * Created by PhpStorm.
 * User: zyuskin_en
 * Date: 27.12.14
 * Time: 12:53
 *
 * http://help.taximaster.ru/index.php/TM_API#.D0.A0.D0.B5.D0.B3.D0.B8.D1.81.D1.82.D1.80.D0.B0.D1.86.D0.B8.D1.8F_.D0.BA.D0.BB.D0.B8.D0.B5.D0.BD.D1.82.D0.B0
 *
 * Регистрация клиента
 */

namespace It2k\TMApi\Request;


/**
 * Class RegisterClient
 *
 * @package It2k\TMApi\Request
 */
class RegisterClient extends BaseRequest
{
    protected $apiMethod = 'register_client';

    protected $requestParamsRequired = array('name', 'login', 'password', 'phones');

    protected $requestParamsExists = array('address', 'birthday', 'gender');
}