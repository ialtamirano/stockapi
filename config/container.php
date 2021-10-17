<?php

PDO::class => function (ContainerInterface $container) {
    $settings = $container->get('settings')['db'];

    $host = $settings['host'];
    $dbname = $settings['database'];
    $username = $settings['username'];
    $password = $settings['password'];
    $charset = $settings['charset'];
    $flags = $settings['flags'];
    $dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";

    return new PDO($dsn, $username, $password, $flags);
},