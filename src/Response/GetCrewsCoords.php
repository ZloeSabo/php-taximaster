<?php
/**
 * Created by PhpStorm.
 * User: zyuskin_en
 * Date: 29.12.14
 * Time: 11:10
 */

namespace It2k\TMApi\Response;

/**
 * Class GetCrewsCoords
 *
 * @package It2k\TMApi\Response
 */
class GetCrewsCoords extends BaseResponse
{
    const TMWEB_COORDS_NOT_FOUND = 100;

    protected $additionalErrorMessages =  array(
        self::TMWEB_COORDS_NOT_FOUND => 'Координаты не найдены',
    );
}