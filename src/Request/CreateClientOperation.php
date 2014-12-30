<?php
/**
 * Created by PhpStorm.
 * User: zyuskin_en
 * Date: 27.12.14
 * Time: 12:53
 *
 * http://help.taximaster.ru/index.php/TM_API#.D0.9F.D1.80.D0.BE.D0.B2.D0.B5.D0.B4.D0.B5.D0.BD.D0.B8.D0.B5_.D0.BE.D0.BF.D0.B5.D1.80.D0.B0.D1.86.D0.B8.D0.B8_.D0.BF.D0.BE_.D0.BA.D0.BB.D0.B8.D0.B5.D0.BD.D1.82.D1.83
 *
 * Проведение операции по клиенту
 */

namespace It2k\TMApi\Request;


/**
 * Class CreateClientOperation
 *
 * @package It2k\TMApi\Request
 */
class CreateClientOperation extends BaseRequest
{
    protected $apiMethod = 'create_client_operation';

    protected $requestParamsRequired = array('client_id', 'oper_time', 'sum', 'oper_type', 'pay_type');

    protected $requestParamsExists = array('comment');
}