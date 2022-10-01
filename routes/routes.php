<?php

use Slim\App;
use App\Action\UserAction\GetUserAction;
use App\Action\UserAction\AddUserAction;
use App\Action\UserAction\UpdateUserAction;
use App\Action\UserAction\GetUserTransactionAction;
use App\Action\UserAction\SingleUserAction;
use App\Action\Locations\GetLocationAction;
use App\Action\HomePage\HomePageAction;
use App\Action\UserAction\UserLoginAction;
use App\Action\UserAction\IsUserLoginAction;
use App\Middleware\AuthMiddleware;

return function (App $app) {

//    $app->group('', function () use ($app) {

            // home page routes
            $app->get('/', HomePageAction::class);

            // user routes
            $app->get('/user', GetUserAction::class);
            $app->get('/is-user-login', IsUserLoginAction::class)->add(AuthMiddleware::class);
            $app->post('/user-login', UserLoginAction::class);
            $app->get('/user-single/'.'{$id}', SingleUserAction::class)->add(AuthMiddleware::class);
            $app->get('/user-transaction', GetUserTransactionAction::class);
            $app->post('/user-add', AddUserAction::class)->add(AuthMiddleware::class);
            $app->put('/user-update', UpdateUserAction::class)->add(AuthMiddleware::class);
            $app->get('/location', GetLocationAction::class)->add(AuthMiddleware::class);

//    })->add(AuthMiddleware::class);



};