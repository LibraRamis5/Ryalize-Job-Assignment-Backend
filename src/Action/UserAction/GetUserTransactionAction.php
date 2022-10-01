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

            $requestParams = $request->getQueryParams();
            $validation = $this->validate($requestParams, [
                'per_page' => 'required|integer',
                'page' => 'required|integer',
            ]);

            if($validation){
                return $this->responce($response, $validation, 401);
            }

            $transactions = ViewUserTransaction::query();

            if (!empty($requestParams['user_id'])){
                $transactions = $transactions->where('user_id', $requestParams['user_id']);
            }

            if (!empty($requestParams['location_id'])){
                $transactions = $transactions->where('location_id', $requestParams['location_id']);
            }

            $transactions = $transactions->paginate($requestParams['per_page'], ['*'], 'page', $requestParams['page']);
            $data = ['message' => 'user transactions', 'data' => $transactions];

            return $this->success($response,$data);

        } catch (\Exception $e) {
            return $this->error($response, $e->getMessage());
       }

    }

}