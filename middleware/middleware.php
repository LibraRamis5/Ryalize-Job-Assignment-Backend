<?php

use Slim\App;
use PDO as DB;

return function (App $app,DB $db) {

    // Parse json, form data and xml
    $app->addBodyParsingMiddleware();

    // Add the Slim built-in routing middleware
    $app->addRoutingMiddleware();

    // Handle exceptions
    $app->addErrorMiddleware(true, true, true);
};