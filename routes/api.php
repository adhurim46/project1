<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use GuzzleHttp;

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

Http::get('/download', [DownloadRequestController::class, 'downloadRequests']);
Http::get('/upload', [UploadRequestController::class  ,'uploadfile']);


Http::post('/fileserver/download', [FileServerController::class, 'download']);
Http::post('/fileserver/upload', [FileServerController::class, 'upload']);
