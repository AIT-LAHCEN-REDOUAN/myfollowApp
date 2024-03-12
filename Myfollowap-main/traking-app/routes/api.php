<?php

use App\Http\Controllers\APIs\AuthController;
use App\Http\Controllers\APIs\ColieAPIController;
use App\Http\Controllers\SuiviTracabilite_API;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get("/colies/{Reference}",[ColieAPIController::class,"get_by_reference"])->middleware("auth:sanctum");
Route::get("/all_destinataires",[ColieAPIController::class,"get_all_destinataire"])->middleware("auth:sanctum");
//Route::get("/all_fournisseurs",[ColieAPIController::class,"get_all_fournisseur"])->middleware("auth:sanctum");


Route::post('/login', [AuthController::class,'loginUser']);
Route::post("/logout",[AuthController::class,"LogoutUser"])->middleware("auth:sanctum");


// VALIDER :  IN OUT RETOUR 
Route::post("/saveInOperation",[ColieAPIController::class,"saveInOperation"])->middleware("auth:sanctum");
Route::post("/saveOutOperation",[ColieAPIController::class,"saveOutOperation"])->middleware("auth:sanctum");
Route::post("/saveRetourOperation",[ColieAPIController::class,"saveRetourOperation"])->middleware("auth:sanctum");
 
//NON VALIDER : 
Route::post("/NonValider",[ColieAPIController::class,"NonValider"])->middleware("auth:sanctum");

