<?php
/**
 * Created by PhpStorm.
 * User: zyuskin_en
 * Date: 27.12.14
 * Time: 12:53
 *
 * http://help.taximaster.ru/index.php/TM_API#.D0.90.D0.BD.D0.B0.D0.BB.D0.B8.D0.B7_.D0.BC.D0.B0.D1.80.D1.88.D1.80.D1.83.D1.82.D0.B0
 */

namespace It2k\TMApi\Request;

/**
 * Class AnalyzeRoute
 * Анализ маршрута
 *
 * @package It2k\TMApi\Request
 */
class AnalyzeRoute extends BaseRequest
{

    protected $apiMethod = 'analyze_route';

    protected $requestParamsRequired = array('source', 'dest');

    protected $requestParamsExists = array(
        'source_lon', 'source_lat', 'dest_lon', 'dest_lat'
    );
}