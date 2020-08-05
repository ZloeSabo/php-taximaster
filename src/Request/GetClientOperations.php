<?php
/**
 * Created by PhpStorm.
 * User: zyuskin_en
 * Date: 27.12.14
 * Time: 12:53
 *
 * http://help.taximaster.ru/index.php/TM_API#.D0.97.D0.B0.D0.BF.D1.80.D0.BE.D1.81_.D0.BE.D0.BF.D0.B5.D1.80.D0.B0.D1.86.D0.B8.D0.B9_.D0.BF.D0.BE_.D0.BA.D0.BB.D0.B8.D0.B5.D0.BD.D1.82.D1.83
 */

namespace It2k\TMApi\Request;


/**
 * Class GetClientOperations
 * Запрос операций по клиенту
 *
 * @package It2k\TMApi\Request
 */
class GetClientOperations extends BaseRequest
{
    protected $apiMethod = 'get_client_operations';

    protected $requestParamsRequired = array('client_id', 'phone', 'start_time', 'finish_time');

    protected $requestParamsExists = array();
}