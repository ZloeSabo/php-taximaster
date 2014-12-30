<?php
/**
 * Created by PhpStorm.
 * User: zyuskin_en
 * Date: 27.12.14
 * Time: 12:53
 *
 * http://help.taximaster.ru/index.php/TM_API#.D0.98.D0.B7.D0.BC.D0.B5.D0.BD.D0.B5.D0.BD.D0.B8.D0.B5_.D1.81.D0.BE.D1.81.D1.82.D0.BE.D1.8F.D0.BD.D0.B8.D1.8F_.D0.B7.D0.B0.D0.BA.D0.B0.D0.B7.D0.B0
 *
 * Изменение состояния заказа
 */

namespace It2k\TMApi\Request;


/**
 * Class ChangeOrderState
 *
 * @package It2k\TMApi\Request
 */
class ChangeOrderState extends BaseRequest
{
    //protected $method = self::METHOD_POST;

    protected $apiMethod = 'change_order_state';

    protected $requestParamsRequired = array('order_id', 'new_state');

    protected $requestParamsExists = array();
}