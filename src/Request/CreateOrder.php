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
 * Class GetCreateOrder
 *
 * @package It2k\TMApi\Request
 */
class CreateOrder extends BaseRequest
{
    protected $method = self::METHOD_POST;

    protected $apiMethod = 'create_order';

    protected $requestParamsRequired = array('phone', 'source', 'source_time');

    protected $requestParamsExists = array(
        'dest', 'customer', 'comment', 'crew_group_id', 'uds_id', 'tariff_id', 'is_prior', 'source_lon', 'source_lat',
        'dest_lon', 'dest_lat'
    );
}