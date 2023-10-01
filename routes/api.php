<?php

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PakanController;
use App\Http\Controllers\TurbidityController;
use App\Models\TurbidityTreshold;

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

Route::any('/turbidity', [TurbidityController::class, 'getTreshold']);

Route::any('/timer-feeder', [PakanController::class, 'getTimer']);

Route::any('/time', function (Request $req) {
    $request = $req->json()->all();
    Log::info($request);
    $now = Carbon::now();
    $data = [
        'year' => $now->year,
        'month' => $now->month,
        'date' => $now->day,
        'hour' => $now->hour,
        'minute' => $now->minute,
        'second' => $now->second,
    ];
    return response()->json($data);
});
