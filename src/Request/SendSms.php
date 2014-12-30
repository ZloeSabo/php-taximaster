<?php
/**
 * Created by PhpStorm.
 * User: zyuskin_en
 * Date: 27.12.14
 * Time: 12:53
 *
 * http://help.taximaster.ru/index.php/TM_API#.D0.A1.D0.BE.D0.B7.D0.B4.D0.B0.D0.BD.D0.B8.D0.B5_.D0.B7.D0.B0.D0.B4.D0.B0.D1.87.D0.B8_.D0.A1.D0.9C.D0.A1_.D1.81.D0.B5.D1.80.D0.B2.D0.B5.D1.80.D1.83
 *
 * Создание задачи СМС серверу
 */

namespace It2k\TMApi\Request;


/**
 * Class SendSms
 *
 * @package It2k\TMApi\Request
 */
class SendSms extends BaseRequest
{
    protected $apiMethod = 'send_sms';

    protected $requestParamsRequired = array('phone', 'message');

    protected $requestParamsExists = array();
}