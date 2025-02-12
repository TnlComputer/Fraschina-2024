<?php

use App\Http\Controllers\AccionController;
use App\Http\Controllers\AgendaGralController;
use App\Http\Controllers\AgroController;
use App\Http\Controllers\AgroPersonalController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\BarrioController;
use App\Http\Controllers\CalleController;
use App\Http\Controllers\CargoController;
use App\Http\Controllers\Contacto_inicialController;
use App\Http\Controllers\DistribucionAgendaController;
use App\Http\Controllers\DistribucionController;
use App\Http\Controllers\DistribucionPedidoController;
use App\Http\Controllers\DistribucionPersonalController;
use App\Http\Controllers\DistribucionProductoController;
use App\Http\Controllers\DistribucionRepartoController;
use App\Http\Controllers\DistribucionStockController;
use App\Http\Controllers\EstadoController;
use App\Http\Controllers\ExpedicionMolinosController;
use App\Http\Controllers\ExportarController;
use App\Http\Controllers\FamiliaController;
use App\Http\Controllers\HoraController;
use App\Http\Controllers\LocalidadController;
use App\Http\Controllers\ModoController;
use App\Http\Controllers\MolinoController;
use App\Http\Controllers\MolinoPersonalController;
use App\Http\Controllers\MunicipioController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PrioridadController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\ProveedorPersonalController;
use App\Http\Controllers\ProveedorProductoController;
use App\Http\Controllers\RepresentacionController;
use App\Http\Controllers\RepresentacionPersonalController;
use App\Http\Controllers\RepresentacionProductoController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RubroController;
use App\Http\Controllers\TamanioController;
use App\Http\Controllers\TareaController;
use App\Http\Controllers\Tipo_PersonaController;
use App\Http\Controllers\TransporteController;
use App\Http\Controllers\TransportePersonalController;
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
Route::middleware('auth')->group(function () {
  // Rutas para Agro Personal
  Route::get('/agro/{agro}/agro_personal/create', [AgroPersonalController::class, 'create'])
    ->name('agro_personal.create'); // Ruta personalizada para crear Agro Personal

  // Recurso para Agro Personal (excluyendo `create` porque ya tienes una ruta personalizada para ello)
  Route::resource('/agro/agro_personal', AgroPersonalController::class)
    ->except(['create']); // Excluir `create` porque ya está definida fuera del recurso
});


Route::middleware('auth')->group(function () {
  // Rutas para Distribución
  Route::resource('/distribucion', DistribucionController::class); // Maneja todas las rutas RESTful para Distribución
  // Rutas para Distribución Personal

  Route::get('/distribucion/{distribucion}/distribucion_personal/create', [DistribucionPersonalController::class, 'create'])
    ->name('distribucion_personal.create'); // Ruta personalizada para crear Distribución Personal

  Route::resource('/distribucion/distribucion_personal', DistribucionPersonalController::class)
    ->except(['create']); // Excluir `create` porque ya está definida por separado

  // Rutas para Distribución Producto
  Route::get('/distribucion/{distribucion}/distribucion_producto/create', [DistribucionProductoController::class, 'create'])
    ->name('distribucion_producto.create'); // Ruta personalizada para crear Distribución Producto
    
  Route::resource('/distribucion/distribucion_producto', DistribucionProductoController::class)
    ->except(['create']); // Excluir `create` porque ya está definida por separado

});

// Rutas para Distribución Agenda
Route::middleware(['auth'])->group(function () {
  Route::get('distribucion_agenda/create', [DistribucionAgendaController::class, 'create'])
    ->name('distribucion_agenda.create');

  Route::resource('distribucion_agenda', DistribucionAgendaController::class)->except(['create']);

  Route::get('distribucion_agenda/{id}/personal', [DistribucionAgendaController::class, 'getPersonal'])->name('distribucion.getPersonal');
});

// Rutas para Distribucion Pedidos
Route::middleware('auth')->resource('distribucion_pedido', DistribucionPedidoController::class);
Route::get('/productos-y-tareas-por-cliente/{clienteId}', [DistribucionPedidoController::class, 'getProductosYTareasPorCliente']);
Route::get('/distribucion/{id}/productos-tareas', [DistribucionPedidoController::class, 'getProductosTareas']);
Route::get('/producto/{nombre}/iva', function ($nombre) {
  $producto = \App\Models\ProductoCda::where('nomproducto', $nombre)->first();
  return response()->json(['ivacda' => $producto ? $producto->ivacda : 0]);
});

// Rutas para Distribucion Reparto
Route::middleware('auth')->resource('distribucion_reparto', DistribucionRepartoController::class);

Route::get('/distribucion/pedidos/{id}/imprimirRecibo', [DistribucionRepartoController::class, 'imprimirRecibo'])->name('distribucion_reparto.imprimirRecibo');

Route::get('/convertir-letras/{numero}/{moneda}', [DistribucionRepartoController::class, 'convertirNumeroALetras']);

Route::get(
  '/distribucion/reparto/imprimir',
  [DistribucionRepartoController::class, 'imprimirReparto']
)->name('distribucion_reparto.imprimirReparto');

Route::get('/distribucion/reparto/control', [DistribucionRepartoController::class, 'imprimirControl'])->name('distribucion_reparto.imprimirControl');

// Rutas para Distribucion Stock
Route::middleware('auth')->resource('distribucion_stock', DistribucionStockController::class);


// Rutas para Molinos
Route::middleware('auth')->resource('/expedicion_molinos', ExpedicionMolinosController::class);

Route::middleware('auth')->resource('/molino', MolinoController::class);
Route::middleware('auth')->group(function () {
  // Rutas para Molino Personal
  Route::get('/molino/{molino}/molino_personal/create', [MolinoPersonalController::class, 'create'])
    ->name('molino_personal.create'); // Ruta personalizada para crear Molino Personal

  // Recurso para Molino Personal (excluyendo `create` porque ya tienes una ruta personalizada para ello)
  Route::resource('/molino/molino_personal', MolinoPersonalController::class)
    ->except(['create']); // Excluir `create` porque ya está definida fuera del recurso
});

// Rutas para Proveedores
Route::middleware('auth')->resource('/proveedor', ProveedorController::class);

Route::middleware('auth')->group(function () {
  Route::get('/proveedor/{proveedor}/proveedor_personal/create', [ProveedorPersonalController::class, 'create'])
    ->name('proveedor_personal.create');

  Route::resource('/proveedor/proveedor_personal', ProveedorPersonalController::class)
    ->except(['create']);
});

Route::middleware('auth')->group(function () {
  Route::get('/proveedor/{proveedor}/proveedor_producto/create', [ProveedorProductoController::class, 'create'])
    ->name('proveedor_producto.create');

  Route::resource('/proveedor/proveedor_producto', ProveedorProductoController::class)
    ->except(['create']);
});

// Rutas para Representaciones
Route::middleware('auth')->resource('/representacion', RepresentacionController::class);
Route::middleware('auth')->group(function () {
  Route::get('/representacion/{representacion}/representacion_personal/create', [RepresentacionPersonalController::class, 'create'])
    ->name('representacion_personal.create');

  Route::resource('/representacion/representacion_personal', RepresentacionPersonalController::class)
    ->except(['create']); // Excluir la acción `create` del recurso predeterminado
});

Route::middleware('auth')->group(function () {
  Route::get('/representacion/{representacion}/representacion_producto/create', [RepresentacionProductoController::class, 'create'])
    ->name('representacion_producto.create');

  Route::resource('/representacion/representacion_producto', RepresentacionProductoController::class)
    ->except(['create']); // Excluir la acción `create` del recurso predeterminado
});

// Rutas para Transportes
Route::middleware('auth')->resource('/transporte', TransporteController::class);
Route::middleware('auth')->group(function () {
  // Rutas para  Personal
  Route::get('/transporte/{transporte}/transporte_personal/create', [TransportePersonalController::class, 'create'])
    ->name('transporte_personal.create'); // Ruta personalizada para crear  Personal

  // Recurso para transporte Personal (excluyendo `create` porque ya tienes una ruta personalizada para ello)
  Route::resource('/transporte/transporte_personal', TransportePersonalController::class)
    ->except(['create']); // Excluir `create` porque ya está definida fuera del recurso
});


// TOOLS
Route::middleware('auth')->resource('/tools/usuarios', UsuarioController::class);
Route::middleware('auth')->put('/tools/usuarios/{id}/activate', [UsuarioController::class, 'activate'])->name('usuarios.activate');

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

// Roles
Route::middleware('auth')->resource('/tools/roles', RoleController::class);

// Permisos
Route::middleware('auth')->resource('/tools/permissions', PermissionController::class);

// EXPORTAR TABLAS
Route::middleware('auth')->get('/tools/export', [ExportarController::class, 'selectTables'])->name('export.selectTables');
Route::middleware('auth')->post('/export/generate', [ExportarController::class, 'generate'])->name('export.generate');

require __DIR__ . '/auth.php';