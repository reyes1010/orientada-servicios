<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiLibrosController;

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


Route::get("/libros",[ApiLibrosController::class,"index"]);
Route::post("/libros",[ApiLibrosController::class,"store"]);
Route::put("/libros/{id}",[ApiLibrosController::class,"update"]);
Route::get("/libros/{id}",[ApiLibrosController::class,"show"]);
Route::delete("/libros/{id}",[ApiLibrosController::class,"destroy"]);
