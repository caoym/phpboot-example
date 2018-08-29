<?php

use PhpBoot\Application;
use PhpBoot\Console;

ini_set('date.timezone','Asia/Shanghai');

require __DIR__.'/vendor/autoload.php';

// 加载配置
$app = Application::createByDefault(
    __DIR__.'/config/config.php'
);

// 加载命令行
$console = Console::create($app);
$console->loadCommandsFromPath(__DIR__.'/App/Commands', 'App\\Commands');

// 执行命令行
$console->run();