<?php

namespace App\Actions\Auth;

use Venoudev\Results\Contracts\Result;
use App\Exceptions\FailLoginException;
use App\Entities\User;
use Illuminate\Support\Facades\Hash;
use Auth;

class LoginAction{


    public static function execute($data ){

        $user = User::where('email', $data['email'])->first();

        if($user == null){
            $exception = new FailLoginException();
            throw $exception;
        }
        if (Hash::check($data['password'], $user->password) == false) {
            $exception = new FailLoginException();
            throw $exception;
        }
        $accessToken = $user->createToken('auth_token')->accessToken;
        $user->access_token = $accessToken;
        $user->roles = $user->getRoleNames()->all();

        return $user;

    }

}
