<?php
/**
 * Created by PhpStorm.
 * User: zyuskin_en
 * Date: 27.12.14
 * Time: 12:53
 *
 * http://help.taximaster.ru/index.php/TM_API#.D0.97.D0.B0.D0.BF.D1.80.D0.BE.D1.81_.D0.B8.D0.BD.D1.84.D0.BE.D1.80.D0.BC.D0.B0.D1.86.D0.B8.D0.B8_.D0.BF.D0.BE_.D0.BA.D0.BB.D0.B8.D0.B5.D0.BD.D1.82.D1.83
 *
 * Изменение информации по клиенту
 */

namespace It2k\TMApi\Request;


/**
 * Class UpdateClientInfo
 *
 * @package It2k\TMApi\Request
 */
class UpdateClientInfo extends BaseRequest
{
    protected $method = self::METHOD_POST;

    protected $apiMethod = 'update_client_info';

    protected $requestParamsRequired = array('client_id');

    protected $requestParamsExists = array('name', 'login', 'password', 'phones', 'address', 'birthday', 'gender');
}