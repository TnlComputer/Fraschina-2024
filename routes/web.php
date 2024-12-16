<?php

use App\Http\Controllers\AgendaGralController;
use App\Http\Controllers\AgroController;
use App\Http\Controllers\DistribucionController;
use App\Http\Controllers\MolinoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\RepresentacionController;
use App\Http\Controllers\ToolController;
use App\Http\Controllers\TransporteController;
use App\Models\AgendaGral;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
  return view('welcome');
});

Route::get('/dashboard', function () {
  return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//   Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//   Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//   Route::patch('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.updatePassword');
//   Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

Route::middleware('auth')->get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::middleware('auth')->patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
Route::middleware('auth')->patch('/profile/email', [ProfileController::class, 'updateEmail'])->name('profile.updateEmail');
Route::middleware('auth')->patch('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.updatePassword');

Route::middleware('auth')->resource('/representacion', RepresentacionController::class);
Route::middleware('auth')->resource('/distribucion', DistribucionController::class);
Route::middleware('auth')->resource('/agro', AgroController::class);
Route::middleware('auth')->resource('/proveedor', ProveedorController::class);
Route::middleware('auth')->resource('/transporte', TransporteController::class);
Route::middleware('auth')->resource('/tools', ToolController::class);
Route::middleware('auth')->resource('/molino', MolinoController::class);
Route::middleware('auth')->resource('AgendaGral', AgendaGralController::class);

require __DIR__ . '/auth.php';