<?php
/**
 * Created by PhpStorm.
 * User: zyuskin_en
 * Date: 29.12.14
 * Time: 11:10
 */

namespace It2k\TMApi\Response;


/**
 * Class GetCrewInfo
 *
 * @package It2k\TMApi\Response
 */
class GetCrewInfo extends BaseResponse
{
    const TMWEB_CREW_NOT_FOUND = 100;

    protected $additionalErrorMessages =  array(
        self::TMWEB_CREW_NOT_FOUND => 'Экипаж не найден',
    );
}