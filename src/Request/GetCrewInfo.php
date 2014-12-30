<?php
/**
 * Created by PhpStorm.
 * User: zyuskin_en
 * Date: 27.12.14
 * Time: 12:53
 *
 * http://help.taximaster.ru/index.php/TM_API#.D0.97.D0.B0.D0.BF.D1.80.D0.BE.D1.81_.D0.B8.D0.BD.D1.84.D0.BE.D1.80.D0.BC.D0.B0.D1.86.D0.B8.D0.B8_.D0.BE.D0.B1_.D1.8D.D0.BA.D0.B8.D0.BF.D0.B0.D0.B6.D0.B5
 *
 * Запрос информации об экипаже
 */

namespace It2k\TMApi\Request;


/**
 * Class GetCrewInfo
 *
 * @package It2k\TMApi\Request
 */
class GetCrewInfo extends BaseRequest
{
    protected $apiMethod = 'get_crew_info';

    protected $requestParamsRequired = array('crew_id');

    protected $requestParamsExists = array();
}