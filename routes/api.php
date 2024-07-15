<?php

use App\Domain\Document\Controllers\DocumentController;
use App\Domain\File\Controllers\FileController;
use App\Domain\SignatureRequest\Controllers\SignatureRequestController;
use App\Domain\User\Controllers\UserController;
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

Route::prefix('/user')->group(function () {
    Route::post('register', [UserController::class, 'register']);
    Route::post('login', [UserController::class, 'login'])->name('login');
});

Route::middleware('auth:api')->prefix('/file')->group(function () {
   Route::post('upload', [FileController::class, 'uploadDocument']);
});

Route::middleware('auth:api')->prefix('/document')->group(function () {
    Route::post('add', [DocumentController::class, 'add']);
    Route::patch('sign', [DocumentController::class, 'sign']);
});

Route::middleware('auth:api')->prefix('/signature-request')->group(function () {
    Route::post('/', [SignatureRequestController::class, 'create']);
});
