<?php
/**
 * Created by PhpStorm.
 * User: zyuskin_en
 * Date: 27.12.14
 * Time: 14:51
 */

/* Настройте параметры в этом файле */
$options = include(__DIR__.'/config.php');
include __DIR__.'/../vendor/autoload.php';

$manager = new \It2k\TMApi\Manager($options);

if ($manager->ping()) {
    print "OK\n";
} else {
    print "FALSE\n";
}

