<?php

namespace App\Http\Controllers;

use App\Models\User;
use ErrorException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
//use MongoDB\Driver\Exception\AuthenticationException;

use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /**
     * @throws AuthenticationException
     */
    public function check_verification(Request $req){
        $user = User::where('phone', $req->phone)->get();
        return $user;
    }
    public function login(Request $req){
        if($req->verify){
            $user = User::where('phone', $req->phone)->first();
            $user->phone_verified = true;
            $user->save();
        }
        if(!Auth::attempt($req->only('phone','password'))){
            throw new AuthenticationException();
        }
    }
    public function register(Request $req){

        $validation = Validator::make($req->all(), [
            'name' => 'required|max:255',
            'phone' => 'required|unique:users|max:64'
        ]);
        if($validation->fails()){
            return response()->json(['errors' => $validation->errors(), 'error' => true]);
        }

        $user = new User;

        $user -> name = $req->name;
        $user -> phone = $req->phone;
        $user -> password = bcrypt($req->password);

        $user->save();

        return $user;
    }
    public function logout(Request $req){
        Auth::logout();
        $req -> session() -> invalidate();
        $req -> session() -> regenerateToken();
    }

}
