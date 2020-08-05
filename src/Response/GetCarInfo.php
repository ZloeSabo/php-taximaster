<?php
/**
 * Created by PhpStorm.
 * User: zyuskin_en
 * Date: 29.12.14
 * Time: 11:10
 */

namespace It2k\TMApi\Response;

/**
 * Class GetCarInfo
 *
 * @package It2k\TMApi\Response
 */
class GetCarInfo extends BaseResponse
{
    const TMWEB_CAR_NOT_FOUND = 100;

    protected $additionalErrorMessages =  array(
        self::TMWEB_CAR_NOT_FOUND => 'Автомобиль не найден',
    );
}