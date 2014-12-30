<?php
/**
 * Created by PhpStorm.
 * User: zyuskin_en
 * Date: 27.12.14
 * Time: 15:31
 *
 * http://help.taximaster.ru/index.php/TM_API#.D0.97.D0.B0.D0.BF.D1.80.D0.BE.D1.81_.D1.81.D0.BF.D0.B8.D1.81.D0.BA.D0.B0_.D0.B3.D1.80.D1.83.D0.BF.D0.BF_.D1.8D.D0.BA.D0.B8.D0.BF.D0.B0.D0.B6.D0.B5.D0.B9
 *
 * Запрос списка групп экипажей
 */

namespace It2k\TMApi\Request;


/**
 * Class GetCrewGroupsList
 *
 * @package It2k\TMApi\Request
 */
class GetCrewGroupsList extends BaseRequest
{
    protected $apiMethod = 'get_crew_groups_list';
}