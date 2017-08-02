<?php
use PhpBoot\Docgen\Swagger\Swagger;
use PhpBoot\Docgen\Swagger\SwaggerProvider;
use PhpBoot\Application;
use PhpBoot\Controller\Hooks\Cors;

ini_set('date.timezone','Asia/Shanghai');

require __DIR__.'/../vendor/autoload.php';


// 加载配置
$app = \PhpBoot\Application::createByDefault(
    __DIR__.'/../config/config.php'
);

// 支持 Core 跨域访问,  如果要关闭此功能, 只需注释掉这块代码{{
$app->setGlobalHooks([Cors::class]);
//}}


//接口文档自动导出功能, 如果要关闭此功能, 只需注释掉这块代码{{
SwaggerProvider::register($app, function(Swagger $swagger)use($app){
    $swagger->schemes = ['http'];
    $swagger->host = $app->get('host');
    $swagger->info->title = 'PhpBoot 示例';
    $swagger->info->description = "此文档由 PbpBoot 生成 swagger 格式的 json, 再由Swagger UI 渲染成 web。";
});
//}}
$app->loadRoutesFromPath( __DIR__.'/../App/Controllers', 'App\\Controllers');

//执行请求
$app->dispatch();
