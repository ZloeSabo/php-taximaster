<?php
/**
 * Created by PhpStorm.
 * User: zyuskin_en
 * Date: 27.12.14
 * Time: 12:53
 *
 * http://help.taximaster.ru/index.php/TM_API#.D0.97.D0.B0.D0.B4.D0.B0.D0.BD.D0.B8.D0.B5_.D0.BA.D0.BE.D0.BE.D1.80.D0.B4.D0.B8.D0.BD.D0.B0.D1.82_.D1.8D.D0.BA.D0.B8.D0.BF.D0.B0.D0.B6.D0.B5.D0.B9
 */

namespace It2k\TMApi\Request;



/**
 * Class SetCrewsCoords
 * Задание координат экипажей
 *
 * @package It2k\TMApi\Request
 */
class SetCrewsCoords extends BaseRequest
{
    protected $apiMethod = 'set_crews_coords';

    protected $sendRequestParamsAsJson = true;

    protected $requestParamsRequired = array('crew_coords');
}