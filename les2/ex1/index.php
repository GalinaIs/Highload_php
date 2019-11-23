<?php
require_once('vendor/autoload.php');
require_once('App.php');

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

$time_start = microtime(true);
$memory_start = memory_get_usage();
$app = new App();
$app->run();
$time_end = microtime(true);
$memory_end = memory_get_usage();

$logTime = new Logger('time');
$logTime->pushHandler(new StreamHandler('log/time.log', Logger::DEBUG));//содержит время работы приложения
$logTime->debug($time_end - $time_start);


$logMemory = new Logger('memory');
//содержит память, которую использует приложение для работы
$logMemory->pushHandler(new StreamHandler('log/memory.log', Logger::DEBUG));
$logMemory->debug($memory_end - $memory_start);