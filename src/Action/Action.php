<?php

namespace App\Action;

use PDO as DB;
use Psr\Http\Message\ResponseInterface as Response;

class Action{

    public function __construct(DB $db)
    {
        $this->db = $db;                
    }

    public function responce(Response $response,$data, $code = 200) {
        $response->getBody()->write(json_encode($data));
        return $response
                ->withHeader('content-type', 'application/json')
                ->withStatus($code);
    }    
}