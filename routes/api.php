<?php

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
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

Route::any('/turbidity', function (Request $req) {
    $request = $req->json()->all();
    // Log::info($request);
    if ($request['turbidity']) {
        App\Models\Turbidity::create([
            'data' => $request['turbidity'],
            'token' => $request['token']
        ]);
        $data = [
            'tturbidity' => 400
        ];
        return response()->json($data);
    } else {
        return abort(400, 'Data Invalid');
    }
});

Route::any('/timer-feeder', function (Request $req) {
    $request = $req->json()->all();
    Log::info($request);
    if ($request['getTimer']) {
        $data = [
            'timerfeeder' => "123617"
        ];
        return response()->json($data);
    } else {
        return abort(400, 'Data Invalid');
    }
});

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
