<?php

use Slim\App;
use DavidePastore\Slim\Validation\Validation;
use App\Action\UserAction\GetUserAction;
use App\Action\UserAction\AddUserAction;
use App\Action\UserAction\UserValidator;

return function (App $app) {

    $app->get('/user', GetUserAction::class);
    $app->post('/user-add', AddUserAction::class);
    
};