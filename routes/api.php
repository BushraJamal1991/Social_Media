<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\AuthController;


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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
  //  return $request->user();
//});


Route::post('register',[AuthController::class,'register']);
Route::post('login', [AuthController::class,'login']);
Route::post('refresh', [AuthController::class,'refresh']);
Route::post('logout', [AuthController::class,'logout']);

Route::get('/categories',[CategoryController::class,'index']);
Route::get('/category/{id}',[CategoryController::class,'show']);
Route::post('/categories',[CategoryController::class,'store']);
Route::post('/category/{id}',[CategoryController::class,'update']);
Route::post('/categories/{id}}',[CategoryController::class,'destroy']);

Route::get('/posts',[PostController::class,'index']);
Route::get('/post/{id}',[PostController::class,'show']);
Route::post('/posts',[PostController::class,'store']);
Route::post('/post/{id}',[PostController::class,'update']);
Route::post('/posts/{id}}',[PostController::class,'destroy']);



Route::get('/comments',[CommentController::class,'index']);
Route::get('/comment/{id}',[CommentController::class,'show']);
Route::post('/comments',[CommentController::class,'store']);
Route::post('/comment/{id}',[CommentController::class,'update']);
Route::post('/comments/{id}}',[CommentController::class,'destroy']);


