<?php

$ip = '192.168.2.28';
$port = '5075';
$secret = '123';

function autoloader($classname) {
    $dir = dirname(__FILE__);
    if(strpos($classname, 'Request') !== false) {
        include $dir . '/../Request/' . $classname . '.php';
    } else if (strpos($classname, 'Response') !== false) {
        include $dir . '/../Response/' . $classname . '.php';
    }
}

spl_autoload_register('autoloader');


$request = new CreateOrderRequest($ip, $port, $secret);

$request
    ->setSource('Удмуртская ул., 151')
    ->setDest('Пушкинская ул., 130')
    ->setPhone('123123')
    ;

$request->send();

$errorMessage = false;
if($request->isSucessful()) {
    $response = $request->getResponse();
    if(!$response->isSuccessful()) {
        $errorMessage = $response->getStatusMessage();
    }
} else {
    $errorMessage = $request->getStatusMessage();
}

echo json_encode(array(
    'result' => empty($errorMessage) ? 'Создан успешно' : 'При создании заказа возникла ошибка: ' . $errorMessage
));