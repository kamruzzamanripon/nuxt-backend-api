<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\userRegisterRequest;
use App\User;
use http\Env\Response;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Resource_;

class AuthController extends Controller
{
    public function register(userRegisterRequest $request)
    {


        $user = User::create([
            'email'      => $request->email,
            'name'       => $request->name,
            'password'   => bcrypt($request->password),
        ]);

        if(!$token = auth()->attempt($request->only(['email', 'password']))){
            return abort(401);
        }


        return (new \App\Http\Resources\User($request->user()))->additional([
            'meta' => [
                'token' =>$token
            ]
        ]);
    }

    public function login(UserLoginRequest $request)
    {
        if(!$token = auth()->attempt($request->only(['email', 'password']))){
            return response()->json([
               'errors' => [
                   'email' => 'Sorry we cant find you with those details'
               ]
            ], 422);
        }


        return (new \App\Http\Resources\User($request->user()))->additional([
            'meta' => [
                'token' =>$token
            ]
        ]);
    }

    public function user(Request $request)
    {
        return new \App\Http\Resources\User($request->user());
    }

    public function logout()
    {
        auth()->logout();
    }


}
