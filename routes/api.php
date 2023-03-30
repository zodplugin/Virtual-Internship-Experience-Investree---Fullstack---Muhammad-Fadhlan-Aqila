<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticlesController;
use App\Http\Controllers\PassportController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::post('v1/login',[PassportController::class,'login']);
Route::post('v1/register',[PassportController::class,'register']);

Route::middleware('auth:api')->get('v1/all',[PassportController::class,'users']);

// Articles
Route::middleware('auth:api')->post('v1/articles/create',[ArticlesController::class,'createAPI']);
Route::middleware('auth:api')->get('v1/articles/',[ArticlesController::class,'listAll']);
Route::middleware('auth:api')->get('v1/articles/edit/{id}',[ArticlesController::class,'showAPI']);
Route::middleware('auth:api')->put('v1/articles/edit/{id}',[ArticlesController::class,'updateAPI']);
Route::middleware('auth:api')->post('v1/articles/edit/{id}',[ArticlesController::class,'updateAPI']);
Route::middleware('auth:api')->delete('v1/articles/{id}',[ArticlesController::class,'deleteAPI']);
