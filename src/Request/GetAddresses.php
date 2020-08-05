<?php
/**
 * Created by PhpStorm.
 * User: zyuskin_en
 * Date: 27.12.14
 * Time: 12:53
 *
 * http://help.taximaster.ru/index.php/TM_API#.D0.97.D0.B0.D0.BF.D1.80.D0.BE.D1.81_.D0.B0.D0.B4.D1.80.D0.B5.D1.81.D0.BE.D0.B2.2C_.D1.81.D0.BE.D0.B4.D0.B5.D1.80.D0.B6.D0.B0.D1.89.D0.B8.D1.85_.D0.BD.D1.83.D0.B6.D0.BD.D1.83.D1.8E_.D1.81.D1.82.D1.80.D0.BE.D0.BA.D1.83
 *
 * Запрос адресов, содержащих нужную строку
 */

namespace It2k\TMApi\Request;


/**
 * Class GetAddresses
 *
 * @package It2k\TMApi\Request
 */
class GetAddresses extends BaseRequest
{
    protected $apiMethod = 'get_addresses_like';

    protected $requestParamsRequired = array('get_streets', 'get_houses', 'get_points', 'street');

    protected $requestParamsExists = array('house', 'max_addresses_count');
}