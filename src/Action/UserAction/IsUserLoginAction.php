<?php
namespace App\Action\UserAction;

use App\Action\Action;
use Illuminate\Support\Facades\Hash;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Models\User;

final class IsUserLoginAction extends Action
{
    public function __invoke(Request $request, Response $response): Response{

        try{
            return $this->responce($response, null, 500);

        }catch(\Exception $e){
            return $this->error($response, $e->getMessage());
        }

    }
}
    
