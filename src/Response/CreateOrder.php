<?php
/**
 * Created by PhpStorm.
 * User: zyuskin_en
 * Date: 29.12.14
 * Time: 11:10
 */

namespace It2k\TMApi\Response;

/**
 * Class CreateOrder
 *
 * @package It2k\TMApi\Response
 */
class CreateOrder extends BaseResponse
{
    const TMWEB_ORDER_ALREADY_CREATED = 100;
    const TMWEB_TARIFF_NOT_FOUND      = 101;
    const TMWEB_CREW_NOT_FOUND        = 102;
    const TMWEB_UDS_NOT_FOUND         = 103;

    protected $additionalErrorMessages =  array(
        self::TMWEB_ORDER_ALREADY_CREATED => 'Заказ с такими параметрами уже создан',
        self::TMWEB_TARIFF_NOT_FOUND      => 'Тариф не найден',
        self::TMWEB_CREW_NOT_FOUND        => 'Группа экипажа не найдена',
        self::TMWEB_UDS_NOT_FOUND         => 'Служба ЕДС не найдена',
    );
}