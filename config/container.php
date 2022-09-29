<?php

use Psr\Container\ContainerInterface;
use Slim\App;
use Slim\Factory\AppFactory;
use \Illuminate\Database\Capsule\Manager as DB;


return [
    'settings' => function () {
        return require __DIR__ . '/settings.php';
    },

    App::class => function (ContainerInterface $container) {
        AppFactory::setContainer($container);

        return AppFactory::create();
    },

    DB::class => function (ContainerInterface $container) {

        $settings = $container->get('settings');

        $capsule = new DB();

        $capsule->addConnection($settings['db']);
        $capsule->setAsGlobal();
        $capsule->bootEloquent();

        return $capsule;
    }

];