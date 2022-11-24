<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', function() {
    $email = request()->email;
    $password = request()->password;

    $user = App\Models\User::where('email', $email)->first();
    if(!$user) return response("Incorrect Email", 404);

    if(password_verify($password, $user->password)){
        return $user->createToken("chrome")->plainTextToken;
    }
    return response("Incorrect Password", 404);
});

Route::delete('/logout', function(){
    request()->yser()->tokens()->delete();
    return "Logout success";
})->middleware('auth:sanctum');
Route::apiResource('/categories', CategoryApiController::class)->middleware('auth:sanctum');
