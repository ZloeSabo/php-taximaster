<?php
/**
 * Created by PhpStorm.
 * User: zyuskin_en
 * Date: 27.12.14
 * Time: 15:31
 *
 * http://help.taximaster.ru/index.php/TM_API#.D0.97.D0.B0.D0.BF.D1.80.D0.BE.D1.81_.D1.81.D0.BF.D0.B8.D1.81.D0.BA.D0.B0_.D1.81.D0.BB.D1.83.D0.B6.D0.B1_.D0.95.D0.94.D0.A1
 *
 * Запрос списка служб ЕДС
 */

namespace It2k\TMApi\Request;


/**
 * Class GetUdsList
 *
 * @package It2k\TMApi\Request
 */
class GetUdsList extends BaseRequest
{
    protected $apiMethod = 'get_uds_list';
}