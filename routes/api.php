<?php

use App\Http\Controllers\Api\EventController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('event', [EventController::class, 'index']);
Route::post('event', [EventController::class, 'store']);
Route::put('event/{event}', [EventController::class, 'update'])
    ->missing(function() {
        return response()->json([
            'status' => false,
            'message' => "Event not found!"
        ], 404);
    });
Route::delete('event/{event}', [EventController::class, 'destroy'])
    ->missing(function() {
        return response()->json([
            'status' => false,
            'message' => "Event not found!"
        ], 404);
    });
Route::get('event/{event}', [EventController::class, 'show'])
    ->missing(function() {
        return response()->json([
            'status' => false,
            'message' => "Event not found!"
        ], 404);
    });