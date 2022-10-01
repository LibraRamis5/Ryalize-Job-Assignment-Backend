<?php

use DI\ContainerBuilder;
use Slim\App;
use \Illuminate\Database\Capsule\Manager as DB;

require_once __DIR__ . '/../vendor/autoload.php';

$containerBuilder = new ContainerBuilder();

// Add DI container definitions
$containerBuilder->addDefinitions(__DIR__ . '/container.php');

// Create DI container instance
$container = $containerBuilder->build();

// Create Slim App instance
$app = $container->get(App::class);
$db = $container->get(DB::class);

// Register routes
(require __DIR__ . '/../routes/routes.php')($app);

// Register middleware
(require __DIR__ . '/../middleware/middleware.php')($app);

$app->add(function ($request, $handler) {
    $response = $handler->handle($request);
    return $response
        ->withHeader('Access-Control-Allow-Origin', '*')
        ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
        ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');
});

return $app;