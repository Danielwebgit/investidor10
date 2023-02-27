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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['middleware' => ['apiJwt']], function(){
    Route::get('users', [UserController::class, 'index']);
    Route::post('logout', [AuthController::class,'logout']);
    Route::post('refresh', [AuthController::class,'refresh']);
    Route::post('me', [AuthController::class, 'me']);
});

/** Group products v1 */
Route::prefix('posts')->group(function (){
    Route::get('/', [PostController::class, 'index']);
    Route::get('/show/{id}', [PostController::class, 'show']);
    Route::post('/store', [PostController::class, 'store']);
    Route::put('/update/{id}', [PostController::class, 'update']);
    Route::delete('/destroy/{id}', [PostController::class, 'destroy']);
});

Route::post('/users/store', [UserController::class, 'store']);

Route::post('auth/login', [AuthController::class, 'login']);
