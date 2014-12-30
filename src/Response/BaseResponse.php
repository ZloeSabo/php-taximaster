<?php
/**
 * Created by PhpStorm.
 * User: zyuskin_en
 * Date: 26.12.14
 * Time: 18:53
 */

namespace It2k\TMApi\Response;


/**
 * Class BaseResponse
 * Базовый класс ответа от сервера
 *
 * @package It2k\TMApi\Response
 */
class BaseResponse
{
    const TMWEB_SUCCESS             = 0;
    const TMWEB_UNKNOWN_ERROR       = 1;
    const TMWEB_UNKNOWN_API         = 2;
    const TMWEB_API_DISABLED        = 3;
    const TMWEB_WRONG_SIGNATURE     = 4;
    const TMWEB_UNSUPPORTED_API     = 5;
    const TMWEB_UNKNOWN_REQUEST     = 6;
    const TMWEB_WRONG_METHOD        = 7;
    const TMWEB_MISSING_PARAMETER   = 8;
    const TMWEB_INCORRECT_PARAMETER = 9;
    const TMWEB_INTERNAL_ERROR      = 10;

    const RESPONSE_UNKNOWN_CODE     = -1;
    const RESPONSE_CANNOT_DECODE    = -2;
    const RESPONSE_INVALID          = -3;

    /**
     * @var int
     */
    protected $statusCode;

    /**
     * @var array
     */
    protected $data;

    /**
     * @var array
     */
    protected $errorMessages = array(
        self::TMWEB_SUCCESS             => 'OK',
        self::TMWEB_UNKNOWN_ERROR       => 'Неизвестная ошибка',
        self::TMWEB_UNKNOWN_API         => 'Неизвестный тип API',
        self::TMWEB_API_DISABLED        => 'Данный API отключен',
        self::TMWEB_WRONG_SIGNATURE     => 'Неправильная подпись',
        self::TMWEB_UNSUPPORTED_API     => 'Неподдерживаемая версия апи',
        self::TMWEB_UNKNOWN_REQUEST     => 'Неизвестный запрос',
        self::TMWEB_WRONG_METHOD        => 'Неправильный метод в запросе',
        self::TMWEB_MISSING_PARAMETER   => 'Не хватает входного параметра',
        self::TMWEB_INCORRECT_PARAMETER => 'Некорректный входной параметр',
        self::TMWEB_INTERNAL_ERROR      => 'Ошибка при обработке запроса',

        self::RESPONSE_UNKNOWN_CODE     => 'Неизвестный код ответа',
        self::RESPONSE_CANNOT_DECODE    => 'Невозможно обработать ответ',
        self::RESPONSE_INVALID          => 'Неверный формат ответа',
    );

    /**
     * @var array
     */
    protected $additionalErrorMessages = array();


    /**
     * Конструктор
     * @param string $responseString строка с ответом API
     */
    public function __construct($responseString)
    {
        $this->errorMessages += $this->additionalErrorMessages;

        $resultJson = null;
        try {
            $resultJson = json_decode($responseString, true);

            if (is_array($resultJson) && isset($resultJson['code']) && isset($resultJson['data'])) {
                $responseCode = intval($resultJson['code']);
                if (isset($this->errorMessages[$responseCode])) {
                    $this->statusCode = $responseCode;
                    $this->data = $resultJson['data'];
                } else {
                    $this->statusCode = self::RESPONSE_UNKNOWN_CODE;
                }
            } else {
                $this->statusCode = self::RESPONSE_INVALID;
            }
        } catch (\Exception $e) {
            $this->statusCode = self::RESPONSE_CANNOT_DECODE;
        }
    }

    /**
     * Является ли ответ API сообщением об успехе запроса
     * @return bool
     */
    public function isSuccessful()
    {
        return $this->statusCode == self::TMWEB_SUCCESS;
    }

    /**
     * Получить числовой статус ответа
     * @return int
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * Получить текстовое описание статуса ответа
     * @return string
     */
    public function getStatusMessage()
    {
        return $this->errorMessages[$this->statusCode];
    }

    /**
     * Получить содержимое поля с данными из ответа API
     * @param string $name
     *
     * @return array
     */
    public function getData($name = '')
    {
        if ($name and isset($this->data[$name])) {
            return $this->data[$name];
        }

        return $this->data;
    }
}