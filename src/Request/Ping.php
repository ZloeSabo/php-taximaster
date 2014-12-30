<?php
/**
 * Created by PhpStorm.
 * User: zyuskin_en
 * Date: 27.12.14
 * Time: 14:49
 *
 * http://help.taximaster.ru/index.php/TM_API#.D0.97.D0.B0.D0.BF.D1.80.D0.BE.D1.81-.D0.BF.D0.B8.D0.BD.D0.B3
 *
 * Запрос-пинг
 */

namespace It2k\TMApi\Request;


/**
 * Class Ping
 *
 * @package It2k\TMApi\Request
 */
class Ping extends BaseRequest
{
    /**
     * @var string
     */
    protected $apiMethod = 'ping';
} 