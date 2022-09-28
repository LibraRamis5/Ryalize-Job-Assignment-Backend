<?php

namespace App\Action\UserAction;

use PDO as DB;
use App\Action\Action;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

final class GetUserAction extends Action{

    public function __invoke(Request $request, Response $response): Response {  
        try{

            $sql = "SELECT * FROM users";
            $stmt =  $this->db->query($sql);
            $customers = $stmt->fetchAll(DB::FETCH_OBJ);  
            return $this->responce($response,$customers);           
        } catch (PDOException $e) {
            $error = array(
                    "message" => $e->getMessage()
                    );
            return $this->responce($error,500);  
       }
    }
}