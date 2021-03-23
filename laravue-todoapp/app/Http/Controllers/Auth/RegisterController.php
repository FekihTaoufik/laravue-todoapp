<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Hash;
use JWTAuth;
use App\User;
use Exception;

class RegisterController extends Controller
{

    /**
     * Register users
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request){
        
        $this->validateRequest($request);
        
        try{
            
            //Create User
            $user = $this->createUser($request);
            
            //authenticate the user
            $token = JWTAuth::fromUser($user);

            //return the auth token
            return response()->json($token);

        }catch(Exception $e){
        
            return response()->json($e);
        
        }
    }

    /**
     * Validate the request.
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    private function validateRequest(Request $request){
        $this->validate($request,[
            'name'  => 'required|string|min:3|max:255',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|string|min:5|max:255'
        ]);
    }

    /**
     * Create user
     *
     * @param \Illuminate\Http\Request $request
     * @return \App\User
     */
    private function createUser(Request $request){
        return User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
    }
}
