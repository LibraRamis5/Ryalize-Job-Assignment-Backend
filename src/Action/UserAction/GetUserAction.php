<?php

namespace App\Action\UserAction;

use App\Action\Action;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Models\User;


final class GetUserAction extends Action{

    /**
     * Get all users list.
     *
     * @return object {
     *           "message" : "user list",
     *           "data" : array
     * }
     */

    public function __invoke(Request $request, Response $response, $args): Response {
    
        try{
            $users = User::paginate(30);
            $data = ['message' => 'user list', 'data' => $users];
            return $this->success($response,$data);

        } catch (\Exception $e) {
            return $this->error($e->getMessage());
       }

    }

}