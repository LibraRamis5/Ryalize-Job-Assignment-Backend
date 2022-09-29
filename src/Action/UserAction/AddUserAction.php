<?php

namespace App\Action\UserAction;

use App\Action\Action;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Models\User;
use Respect\Validation\Validator as v;

final class AddUserAction extends Action{

    private function validator($data){
        $error = [];
        
        if(isset($data['user_name']) || v::alnum()->noWhitespace()->length(1, 10)->validate($data['user_name']))
            $error[] = "user name is requried";
       
        if(count($error) > 0){
            return $error;
        }

        return false;
    }

    public function __invoke(Request $request, Response $response, $args): Response {
        $data = $request->getParsedBody();       
        

        if($errors = $this->validator($data)){
            return $this->error($response,$errors);
        }

        try{
            die('okay');
            $users = User::all();
            return $this->success($response,$users);

        } catch (\Exception $e) {
            return $this->error($response,$error);
       }

    }

}