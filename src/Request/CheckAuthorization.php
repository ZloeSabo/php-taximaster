<?php
/**
 * Created by PhpStorm.
 * User: zyuskin_en
 * Date: 27.12.14
 * Time: 12:53
 *
 * http://help.taximaster.ru/index.php/TM_API#.D0.9F.D1.80.D0.BE.D0.B2.D0.B5.D1.80.D0.BA.D0.B0_.D0.B0.D0.B2.D1.82.D0.BE.D1.80.D0.B8.D0.B7.D0.B0.D1.86.D0.B8.D0.B8
 *
 * Проверка авторизации
 */

namespace It2k\TMApi\Request;


/**
 * Class CheckAuthorization
 *
 * @package It2k\TMApi\Request
 */
class CheckAuthorization extends BaseRequest
{
    protected $apiMethod = 'check_authorization';

    protected $requestParamsRequired = array('login', 'password');

    protected $requestParamsExists = array();
}