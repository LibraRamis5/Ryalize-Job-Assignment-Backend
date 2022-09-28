<?php

use Slim\App;
use App\Action\UserAction\GetUserAction;
use PDO as DB;

return function (App $app, DB $db) {

    $app->get('/', GetUserAction::class);
};