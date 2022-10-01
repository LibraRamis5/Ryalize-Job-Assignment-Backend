<?php

namespace App\Action\UserAction;

use App\Action\Action;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Models\User;


final class SingleUserAction extends Action{

    public function __invoke($id): Response {

        try{
            $user = User::findOrFail($id);
            $data = ['message' => 'user information', 'data' => $users];
            return $this->success($response,$data);

        } catch (\Exception $e) {
            return $this->error($e->getMessage());
       }

    }

}