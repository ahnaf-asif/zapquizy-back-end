<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
//use MongoDB\Driver\Exception\AuthenticationException;

class AuthController extends Controller
{
    /**
     * @throws AuthenticationException
     */
    public function login(Request $req){
        if(!Auth::attempt($req->only('email','password'))){
            throw new AuthenticationException();
        }
//        return $req->email;
    }
    public function register(Request $req){
        $user = new User;
        $user -> name = $req->name;
        $user -> email = $req->email;
        $user -> phone = $req->phone;
        $user -> password = bcrypt($req->password);

        $user->save();
    }
    public function logout(Request $req){
        Auth::logout();
        $req -> session() -> invalidate();
        $req -> session() -> regenerateToken();
    }

}
