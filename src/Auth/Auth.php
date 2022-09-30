<?php

namespace App\Auth;

use App\Models\User;
use Firebase\JWT\JWT;

class Auth{

	private static $user;
	public static $secret = 'sdasdasdasdasdasd';

	public static function setAuth($data){
		try{
			$user = User::findOrFail($data->data->user_id);
			Auth::$user = $user;
			return true;
		}catch(\Exception $e){
			return false;
		}
	}

	public static function login($user){
		$token = [
			"iat" => time(),
			"exp" => time() + 2592000,
			"data" => [
				"user_id" => $user->id
			]
		];

		return JWT::encode($token, Auth::$secret, 'HS256');
	}

	public static function user(){
		return Auth::$user;
	}

}