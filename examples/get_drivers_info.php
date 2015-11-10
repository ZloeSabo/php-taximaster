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

print_r($manager->getDriversInfo());
