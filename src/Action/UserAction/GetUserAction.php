<?php

namespace App\Action\UserAction;

use App\Action\Action;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Models\User;
use Respect\Validation\Validator as v;

final class GetUserAction extends Action{

    public function __invoke(Request $request, Response $response, $args): Response {
    
        try{
            $users = User::all();
            return $this->success($response,$users);

        } catch (\Exception $e) {
            return $this->error($response,$error);
       }

    }

}