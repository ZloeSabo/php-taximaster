<?php
/**
 * Created by PhpStorm.
 * User: zyuskin_en
 * Date: 29.12.14
 * Time: 11:10
 */

namespace It2k\TMApi\Response;


/**
 * Class AnalyzeRoute
 *
 * @package It2k\TMApi\Response
 */
class AnalyzeRoute extends BaseResponse
{
    const TMWEB_SOURCE_ADDRESS_NOT_FOUND = 100;
    const TMWEB_DESTINATIONS_ADDRESS_NOT_FOUND   = 101;
    const TMWEB_ROUTE_NOT_FOND        = 102;

    protected $additionalErrorMessages =  array(
        self::TMWEB_SOURCE_ADDRESS_NOT_FOUND => 'Адрес подачи не распознан',
        self::TMWEB_DESTINATIONS_ADDRESS_NOT_FOUND   => 'Адрес назначения не распознан',
        self::TMWEB_ROUTE_NOT_FOND        => 'Маршрут не распознан',
    );
}