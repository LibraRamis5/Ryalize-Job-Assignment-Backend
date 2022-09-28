<?php

use DI\ContainerBuilder;
use Slim\App;
use PDO as DB;

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
(require __DIR__ . '/../routes/routes.php')($app,$db);

// Register middleware
(require __DIR__ . '/../middleware/middleware.php')($app,$db);

return $app;