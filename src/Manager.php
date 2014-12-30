<?php
/**
 * Created by PhpStorm.
 * User: zyuskin_en
 * Date: 27.12.14
 * Time: 16:52
 */

namespace It2k\TMApi;

use It2k\TMApi\Exception\CreateOrderException;
use It2k\TMApi\Exception\RequestException;
use It2k\TMApi\Exception\ResponseException;
use It2k\TMApi\Request\BaseRequest;
use It2k\TMApi\Response\BaseResponse;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class Manager
 * Менеджер запросов к TMApi
 *
 * @package It2k\TMApi
 */
class Manager
{
    /**
     * @var array
     */
    protected $options;

    /**
     * @var array|BaseRequest[]
     */
    protected $instances;

    /**
     * @param array $options
     */
    public function __construct(array $options = array())
    {
        $resolver = new OptionsResolver();
        $resolver->setDefaults(array(
            'schema' => 'https',
            'ip' => '127.0.0.1',
            'port' => 8089,
            'timeout' => 10,
            'requestNamespace' => __NAMESPACE__ . '\\Request\\',
            'curl_debug' => false,
            'taximasterDateTimeFormat' => 'YmdHis',
        ));
        $resolver->addAllowedValues(array(
            'schema' => array('http', 'https'),
        ));
        $resolver->setRequired(array('secret_key', 'ip', 'port', 'requestNamespace'));

        $this->options = $resolver->resolve($options);
    }

    /**
     * Создает запрос если не находит его в списке instance
     *
     * @param string $requestName Имя класса запроса
     * @param array  $param       Параметры запроса
     *
     * @return BaseResponse
     * @throws RequestException
     * @throws ResponseException
     */
    protected function sendRequest($requestName, array $param = array())
    {
        if (!isset($this->instances[$requestName])) {
            $classFullName = $this->options['requestNamespace'] . $requestName;
            $this->instances[$requestName] = new $classFullName(array(
                'ip' => $this->options['ip'],
                'port' => $this->options['port'],
                'secret_key' => $this->options['secret_key'],
                'timeout' => $this->options['timeout'],
                'schema' => $this->options['schema'],
                'curl_debug' => $this->options['curl_debug']
            ));
        }

        $request = $this->instances[$requestName];

        $request->send($param);
        if (!$request->isSuccessful()) {
            throw new RequestException($request->getStatusMessage());
        }

        $response = $request->getResponse();

        if (!$response->isSuccessful()) {
            throw new ResponseException('[' . $response->getStatusCode() . '] ' . $response->getStatusMessage());
        }

        return $response;
    }

    /**
     * Проверяет доступность API (не учитывает секретный ключ)
     * @return bool
     */
    public function ping()
    {
        try {
            $this->sendRequest('Ping');
        } catch (\Exception $e) {
            return false;
        }

        return true;
    }

    /**
     * Возвращает массив экипажей
     * @return array
     */
    public function getCrewGroupsList()
    {
        $response = $this->sendRequest('GetCrewGroupsList');

        return $response->getData('crew_groups');
    }

    /**
     * Возвращаем массив групп клиентов
     * @return array
     */
    public function getClientGroupsList()
    {
        $response = $this->sendRequest('GetClientGroupsList');

        return $response->getData('client_groups');
    }

    /**
     * Возвращает масив служб ЕДС
     * @return array
     */
    public function getUdsList()
    {
        $response = $this->sendRequest('GetUdsList');

        return $response->getData('uds');
    }

    /**
     * Возвращает масив тарифов
     * @return array
     */
    public function getTariffsList()
    {
        $response = $this->sendRequest('GetTariffsList');

        return $response->getData('tariffs');
    }

    /**
     * Возвращает масив дополнительных сервисов
     * @return array
     */
    public function getServicesList()
    {
        $response = $this->sendRequest('GetServicesList');

        return $response->getData('services');
    }

    /**
     * Возвращает масив параметров к заказу
     * @return array
     */
    public function getOrderParamsList()
    {
        $response = $this->sendRequest('GetOrderParamsList');

        return $response->getData('order_params');
    }

    /**
     * Возвращает масив скидок
     * @return array
     */
    public function getDiscountsList()
    {
        $response = $this->sendRequest('GetDiscountsList');

        return $response->getData('discounts');
    }

    /**
     * Вычисляет информацию по расчеты цены заказа и возвращает ее в виде масива
     *
     * @param int   $tariffId
     * @param array $params
     *
     * @return array
     */
    public function calcOrderCost($tariffId, array $params = array())
    {
        $params['tariff_id'] = $tariffId;
        $response = $this->sendRequest('CalcOrderCost', $params);

        return $response->getData();
    }

    /**
     * @param string    $phone
     * @param string    $source
     * @param \DateTime $sourceTime
     * @param array     $params
     *
     * @return int
     * @throws CreateOrderException
     */
    public function createOrder($phone, $source, \DateTime $sourceTime, $params = array())
    {
        if (!$phone or !$source or !$sourceTime) {
            throw new CreateOrderException('Не заполнены обязатеьные параметры');
        }

        $phone = substr($phone, 0, 15);
        $params['phone']       = $phone;
        $params['source']      = $source;
        $params['source_time'] = $sourceTime->format($this->options['taximasterDateTimeFormat']);

        $response = $this->sendRequest('CreateOrder', $params);

        return $response->getData('order_id');
    }

    /**
     * Изменяет статус заказа
     *
     * @param int $orderId
     * @param int $stateId
     *
     * @return array
     */
    public function changeOrderState($orderId, $stateId)
    {
        $params = array(
            'order_id' => $orderId,
            'new_state' => $stateId,
        );

        $response = $this->sendRequest('ChangeOrderState', $params);

        return $response->getData();
    }

    /**
     * Возвращает информацию о экипаже
     *
     * @param int $crewId
     *
     * @return array
     */
    public function getCrewInfo($crewId)
    {
        $params = array(
            'crew_id' => $crewId,
        );

        $response = $this->sendRequest('GetCrewInfo', $params);

        return $response->getData();
    }

    /**
     * Возвращает информацию о экипажах на линии
     *
     * @return array
     */
    public function getCrewsInfo()
    {
        $response = $this->sendRequest('GetCrewsInfo');

        return $response->getData('crews_info');
    }

    /**
     * Возвращает информацию о водителе
     *
     * @param int    $driverId
     * @param string $needPhoto
     *
     * @return array
     */
    public function getDriverInfo($driverId, $needPhoto = 'false')
    {
        $params = array(
            'driver_id' => $driverId,
            'need_photo' => $needPhoto,
        );

        $response = $this->sendRequest('GetDriverInfo', $params);

        return $response->getData();
    }

    /**
     * Возвращает информацию о автомобиле
     *
     * @param int    $carId
     * @param string $needPhoto
     *
     * @return array
     */
    public function getCarInfo($carId, $needPhoto = 'false')
    {
        $params = array(
            'car_id' => $carId,
            'need_photo' => $needPhoto,
        );

        $response = $this->sendRequest('GetCarInfo', $params);

        return $response->getData();
    }

    /**
     * Возвращает информацию о координатах экипажей
     *
     * @param int $crewId
     *
     * @return array
     */
    public function getCrewsCoords($crewId = 0)
    {
        $params = ($crewId > 0) ? array('crew_id' => $crewId) : array();

        $response = $this->sendRequest('GetCrewsCoords', $params);

        return $response->getData('crews_coords');
    }

    /**
     * Поиск адреса
     *
     * @param string $getStreets      Искать улицы(true или false)
     * @param string $getHouses       Искать дома. Не может быть равно true, если get_streets = true или get_points = true.(true или false)
     * @param string $getPoints       Искать пункты.(true или false)
     * @param string $street          Часть названия улицы или пункта, если идет поиск улиц или пунктов, или полное название улицы, если идет поиск домов
     * @param string $house           Часть номера дома. Нужно только если get_houses = true.
     * @param string $maxAddressCount Максимальное количество адресов в ответе
     *
     * @return array
     */
    public function getAddresses($getStreets, $getHouses, $getPoints, $street, $house = '', $maxAddressCount = '')
    {
        $params = array(
            'get_streets'         => $getStreets,
            'get_houses'          => $getHouses,
            'get_points'          => $getPoints,
            'street'              => $street,
            'house'               => $house,
            'max_addresses_count' => $maxAddressCount,
        );

        try {
            $response = $this->sendRequest('GetAddresses', $params);
        } catch (\Exception $e) {
            return array();
        }

        return $response->getData('addresses');
    }

    /**
     * Анализ маршрута
     *
     * @param string $source    Адрес подачи
     * @param string $dest      Адрес назначения
     * @param string $sourceLon Долгота адреса подачи
     * @param string $sourceLat Широта адреса подачи
     * @param string $destLon   Долгота адреса назначения
     * @param string $destLat   Широта адреса назначения
     *
     * @return array
     */
    public function analyzeRoute($source, $dest, $sourceLon = '', $sourceLat = '', $destLon = '', $destLat = '')
    {
        $params = array(
            'source'     => $source,
            'dest'       => $dest,
            'source_lon' => $sourceLon,
            'source_lat' => $sourceLat,
            'dest_lon'   => $destLon,
            'dest_lat'   => $destLat,
        );

        $response = $this->sendRequest('AnalyzeRoute', $params);

        return $response->getData();
    }

    /**
     * Возвращает информацию о состоянии заказа
     *
     * @param int $orderId
     *
     * @return array
     */
    public function getOrderState($orderId)
    {
        $params = array(
            'order_id' => $orderId
        );

        $response = $this->sendRequest('GetOrderState', $params);

        return $response->getData();
    }

    /**
     * Создание задачи СМС серверу
     *
     * @param string $phone   Номер телефона
     * @param string $message Текст СМС
     *
     * @return bool
     */
    public function sendSms($phone, $message)
    {
        $params = array(
            'phone' => $phone,
            'message' => $message
        );

        try {
            $this->sendRequest('SendSms', $params);
        } catch (\Exception $e) {
            return false;
        }

        return true;
    }

    /**
     * Проверка авторизации
     *
     * @param string $login    Логин
     * @param string $password Пароль
     *
     * @return bool|int
     */
    public function checkAuthorization($login, $password)
    {
        $params = array(
            'login' => $login,
            'password' => $password
        );

        try {
            $response = $this->sendRequest('CheckAuthorization', $params);
        } catch (\Exception $e) {
            return false;
        }

        return $response->getData('client_id');
    }

    /**
     * Регистрация клиента
     *
     * @param string $name     ФИО
     * @param string $login    Логин
     * @param string $password Пароль
     * @param string $phones   Номера телефонов (через запятую)
     * @param string $address  Домашний адрес
     * @param string $birthday Дата рождения ДД.ММ.ГГГГ
     * @param string $gender   Пол. Может принимать значения "male" - мужской "female" - женский
     *
     * @return bool|int
     */
    public function registerClient($name, $login, $password, $phones, $address = '', $birthday = '', $gender = '')
    {
        $params = array(
            'name'     => $name,
            'login'    => $login,
            'password' => $password,
            'phones'   => $phones,
            'address'  => $address,
            'birthday' => $birthday,
            'gender'   => $gender
        );

        try {
            $response = $this->sendRequest('RegisterClient', $params);
        } catch (\Exception $e) {
            return false;
        }

        return $response->getData('client_id');
    }

    /**
     * Возвращает информацию о клиенту
     *
     * @param int $clientId
     *
     * @return array
     */
    public function getClientInfo($clientId)
    {
        $params = array(
            'client_id' => $clientId,
        );

        $response = $this->sendRequest('GetClientInfo', $params);

        return $response->getData();
    }

    /**
     * Изменение информации по клиенту
     *
     * @param int    $clientId ИД клиента
     * @param string $name     ФИО
     * @param string $login    Логин
     * @param string $password Пароль
     * @param string $phones   Номера телефонов (через запятую)
     * @param string $address  Домашний адрес
     * @param string $birthday Дата рождения ДД.ММ.ГГГГ
     * @param string $gender   Пол. Может принимать значения "male" - мужской "female" - женский
     *
     * @return bool
     */
    public function updateClientInfo($clientId, $name = '', $login = '', $password = '', $phones = '', $address = '', $birthday = '', $gender = '')
    {
        $params = array(
            'client_id' => $clientId,
            'name'      => $name,
            'login'     => $login,
            'password'  => $password,
            'phones'    => $phones,
            'address'   => $address,
            'birthday'  => $birthday,
            'gender'    => $gender
        );

        try {
            $this->sendRequest('UpdateClientInfo', $params);
        } catch (\Exception $e) {
            return false;
        }

        return true;
    }

    /**
     * Запрос текущих заказов
     *
     * @param string $clientId ИД клиента (может отсутствовать, если phone заполнен)
     * @param string $phone    Телефон клиента (может отсутствовать, если client_id заполнен)
     *
     * @return array
     */
    public function getCurrentOrders($clientId, $phone = '')
    {
        $params = array(
            'client_id' => $clientId,
            'phone'     => $phone,
        );

        $response = $this->sendRequest('GetCurrentOrders', $params);

        return $response->getData('orders');
    }

    /**
     * Запрос текущих заказов
     *
     * @param string $clientId   ИД клиента (может отсутствовать, если phone заполнен)
     * @param string $phone      Телефон клиента (может отсутствовать, если client_id заполнен)
     * @param string $startTime  Начало периода ГГГГММДДччммсс
     * @param string $finishTime Конец периода ГГГГММДДччммсс
     *
     * @return array
     */
    public function getFinishedOrders($clientId, $phone, $startTime, $finishTime)
    {
        $params = array(
            'client_id'   => $clientId,
            'phone'       => $phone,
            'start_time'  => $startTime,
            'finish_time' => $finishTime,
        );

        $response = $this->sendRequest('GetFinishedOrders', $params);

        return $response->getData('orders');
    }

    /**
     * Проведение операции по клиенту
     *
     * @param int    $clientId ИД клиента
     * @param string $operTime Время создания операции
     * @param float  $sum      Сумма
     * @param int    $operType Тип операции: "receipt" - приход "expense" - расход
     * @param int    $payType  Тип оплаты: "cash" - наличный "nocash" - безналичный
     * @param string $comment  Комментарий
     *
     * @return int
     */
    public function createClientOperation($clientId, $operTime, $sum, $operType, $payType, $comment = '')
    {
        $params = array(
            'client_id' => $clientId,
            'oper_time' => $operTime,
            'sum'       => $sum,
            'oper_type' => $operType,
            'pay_type'  => $payType,
            'comment'   => $comment,
        );

        $response = $this->sendRequest('CreateClientOperation', $params);

        return $response->getData('oper_id');
    }

    /**
     * Запрос операций по клиенту
     *
     * @param string $clientId   ИД клиента (может отсутствовать, если phone заполнен)
     * @param string $phone      Телефон клиента (может отсутствовать, если client_id заполнен)
     * @param string $startTime  Начало периода ГГГГММДДччммсс
     * @param string $finishTime Конец периода ГГГГММДДччммсс
     *
     * @return array
     */
    public function getClientOperations($clientId, $phone, $startTime, $finishTime)
    {
        $params = array(
            'client_id'   => $clientId,
            'phone'       => $phone,
            'start_time'  => $startTime,
            'finish_time' => $finishTime,
        );

        $response = $this->sendRequest('GetClientOperations', $params);

        return $response->getData('operations');
    }

    /**
     * Устанавливет координаты экипажа
     *
     * @param array $coords
     *
     * @return bool
     */
    public function setCrewsCoords(array $coords)
    {
        $params = array(
            'crew_coords' => $coords,
        );

        try {
            $this->sendRequest('SetCrewsCoords', $params);
        } catch (\Exception $e) {
            return false;
        }

        return true;
    }
} 