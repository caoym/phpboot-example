<?php
use PhpBoot\Docgen\Swagger\Swagger;
use PhpBoot\Docgen\Swagger\SwaggerProvider;
use PhpBoot\Application;

ini_set('date.timezone','Asia/Shanghai');

require __DIR__.'/../vendor/autoload.php';

////CLI 模式下模拟请求
//$_SERVER['REQUEST_METHOD'] = 'GET';
//$_SERVER['REQUEST_URI'] = '/docs/swagger.json';

$app = \PhpBoot\Application::createByDefault(
    __DIR__.'/../config/config.php'
);

SwaggerProvider::register($app, function(Swagger $swagger)use($app){
    $swagger->schemes = ['http'];
    $swagger->host = $app->get('host');
    $swagger->info->title = 'PhpBoot 示例';
    $swagger->info->description = "此文档由 PbpBoot 生成 swagger 格式的 json (http://{$swagger->host}./dosc/swagger.json), 再由Swagger UI 渲染成 web。";
});

$app->loadRoutesFromPath( __DIR__.'/../App/Controllers', 'App\\Controllers');

$app->dispatch();
