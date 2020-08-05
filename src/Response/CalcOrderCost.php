<?php
/**
 * Created by PhpStorm.
 * User: zyuskin_en
 * Date: 28.12.14
 * Time: 14:47
 */

namespace It2k\TMApi\Response;

/**
 * Class CalcOrderCost
 *
 * @package It2k\TMApi\Response
 */
class CalcOrderCost extends BaseResponse
{
    const TMWEB_TARIFF_NOT_FOUND           = 100;
    const TMWEB_ERROR_TARIFF_CALC          = 101;
    const TMWEB_DISCONT_NOT_FOUND          = 102;
    const TMWEB_CLIENT_NOT_FOUND           = 103;
    const TMWEB_SOURCE_ZONE_NOT_FOUND      = 104;
    const TMWEB_DESTINATION_ZONE_NOT_FOUND = 105;
    const TMWEB_DISC_CARD_NOT_FOUND        = 106;

    protected $additionalErrorMessages =  array(
        self::TMWEB_TARIFF_NOT_FOUND             => 'Тариф не найден',
        self::TMWEB_ERROR_TARIFF_CALC            => 'Ошибка при расчете по тарифу',
        self::TMWEB_DISCONT_NOT_FOUND            => 'Скидка не найдена',
        self::TMWEB_CLIENT_NOT_FOUND             => 'Клиент не найден',
        self::TMWEB_SOURCE_ZONE_NOT_FOUND        => 'Район подачи не найден',
        self::TMWEB_DESTINATION_ZONE_NOT_FOUND   => 'Район назначения не найден',
        self::TMWEB_DISC_CARD_NOT_FOUND          => 'Дисконтная карта не найдена',
    );
}