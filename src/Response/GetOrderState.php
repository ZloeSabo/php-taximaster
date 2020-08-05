<?php
/**
 * Created by PhpStorm.
 * User: zyuskin_en
 * Date: 29.12.14
 * Time: 11:10
 */

namespace It2k\TMApi\Response;

/**
 * Class GetOrderState
 *
 * @package It2k\TMApi\Response
 */
class GetOrderState extends BaseResponse
{
    const TMWEB_ORDER_ID_NOT_FOUND = 100;

    protected $additionalErrorMessages =  array(
        self::TMWEB_ORDER_ID_NOT_FOUND => 'Заказ не найден',
    );
}