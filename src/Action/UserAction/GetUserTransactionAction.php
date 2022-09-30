<?php

namespace App\Action\UserAction;

use App\Action\Action;
use App\Models\UserTransaction;
use App\Models\ViewUserTransaction;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Models\User;


final class GetUserTransactionAction extends Action{

    public function __invoke(Request $request, Response $response, $args): Response {
    
        try{
            $users = ViewUserTransaction::paginate(30);
            $data = ['message' => 'user transactions', 'data' => $users];
            return $this->success($response,$data);

        } catch (\Exception $e) {
            return $this->error($e->getMessage());
       }

    }

}