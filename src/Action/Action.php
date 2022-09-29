<?php

namespace App\Action;

use Psr\Http\Message\ResponseInterface as Response;

class Action{

    public function __construct()
     {
             
    }

    public function success(Response $response,$data) {
        return $this->responce($response,$data,200);
    }   

    public function responce(Response $response,$data, $code) {
        $response->getBody()->write(json_encode($data));
        return $response
                ->withHeader('content-type', 'application/json')
                ->withStatus($code);
    }   
    
    public function error(Response $response,$data) {
        $data = array( "message" => $data );        
        return $this->responce($response,$data,500);
    }  
}