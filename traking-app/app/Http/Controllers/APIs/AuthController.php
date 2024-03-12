<?php

namespace App\Http\Controllers\APIs;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function loginUser(Request $request)
    {
        try {
            $validateUser = Validator::make($request->all(),
            [
                'Matricule' => 'required',
                'password' => 'required'
            ]);

            if($validateUser->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 401);
            }

            if(!Auth::attempt($request->only(['Matricule', 'password']))){
                return response()->json([
                    'status' => false,
                    'message' => 'Email Or Password does not match with our record.',
                ], 401);
            }

            $user = User::where('Matricule', $request->Matricule)->first();

            return response()->json([
                'status' => true,
                'message' => 'User Logged In Successfully',
                'token' => $user->createToken("auth_token")->plainTextToken,
                "user"=>$user
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
    public function LogoutUser(){
        Auth()->user()->tokens()->delete();
        return response()->json([
            'status' => 200,
            'message'=>'User Logged Out Successfully'
        ]);
    }
}
