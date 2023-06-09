<?php

use App\Http\Controllers\ProductController;
use App\Services\Format\JsonFormat;
use App\Services\Format\XmlFormat;
use App\Services\Platform\CimriPlatform;
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

Route::prefix('v1')->group(function() {
    Route::get('/products', [ProductController::class, 'index']);
});
