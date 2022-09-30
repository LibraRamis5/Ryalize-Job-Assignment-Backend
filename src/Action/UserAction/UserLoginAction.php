<?php
namespace App\Action\UserAction;

use App\Action\Action;
use App\Auth\Auth;
use Illuminate\Support\Facades\Hash;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Models\User;

final class UserLoginAction extends Action
{
    public function __invoke(Request $request, Response $response): Response{

        $data = (array)$request->getParsedBody();

        $validation = $this->validate($data, [
            'email' => 'required|email',
            'password' =>  'required|min:8|regex:/[a-z]/|regex:/[A-Z]/|regex:/[0-9]/|regex:/[@$!%*#?&]/'
        ]);

        if($validation){
            return $this->responce($response, $validation, 401);
        }

        try{

            $userObject = User::where('email',$data['email'])->first();
            if ($userObject){
                $result = Auth::login($userObject);
                $userObject->token = $result;
                return $this->responce($response, $userObject, 200);

            }else{
                $errorMessage['message'] = 'user name or password is invalid';
                return $this->responce($response, $errorMessage, 200);
            }

        }catch(\Exception $e){
            return $this->error($response, $e->getMessage());
        }

    }
}
    
