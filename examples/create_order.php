<?php
/**
 * Created by PhpStorm.
 * User: zyuskin_en
 * Date: 27.12.14
 * Time: 15:34
 */

$options = include(__DIR__.'/config.php');
include __DIR__.'/../vendor/autoload.php';

$manager = new \It2k\TMApi\Manager($options);

print($manager->createOrder('9131111111', 'Тестовый заказ', new DateTime('now', new DateTimeZone('Europe/Moscow')), array('tariff_id' => 1, 'comment' => 'Интернет заказ')));
