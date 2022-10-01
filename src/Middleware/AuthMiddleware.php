<?php

namespace App\Middleware;

use App\Auth\Auth;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Psr7\Response;
use \Firebase\JWT\JWT;

class AuthMiddleware{

    public function __invoke(Request $request, RequestHandler $handler): Response
    {
        $response = $handler->handle($request);
        $header = $request->getHeaderLine("Authorization");

        if (false === empty($header)) {
            if (preg_match("/Bearer\s+(.*)$/i", $header, $matches)) {
                try{
                    $decoded = JWT::decode($matches[1], Auth::$secret, 'HS256');
                    if(!Auth::setAuth($decoded)){
                        $response = $this->error(["error" => "Invalid Token."]);
                    }
                    else
                        $response = $handler->handle($request);
                }catch(\Exception $e)
                {
                     $response = $this->error(["error" => $e->getMessage()]);
                }
            }
        }
        else{
            $response = $this->error(["error" => "Auth token cannot find."]);             
        } 
        
        return $response;
    }

    public function error($data) {
        $response = new Response();

             $response->getBody()->write(json_encode($data));
             $response = $response->withHeader('content-type', 'application/json')->withStatus(401);
             return $response;
    }
}


//        $token = [
//"iat" => time(),
//"exp" => time() + 2592000,
//"data" => [
//"user_id" => 2
//]
//];
//$jwt = JWT::encode($token, Auth::$secret);
//return $this->error(["error" => $jwt]);