<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('user')->middleware('middleware.authorization')->group(function () {
    Route::post('/insert', [UserController::class, "insert"]);
    Route::get('/list', [UserController::class, "list"]);
    Route::put('/update/{username?}', [UserController::class, "update"]);
    Route::delete('/delete/{username?}', [UserController::class, "delete"]);
    Route::delete('/destroy/{username?}', [UserController::class, "destroy"]);
});
