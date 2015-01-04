<?php
/**
 * Created by PhpStorm.
 * User: zyuskin_en
 * Date: 04.01.15
 * Time: 13:43
 */

$options = include(__DIR__.'/config.php');
include __DIR__.'/../vendor/autoload.php';

$manager = new \It2k\TMApi\Manager($options);

print_r($manager->calcOrderCost(1));
