<?php

use Slim\App;
use App\Action\UserAction\GetUserAction;
use App\Action\UserAction\AddUserAction;
use App\Action\UserAction\UpdateUserAction;
use App\Action\HomePage\HomePageAction;

return function (App $app) {

    // home page routes
    $app->get('/', HomePageAction::class);

    // user routes
    $app->get('/user', GetUserAction::class);
    $app->post('/user-add', AddUserAction::class);
    $app->put('/user-update', UpdateUserAction::class);

};