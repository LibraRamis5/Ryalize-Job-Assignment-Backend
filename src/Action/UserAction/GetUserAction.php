<?php

namespace App\Action\UserAction;

use App\Action\Action;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Models\User;


final class GetUserAction extends Action{

    public function __invoke(Request $request, Response $response, $args): Response {
    
        try{
            $users = User::paginate(30);
            $data = ['status' => 200, 'message' => 'user list', 'data' => $users];
            return $this->success($response,$data);

        } catch (\Exception $e) {
            return $this->error($e->getMessage());
       }

    }

}