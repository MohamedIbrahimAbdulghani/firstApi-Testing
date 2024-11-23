<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request) {
        $validationRules = [
            "name"=>"required|string|min:3",
            "email"=>"required|email|unique:users",
            "password"=>"required|min:6"
        ];
        $validation = Validator::make($request->all(), $validationRules);
        if($validation->fails()):
            $code = $this->returnCodeAccordingToInput($validation);
            return $this->returnValidationError($validation, $code);
        endif;
        $users = User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
        ]);
        if($users):
            return $this->login($request);
        else:
            return response()->json(['message'=>'User Not Found']);
        endif;
    }

    public function login(Request $request) {
        $validationRules = [
            "email"=>"required|email",
            "password"=>"required"
        ];
        $validation = Validator::make($request->all(), $validationRules);
        if($validation->fails()):
            $code = $this->returnCodeAccordingToInput($validation);
            return $this->returnValidationError($validation, $code);
        endif;
        $myInputs = $request->only(['email', 'password']);
        $token = Auth::guard("api")->attempt($myInputs); // this is line to return my token
        if(!$token):
            return response()->json(['message'=>'Not Found Token']);
        endif;
        $user = Auth::guard('api')->user();
        $user->token = $token;
        return response()->json(['message'=>$user]);
    }



}