<?php
/**
 * Created by PhpStorm.
 * User: zyuskin_en
 * Date: 27.12.14
 * Time: 12:53
 *
 * http://help.taximaster.ru/index.php/TM_API#.D0.97.D0.B0.D0.BF.D1.80.D0.BE.D1.81_.D1.82.D0.B5.D0.BA.D1.83.D1.89.D0.B8.D1.85_.D0.B7.D0.B0.D0.BA.D0.B0.D0.B7.D0.BE.D0.B2
 *
 * Запрос текущих заказов
 */

namespace It2k\TMApi\Request;


/**
 * Class GetCurrentOrders
 *
 * @package It2k\TMApi\Request
 */
class GetCurrentOrders extends BaseRequest
{
    protected $apiMethod = 'get_current_orders';

    protected $requestParamsRequired = array('client_id');

    protected $requestParamsExists = array('phone');
}