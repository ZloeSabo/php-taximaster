<?php
/**
 * Created by PhpStorm.
 * User: zyuskin_en
 * Date: 27.12.14
 * Time: 12:53
 *
 * http://help.taximaster.ru/index.php/TM_API#.D0.97.D0.B0.D0.BF.D1.80.D0.BE.D1.81_.D0.B2.D1.8B.D0.BF.D0.BE.D0.BB.D0.BD.D0.B5.D0.BD.D0.BD.D1.8B.D1.85_.D0.B7.D0.B0.D0.BA.D0.B0.D0.B7.D0.BE.D0.B2
 *
 * Запрос выполненных заказов
 */

namespace It2k\TMApi\Request;


/**
 * Class GetFinishedOrders
 *
 * @package It2k\TMApi\Request
 */
class GetFinishedOrders extends BaseRequest
{
    protected $apiMethod = 'get_finished_orders';

    protected $requestParamsRequired = array('client_id', 'phone', 'start_time', 'finish_time');

    protected $requestParamsExists = array();
}