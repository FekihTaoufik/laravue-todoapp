<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class LoginController extends Controller
{

    /**
     * authenticate the user and return the
     * auth token.
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function authenticate(Request $request){
      
      //validation
      $this->validateRequest($request);
      
      $credentials = $request->only('email','password');
      
      try{
        //If authentication fails
        if(!$token = JWTAuth::attempt($credentials)){
          return $this->response('Invalid Credentials',400);
        }
      }catch(JWTException $e){
        return $this->response('Could not create token!',500);
      }
      //authenticated
      return response()->json($token,200);
    }

    public function getAuthenticatedUser(Request $request)
    {
        try {
          if (! $user = JWTAuth::parseToken()->authenticate()) {
            return response()->json(['user_not_found'], 404);
          }

        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
          return response()->json(['token_expired'], $e->getStatusCode());

        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
          return response()->json(['token_invalid'], $e->getStatusCode());

        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {
          return response()->json(['token_absent'], $e->getStatusCode());
        }

        return response()->json([
            'user' => $user
        ],200);
    }

    /**
     * Invalidate the auth token (logging user out)
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request){
        //validate the request
        $this->validate($request,[
          'token' => 'required|string'
        ]);
        
        //invalidate the token
        JWTAuth::parseToken($request->token)->invalidate();

        return response()->json([
            'msg' => 'logout success!'
        ],200);
    }

    /**
     * Validate the request.
     * 
     * @param \Illuminate\Http\Request $request
     * @return void
     */
    private function validateRequest(Request $request){
        $this->validate($request,[
            'email' => 'required|email|exists:users|max:255',
            'password' => 'required|string|max:255'
        ]);
    }

}
