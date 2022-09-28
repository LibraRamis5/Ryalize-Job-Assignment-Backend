<?php

use Slim\App;
use App\Action\UserAction\GetAction;
use PDO as DB;

return function (App $app, DB $db) {

    $app->get('/', GetAction::class);
};