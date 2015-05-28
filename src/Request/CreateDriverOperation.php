<?php
/**
 * Created by PhpStorm.
 * User: zyuskin_en
 * Date: 27.12.14
 * Time: 12:53
 *
 * http://help.taximaster.ru/index.php/TM_API#.D0.A1.D0.BE.D0.B7.D0.B4.D0.B0.D0.BD.D0.B8.D0.B5_.D0.BD.D0.BE.D0.B2.D0.BE.D0.B3.D0.BE_.D0.B7.D0.B0.D0.BA.D0.B0.D0.B7.D0.B0
 *
 * Создание нового заказа
 */

namespace It2k\TMApi\Request;


/**
 * Class CreateDriverOperation
 *
 * @package It2k\TMApi\Request
 */
class CreateDriverOperation extends BaseRequest
{
    protected $method = self::METHOD_POST;

    protected $apiMethod = 'create_driver_operation';

    protected $requestParamsRequired = array('driver_id', 'oper_sum', 'oper_type');

    protected $requestParamsExists = array('name', 'oper_time', 'comment');
}