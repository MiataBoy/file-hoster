<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/assets/upload', [\App\Http\Controllers\AssetController::class, 'assetUploader']);
Route::get('/assets/get', [\App\Http\Controllers\AssetController::class, 'assetRetriever']);
