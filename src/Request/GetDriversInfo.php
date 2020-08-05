<?php
/**
 * Created by PhpStorm.
 * User: zyuskin_en
 * Date: 27.12.14
 * Time: 12:53
 *
 * http://help.taximaster.ru/index.php/TM_API#.D0.97.D0.B0.D0.BF.D1.80.D0.BE.D1.81_.D0.B8.D0.BD.D1.84.D0.BE.D1.80.D0.BC.D0.B0.D1.86.D0.B8.D0.B8_.D0.BE_.D0.B2.D0.BE.D0.B4.D0.B8.D1.82.D0.B5.D0.BB.D0.B5
 *
 * Запрос информации о водителе
 */

namespace It2k\TMApi\Request;


/**
 * Class GetDriversInfo
 *
 * @package It2k\TMApi\Request
 */
class GetDriversInfo extends BaseRequest
{
    protected $apiMethod = 'get_drivers_info';

    protected $requestParamsRequired = array();

    protected $requestParamsExists = array('locked_drivers', 'dismissed_drivers');
}