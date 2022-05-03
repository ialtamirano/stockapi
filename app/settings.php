<?php
declare(strict_types=1);

use App\Application\Settings\Settings;
use App\Application\Settings\SettingsInterface;
use DI\ContainerBuilder;
use Monolog\Logger;



return function (ContainerBuilder $containerBuilder) {

    // Global Settings Object
    $containerBuilder->addDefinitions([
        SettingsInterface::class => function () {
            return new Settings([
                'displayErrorDetails' => true, // Should be set to false in production
                'logError'            => true,// Should be set to false in production
                'logErrorDetails'     => true,
                'logger' => [
                    'name' => 'slim-app',
                    'path' => isset($_ENV['docker']) ? 'php://stdout' : __DIR__ . '/../logs/app.log',
                    'level' => Logger::DEBUG,
                ],
                "determineRouteBeforeAppMiddleware" => true,

                'jwt_authentication' => [
                    'secret' => $_ENV['JWT_SECRET'],
                    'algorithm' => 'HS256',
                    'ignore' => ["/token", "/authentication/register","/authentication/login"],
                    'secure' => false, // only for localhost for prod and test env set true
                    'error' =>  function ($response, $arguments) {
                        $data['status'] = 401;
                        $data['error'] = 'Unauthorized/'. $arguments['message'];
                        return $response
                            ->withHeader('Content-Type', 'application/json;charset=utf-8')
                            ->getBody()->write(json_encode(
                                $data,
                                JSON_THROW_ON_ERROR | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT
                            ));
                    }
                ], 
                "rootPath" =>   __DIR__ .'/../files/',             
                'db'     => [
                    'driver' => 'mysql',
                    'host' => "localhost",
                    'username' => "root",
                    'database' => "stockdb",
                    'password' => "",
                    'charset' => 'utf8mb4',
                    'collation' => 'utf8mb4_unicode_ci',
                    'flags' => [
                        // Turn off persistent connections
                        PDO::ATTR_PERSISTENT => false,
                        // Enable exceptions
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        // Emulate prepared statements
                        PDO::ATTR_EMULATE_PREPARES => true,
                        // Set default fetch mode to array
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                    ],
                ],
            ]);
        }
        
    ]);
};
