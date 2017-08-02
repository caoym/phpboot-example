<?php

return [
    //App
    'host' => '118.190.86.50:8009',

    //DB
    'DB.connection'=> 'mysql:dbname=phpboot-example;host=127.0.0.1',
    'DB.username'=> 'root',
    'DB.password'=> 'root',
    'DB.options' => [],

    \PhpBoot\Controller\ExceptionRenderer::class =>
        \DI\object(\App\Utils\ExceptionRenderer::class)
];