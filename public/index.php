<?php
ini_set('date.timezone','Asia/Shanghai');

require __DIR__.'/../vendor/autoload.php';

//CLI 模式下模拟请求
//$_SERVER['REQUEST_METHOD'] = 'GET';
//$_SERVER['REQUEST_URI'] = '/docs/swagger.json';

$app = \PhpBoot\Application::createByDefault(
    __DIR__.'/../config/config.php'
);

PhpBoot\Docgen\DocgenProvider::register($app);

$app->loadRoutesFromPath( __DIR__.'/../App/Controllers', 'App\\Controllers');

$app->dispatch();
