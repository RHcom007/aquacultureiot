<?php

use App\Models\Turbidity;
use App\Models\PakanTimer;
use Illuminate\Support\Carbon;
use App\Models\TurbidityTreshold;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PakanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TurbidityController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $datatimer = PakanTimer::where('time','>',Carbon::now())->orderBy('time','ASC')->get();
    $turbidity = Turbidity::latest()->first();
    $turbiditystatus = "Normal";
    $tturbidity = \App\Models\TurbidityTreshold::latest()->first();
    if($turbiditystatus < $tturbidity->tturbidity){
        $turbiditystatus = "Keruh";
    }
    return view('dashboard',[
        'timer'=>$datatimer,
        'turbidity'=>$turbidity,
        'turbiditystatus'=> $turbiditystatus,
        'tturbidity'=>$tturbidity
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard/timer-setting', [PakanController::class, 'create'])->name('tambah-timer');
Route::post('/dashboard/timer-setting', [PakanController::class, 'insert'])->name('tambah-timer-post');
Route::post('/dashboard/set-turbidity', [TurbidityController::class, 'setTreshold'])->name('tambah-timer-post');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
