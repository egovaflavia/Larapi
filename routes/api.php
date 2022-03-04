<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\TransactionController;
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

// Route::get('/transaction', [TransactionController::class, 'index']);
// Route::post('/transaction', [TransactionController::class, 'store']);
// Route::get('/transaction/{id}', [TransactionController::class, 'show']);
// Route::put('/transaction/{id}', [TransactionController::class, 'update']);
// Route::delete('/transaction/{id}', [TransactionController::class, 'destroy']);

Route::resource('/transaction', TransactionController::class)->except('edit', 'create');

/**
 * Auth Sanctum
 */
//API route for register new user
Route::post('/register', [AuthController::class, 'register']);
//API route for login user
Route::post('/login', [AuthController::class, 'login']);

// Protectong Routes
Route::group(['middleware' => ['auth:sanctum']], function(){
    Route::get('/profile', function(){
        return auth()->user();
    });
    Route::post('/logout', [AuthController::class, 'logout']);
});

