<?php
/**
 * Created by PhpStorm.
 * User: zyuskin_en
 * Date: 29.12.14
 * Time: 11:10
 */

namespace It2k\TMApi\Response;


/**
 * Class CreateDriverOperation
 *
 * @package It2k\TMApi\Response
 */
class CreateDriverOperation extends BaseResponse
{
    const TMWEB_DRIVER_NOT_FOUND = 100;

    protected $additionalErrorMessages =  array(
        self::TMWEB_DRIVER_NOT_FOUND => 'Водитель не найден ИД=DRIVER_ID',
    );
}