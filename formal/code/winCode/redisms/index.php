<?php
#http://127.0.0.1:8080/redisms/index.php
#echo "redis";
ini_set("display_errors", "On");
require './config.php';
require './redis.php';

$http = new Swoole\Http\Server("0.0.0.0", 9502);


// 设置swoole进程个数
$http->set([
    'worker_num' => 1
]);
// 在创建的时候执行  ； 进程创建的时候触发时候
// 理解为一个构造函数，初始化
$http->on('workerStart', function ($server, $worker_id) use($config){
    global $redis;
    $redis = new RedisMs($config);
});


$http->on('request', function ($request, $response){
    global $redis;
    $redis->run();
});

$http->start();