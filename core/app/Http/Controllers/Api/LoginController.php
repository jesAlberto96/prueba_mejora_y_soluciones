<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Api\ResponseController;
use Validator;

class LoginController extends Controller
{
    public $response;

    public function __construct(){
        $this->response = new ResponseController;
    }

    public function login(Request $request){
        $validator = $this->validateLogin($request);

        if($validator->fails()){
            return $this->response->sendError('Validation Error.', $validator->errors());
        }

        if (Auth::attempt($request->only('email', 'password'))){
            return $this->response->sendResponse(["token" => $request->user()->createToken($request->device)->plainTextToken], "Login successful");
        }

        return $this->response->sendError("Unathorized", 401);
    }

    public function validateLogin(Request $request){
        return Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
            'device' => 'required',
        ]);
    }
}