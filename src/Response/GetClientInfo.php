<?php
/**
 * Created by PhpStorm.
 * User: zyuskin_en
 * Date: 29.12.14
 * Time: 11:10
 */

namespace It2k\TMApi\Response;

/**
 * Class GetClientInfo
 *
 * @package It2k\TMApi\Response
 */
class GetClientInfo extends BaseResponse
{
    const TMWEB_CLIENT_NOT_FOUND = 100;

    protected $additionalErrorMessages =  array(
        self::TMWEB_CLIENT_NOT_FOUND => 'Не найден клиент ИД=CLIENT_ID',
    );
}