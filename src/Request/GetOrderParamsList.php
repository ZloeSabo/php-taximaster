<?php
/**
 * Created by PhpStorm.
 * User: zyuskin_en
 * Date: 27.12.14
 * Time: 15:31
 *
 * http://help.taximaster.ru/index.php/TM_API#.D0.97.D0.B0.D0.BF.D1.80.D0.BE.D1.81_.D1.81.D0.BF.D0.B8.D1.81.D0.BA.D0.B0_.D0.BF.D0.B0.D1.80.D0.B0.D0.BC.D0.B5.D1.82.D1.80.D0.BE.D0.B2_.D0.B7.D0.B0.D0.BA.D0.B0.D0.B7.D0.B0
 *
 * Запрос списка параметров заказа
 */

namespace It2k\TMApi\Request;


/**
 * Class GetOrderParamsList
 *
 * @package It2k\TMApi\Request
 */
class GetOrderParamsList extends BaseRequest
{
    protected $apiMethod = 'get_order_params_list';
}