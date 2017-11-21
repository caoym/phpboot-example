<?php
//@see PbpBoot\Application::createByDefault
return [
    //The host (name or ip) serving the API, used by swagger docgen.
    'host' => 'example.phpboot.org',

    //The App's name, default is "App", use by \Monolog\Logger as the logging channel
    'App.name'  => 'phpboot-example',

    //The prefix of api uri path, default is "/"
    'App.uriPrefix' => '/',

    //DB.* are the params for PDO::__construct, @see http://php.net/manual/en/pdo.construct.php
    'DB.connection'=> 'mysql:dbname=phpboot-example;host=127.0.0.1',
    'DB.username'=> 'root',
    'DB.password'=> 'root',
    'DB.options' => [],

    /************************************************************************************
    如果要将系统缓存改成文件方式, 取消下面的注释。默认系统缓存是 APC
    注意这里的系统缓存指路由、依赖注入方式等信息的缓存, 而不是业务接口返回数据的缓存。
    所以这里不要使用 redis 等远程缓存

    \Doctrine\Common\Cache\Cache::class => \DI\object(\Doctrine\Common\Cache\FilesystemCache::class)
        ->constructorParameter('directory', sys_get_temp_dir()),

     ************************************************************************************/

    /************************************************************************************
    若需要在业务中使用 Redis,请打开此注释, 以便RedisCache可以通过依赖注入被 Controller 使用

    \Redis::class => \DI\object()->method('connect', '127.0.0.1', 6379),
    Doctrine\Common\Cache\RedisCache::class => \DI\object()->method('setRedis', \DI\get(\Redis::class)),

     ************************************************************************************/

    //默认日志路径在此修改
    'defaultLoggerStream' => \DI\object(\Monolog\Handler\StreamHandler::class)
        ->constructor('/tmp/example.phpboot.org.log', \Monolog\Logger::DEBUG),

    \Psr\Log\LoggerInterface::class => \DI\object(\Monolog\Logger::class)
        ->constructor('example_phpboot_org')->method('pushHandler',\DI\get('defaultLoggerStream')),

    //异常输出类
    \PhpBoot\Controller\ExceptionRenderer::class =>
        \DI\object(\App\Utils\ExceptionRenderer::class),

    \App\Hooks\BasicAuth::class=> \DI\object()
            ->property('username', 'test')
            ->property('password', 'test')
];