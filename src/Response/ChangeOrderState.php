<?php
/**
 * Created by PhpStorm.
 * User: zyuskin_en
 * Date: 29.12.14
 * Time: 11:10
 */

namespace It2k\TMApi\Response;


/**
 * Class ChangeOrderState
 *
 * @package It2k\TMApi\Response
 */
class ChangeOrderState extends BaseResponse
{
    const TMWEB_ORDER_ID_NOT_FOUND = 100;
    const TMWEB_STATE_ID_NOT_FOUND = 101;
    const TMWEB_ERROR_CHANGE_STATE = 102;

    protected $additionalErrorMessages =  array(
        self::TMWEB_ORDER_ID_NOT_FOUND => 'Не найден заказ ИД=ORDER_ID',
        self::TMWEB_STATE_ID_NOT_FOUND => 'Не найдено состояние заказа ИД=NEW_STATE',
        self::TMWEB_ERROR_CHANGE_STATE => 'Изменение состояния не соответствует необходимым условиям.',
    );
}