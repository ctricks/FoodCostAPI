<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\UploadProductController;
use App\Http\Controllers\Api\AuthController;

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

// Public accessible API
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Authenticated only API
// We use auth api here as a middleware so only authenticated user who can access the endpoint
// We use group so we can apply middleware auth api to all the routes within the group

//User Management Route
Route::middleware('auth:api')->group(function() {
    Route::get('/me', [UserController::class, 'me']);
});

Route::middleware('auth:api')->group(function() {
    Route::get('/UserDetails/{id}', [UserController::class, 'UserDetails']);
});

Route::middleware('auth:api')->group(function() {
    Route::get('/getAllUsers', [UserController::class, 'All']);
});

Route::middleware('auth:api')->group(function() {
    Route::put('/updateUser/{id}', [UserController::class, 'UpdateUser']);
});

Route::middleware('auth:api')->group(function() {
    Route::put('/updateUserDel/{id}', [UserController::class, 'UpdateUserDelete']);
});

Route::middleware('auth:api')->group(function() {
    Route::delete('/UserDelete/{id}', [UserController::class, 'UserDelete']);
});

Route::post('/logout', [AuthController::class, 'logout']);

//UM Route ends here

//Product Route
Route::middleware('auth:api')->group(function() {
    Route::post('/product/me', [ProductController::class, 'me']);
});

Route::middleware('auth:api')->group(function() {
    Route::post('/product/new', [ProductController::class, 'AddProduct']);
});

Route::get('/product/lists', [ProductController::class, 'getAllProduct']);

Route::get('/product/{id}', [ProductController::class, 'getProductByID']);

//Product Route ends here

//Product Upload Route
Route::post('/uploadproduct/me', [UploadProductController::class, 'me']);
Route::post('/uploadproduct/new', [UploadProductController::class, 'NewUpload']);
Route::post('/uploadproduct/check/{id}', [UploadProductController::class, 'CheckUpload']);

//Product Upload ends here