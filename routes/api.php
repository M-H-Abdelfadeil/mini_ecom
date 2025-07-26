<?php

use App\Http\Controllers\Api\Client\CategoryController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });



// Group routes related to client operations
Route::group(['prefix' => 'client'], function () {

    /*
    |--------------------------------------------------------------------------
    | Category Routes
    |--------------------------------------------------------------------------
    |
    | These routes are used to handle category-related requests from the client.
    | - GET /client/categories                      → Fetch all parent categories.
    | - GET /client/categories/sub/{id}             → Fetch subcategories of a given category.
    | - GET /client/categories/sub-with-paginate/{id} → Fetch subcategories with pagination.
    |
    */

    Route::group(['prefix' => 'categories'], function () {

        Route::get('/', [CategoryController::class, 'index']);
        Route::get('sub/{category}', [CategoryController::class, 'sub']);
        Route::get('sub-with-paginate/{category}', [CategoryController::class, 'sub_with_paginate']);
    });
});
