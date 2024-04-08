<?php

namespace App\Http\Controllers\APIs;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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


    public function update_Image_Profile(Request $request)
    {
        try {
            // Validate the incoming request
            $validateUser = $request->validate([
                "image" => "required|string",
                "matricule"=>"required|string"
            ]);

            // Retrieve the base64 encoded image data from the request
            $imageData = $request->input("image");
            $matricule = $request->input("matricule");

            // Decode the base64 string
            $decodedImageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $imageData));

            // Generate a unique filename
            $imageName = "image_" . time() . ".png";

            $user = User::where("Matricule",$matricule);

            // Save the image to the "Images" folder within the "public" directory
            file_put_contents(public_path("Images/" . $imageName), $decodedImageData);


            // Generate the image URL
            $imageUrl = asset("Images/" . $imageName);

            $affected = DB::table('users')
                    ->where('matricule', $matricule)
                    ->update(['Image' => $imageUrl]);

        if ($affected == 0) {
            throw new \Exception("User not found with matricule: " . $matricule);
        }

            // Return a JSON response indicating successful image upload along with the image URL
            return response()->json([
                "message" => "Image uploaded successfully",
                "imageUrl" => $imageUrl
            ]);
        } catch (\Exception $e) {
            // Return a JSON response with an error message if an exception occurs
            return response()->json([
                "error" => "Image upload failed: " . $e->getMessage()
            ], 500);
        }
    }

}

