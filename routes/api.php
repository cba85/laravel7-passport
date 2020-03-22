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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:api', 'scope:admin')->get('admin', function () {
    return 'Administrator';
});

Route::middleware('auth:api', 'scope:manager')->get('manager', function () {
    return 'Manager';
});

Route::middleware('auth:api', 'scopes:admin,manager')->get('both', function () {
    return 'Administrator and Manager';
});
