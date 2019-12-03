<?php
require 'RedisCacheProvider.php';

function main() {
    $key = 'Шары для полива';
    getDataFromDb($key);
    getDataFromRedis($key);
}

function getDataFromDb($key) {
    $startDb = microtime(true);
    $connect = mysqli_connect('localhost', 'root', 'Ufkz1989', 'skytech', 3307);
    $query = "select * from b_sale_basket where NAME = '" . $key . "';";
    $result = mysqli_query($connect, $query);
    mysqli_close($connect);
    $endDb = microtime(true);
    echo 'Время получения данных из БД: ' . ($endDb - $startDb) . '<br>';
    RedisCacheProvider::set($key, $result);
}

function getDataFromRedis($key) {
    $startRedis = microtime(true);
    $result = RedisCacheProvider::get($key);
    $endRedis = microtime(true);
    echo 'Время получения данных из Redis: ' . ($endRedis - $startRedis) . '<br>';
}

main();
?>
