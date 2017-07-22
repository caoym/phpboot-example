<?php
ini_set('date.timezone','Asia/Shanghai');

require __DIR__.'/../vendor/autoload.php';

//CLI 模式下模拟请求
//$_SERVER['REQUEST_METHOD'] = 'GET';
//$_SERVER['REQUEST_URI'] = '/books/';

$app = \PhpBoot\Application::createByDefault(
    __DIR__.'/../config/config.php'
);

$app->loadRoutesFromClass(\App\Controllers\Books::class);

$app->dispatch();