<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\CategoryController;
use App\Models\Categories;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::post('getCategoryById/{id}', [CategoryController::class, 'getCategoryById'])->middleware('verifyToken');
Route::group(['middleware'=>'verifyToken'], function() {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);

    Route::post('create', [CategoryController::class, 'create']);
Route::post('getAllCategories', [CategoryController::class, 'getAllCategories'])->middleware('LangSwitcher');

Route::post('update/{id}', [CategoryController::class, 'update']);
Route::post('delete/{id}', [CategoryController::class, 'delete']);
});




// Route::group(['namespace'=>'API'], function() {
//     Route::post('login', [AuthController::class, 'login']);
//     Route::post('register', [AuthController::class, 'register']);
// });