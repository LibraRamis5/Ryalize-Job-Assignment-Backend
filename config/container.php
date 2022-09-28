<?php

use Psr\Container\ContainerInterface;
use Slim\App;
use Slim\Factory\AppFactory;
use PDO as PDOProvider;


return [
    'settings' => function () {
        return require __DIR__ . '/settings.php';
    },

    App::class => function (ContainerInterface $container) {
        AppFactory::setContainer($container);

        return AppFactory::create();
    },

    // Db::class => DI\create()->constructor(DI\get(Db::class))
    PDO::class => function (ContainerInterface $container) {

        $settings = $container->get('settings');  

        $host = $settings['host'];
        $user = $settings['username'];
        $pass = $settings['password'];
        $db = $settings['database'];

        $connectionString = "mysql:host=$host;dbname=$db";
        $connection = new PDOProvider($connectionString, $user, $pass);
        $connection->setAttribute(PDOProvider::ATTR_ERRMODE, PDOProvider::ERRMODE_EXCEPTION);
        return $connection;
    }

];