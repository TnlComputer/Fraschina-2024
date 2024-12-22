<?php

use App\Http\Controllers\AccionController;
use App\Http\Controllers\AgendaGralController;
use App\Http\Controllers\AgroController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\BarrioController;
use App\Http\Controllers\CalleController;
use App\Http\Controllers\CargoController;
use App\Http\Controllers\Contacto_inicialController;
use App\Http\Controllers\DistribucionController;
use App\Http\Controllers\EstadoController;
use App\Http\Controllers\ExpedicionMolinosController;
use App\Http\Controllers\ExportarController;
use App\Http\Controllers\FamiliaController;
use App\Http\Controllers\HoraController;
use App\Http\Controllers\LocalidadController;
use App\Http\Controllers\ModoController;
use App\Http\Controllers\MolinoController;
use App\Http\Controllers\MunicipioController;
use App\Http\Controllers\PrioridadController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\RepresentacionController;
use App\Http\Controllers\RubroController;
use App\Http\Controllers\TamanioController;
use App\Http\Controllers\TareaController;
use App\Http\Controllers\Tipo_PersonaController;
use App\Http\Controllers\TransporteController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\VerazController;
use App\Http\Controllers\ZonaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
  return view('welcome');
});

Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');

Route::get('/dashboard', function () {
  return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// PROFILE
Route::middleware('auth')->get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::middleware('auth')->patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
Route::middleware('auth')->patch('/profile/email', [ProfileController::class, 'updateEmail'])->name('profile.updateEmail');
Route::middleware('auth')->patch('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.updatePassword');

// PRINCIPAL
Route::middleware('auth')->resource('/AgendaGral', AgendaGralController::class);
Route::middleware('auth')->resource('/agro', AgroController::class);
Route::middleware('auth')->resource('/distribucion', DistribucionController::class);
Route::middleware('auth')->resource('/expedicion_molinos', ExpedicionMolinosController::class);
Route::middleware('auth')->resource('/molino', MolinoController::class);
Route::middleware('auth')->resource('/proveedor', ProveedorController::class);
Route::middleware('auth')->resource('/representacion', RepresentacionController::class);
Route::middleware('auth')->resource('/transporte', TransporteController::class);

// TOOLS
Route::middleware('auth')->resource('/tools/usuarios', UsuarioController::class);
Route::middleware('auth')->resource('/tools/calles', CalleController::class);
Route::middleware('auth')->resource('/tools/barrios', BarrioController::class);
Route::middleware('auth')->resource('/tools/ciudades_municipios', MunicipioController::class);
Route::middleware('auth')->resource('/tools/localidades', LocalidadController::class);
Route::middleware('auth')->resource('/tools/zonas', ZonaController::class);
Route::middleware('auth')->resource('/tools/familias', FamiliaController::class);
Route::middleware('auth')->resource('/tools/rubros', RubroController::class);
Route::middleware('auth')->resource('/tools/cargos', CargoController::class);
Route::middleware('auth')->resource('/tools/modos', ModoController::class);
Route::middleware('auth')->resource('/tools/dimension', TamanioController::class)->names('tamanios');
Route::middleware('auth')->resource('/tools/areas', AreaController::class);
Route::middleware('auth')->resource('/tools/horas', HoraController::class);
Route::middleware('auth')->resource('/tools/contacto_inicial', Contacto_inicialController::class);
Route::middleware('auth')->resource('/tools/prioridades', PrioridadController::class);
Route::middleware('auth')->resource('/tools/estados', EstadoController::class);
Route::middleware('auth')->resource('/tools/tipo_persona', Tipo_PersonaController::class);
Route::middleware('auth')->resource('/tools/acciones', AccionController::class);
Route::middleware('auth')->resource('/tools/veraz', VerazController::class);
Route::middleware('auth')->resource('/tools/tareas', TareaController::class);

// EXPORTAR TABLAS
Route::middleware('auth')->get('/tools/export', [ExportarController::class, 'selectTables'])->name('export.selectTables');
Route::middleware('auth')->post('/export/generate', [ExportarController::class, 'generate'])->name('export.generate');



require __DIR__ . '/auth.php';
