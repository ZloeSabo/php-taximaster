<?php
/**
 * Created by PhpStorm.
 * User: zyuskin_en
 * Date: 27.12.14
 * Time: 15:31
 *
 * http://help.taximaster.ru/index.php/TM_API#.D0.A0.D0.B0.D1.81.D1.87.D0.B5.D1.82_.D1.81.D1.83.D0.BC.D0.BC.D1.8B_.D0.B7.D0.B0.D0.BA.D0.B0.D0.B7.D0.B0
 *
 * Расчет суммы заказа
 */

namespace It2k\TMApi\Request;


/**
 * Class CalcOrderCost
 *
 * @package It2k\TMApi\Request
 */
class CalcOrderCost extends BaseRequest
{
    protected $apiMethod = 'calc_order_cost';

    protected $requestParamsRequired = array('tariff_id');

    protected $requestParamsExists = array(
        'tariff_id', 'source_time', 'is_prior', 'client_id', 'discount_id', 'disc_card_id', 'source_zone_id',
        'dest_zone_id', 'distance_city', 'distance_country', 'source_distance_country', 'is_country', 'waiting_minutes',
        'is_hourly', 'hourly_minutes', 'is_prize', 'back_way', 'services', 'order_params', 'cashless'
    );
}