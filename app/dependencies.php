<?php
declare(strict_types=1);

use App\Application\Settings\SettingsInterface;
use DI\ContainerBuilder;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Monolog\Processor\UidProcessor;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;
use \RedBeanPHP\R as R;
use League\Flysystem\Filesystem;
use League\Flysystem\Local\LocalFilesystemAdapter;




return function (ContainerBuilder $containerBuilder) {
    $containerBuilder->addDefinitions([
        LoggerInterface::class => function (ContainerInterface $c) {
            $settings = $c->get(SettingsInterface::class);

            $loggerSettings = $settings->get('logger');
            $logger = new Logger($loggerSettings['name']);

            $processor = new UidProcessor();
            $logger->pushProcessor($processor);

            $handler = new StreamHandler($loggerSettings['path'], $loggerSettings['level']);
            $logger->pushHandler($handler);

            return $logger;
        },
        PDO::class => function (ContainerInterface $c) {
 
            $settings = $c->get(SettingsInterface::class);
 
            $dbSettings = $settings->get('db');
 
            $host = $dbSettings['host'];
            $dbname = $dbSettings['database'];
            $username = $dbSettings['username'];
            $password = $dbSettings['password'];
            $charset = $dbSettings['charset'];
            $flags = $dbSettings['flags'];
            $dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";

            //Instantiate Red Bean ORM
            R::setup( $dsn, $username, $password);

            return new PDO($dsn, $username, $password);
        },
        Filesystem::class => function (ContainerInterface $c){

            $settings = $c->get(SettingsInterface::class);
            $adapter = new League\Flysystem\Local\LocalFilesystemAdapter($settings->get('rootPath'));
            return new League\Flysystem\Filesystem($adapter);
        }
        
    ]);
};
