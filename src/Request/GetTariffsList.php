<?php
/**
 * Created by PhpStorm.
 * User: zyuskin_en
 * Date: 27.12.14
 * Time: 15:31
 *
 * http://help.taximaster.ru/index.php/TM_API#.D0.97.D0.B0.D0.BF.D1.80.D0.BE.D1.81_.D1.81.D0.BF.D0.B8.D1.81.D0.BA.D0.B0_.D1.82.D0.B0.D1.80.D0.B8.D1.84.D0.BE.D0.B2
 *
 * Запрос списка тарифов
 */

namespace It2k\TMApi\Request;


/**
 * Class GetTariffsList
 *
 * @package It2k\TMApi\Request
 */
class GetTariffsList extends BaseRequest
{
    protected $apiMethod = 'get_tariffs_list';
}