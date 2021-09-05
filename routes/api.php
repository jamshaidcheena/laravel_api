<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register',[App\Http\Controllers\ApiController::class,'validate_api']);
Route::post('login_sanctum',[App\Http\Controllers\ApiController::class,'login_api']);


Route::post('upload_api',[App\Http\Controllers\ApiController::class,'upload_api']);

Route::group(['middleware'=>'auth:sanctum'], function (){
    Route::get('get_api',[App\Http\Controllers\ApiController::class,'getData']);
    Route::get('get_api/{id}',[App\Http\Controllers\ApiController::class,'getData_id']);
    Route::post('submit_api',[App\Http\Controllers\ApiController::class,'post_api']);
    Route::put('update_api',[App\Http\Controllers\ApiController::class,'put_api']);
    Route::delete('delete_api/{id}',[App\Http\Controllers\ApiController::class,'delete_api']);
    Route::get('search_api/{name}',[App\Http\Controllers\ApiController::class,'search_api']);
    Route::post('validate_api',[App\Http\Controllers\ApiController::class,'validate_api']);

    Route::post('logout_sanctum',[App\Http\Controllers\ApiController::class,'logout_api']);
});



//Route::post('login',[App\Http\Controllers\ApiSanctumController::class,'index']);


//student api route
Route::post('student_submit',[App\Http\Controllers\StudentController::class,'store']);
Route::post('student_update/{id}',[App\Http\Controllers\StudentController::class,'update']);
Route::delete('student_delete/{id}',[App\Http\Controllers\StudentController::class,'delete']);

