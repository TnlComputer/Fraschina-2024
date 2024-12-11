<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::create('distribucion_agenda', function (Blueprint $table) {
      $table->id();
      $table->date('fecha_ant')->nullable();
      $table->date('fecha')->nullable();
      $table->time('hs')->nullable();
      $table->unsignedBigInteger('prioridad_id')->nullable();
      $table->string('prioridad')->nullable();
      $table->unsignedBigInteger('accion_id')->nullable();
      $table->string('accion')->nullable();
      $table->longText('temas')->nullable();
      $table->string('cotizacion', 100)->nullable();
      $table->date('fecCotEnt')->nullable();
      $table->date('fecCot')->nullable();
      $table->unsignedBigInteger('producto_id')->nullable();
      $table->string('productos')->nullable();
      $table->time('desde')->nullable();
      $table->time('hasta')->nullable();
      $table->string('lunes', 2)->nullable();
      $table->string('sabado', 2)->nullable();
      $table->string('fac_imp', 2)->nullable();
      $table->longText('obs')->nullable();
      $table->unsignedBigInteger('distribucion_id')->nullable();
      $table->string('razonsocial')->nullable();
      $table->string('nombrefantasia')->nullable();
      $table->unsignedBigInteger('persona_id')->nullable();
      $table->string('nombre_per')->nullable();
      $table->string('apellido_per')->nullable();
      $table->unsignedBigInteger('tipoper_id')->nullable();
      $table->string('tipopersona')->nullable();
      $table->unsignedBigInteger('veraz_id')->nullable();
      $table->string('veraz')->nullable();
      $table->unsignedBigInteger('estado_id')->nullable();
      $table->string('Estado')->nullable();
      $table->unsignedBigInteger('contacto_id')->nullable();
      $table->string('contacto_inicial')->nullable();
      $table->unsignedBigInteger('cargo_id')->nullable();
      $table->string('cargo')->nullable();
      $table->longText('info')->nullable();
      $table->unsignedBigInteger('calle_id')->nullable();
      $table->string('calle')->nullable();
      $table->string('altura')->nullable();
      $table->string('dpto')->nullable();
      $table->string('piso')->nullable();
      $table->unsignedBigInteger('barrio_id')->nullable();
      $table->string('barrio')->nullable();
      $table->unsignedBigInteger('municipio_id')->nullable();
      $table->string('municipio')->nullable();
      $table->unsignedBigInteger('localidad_id')->nullable();
      $table->string('localidad')->nullable();
      $table->unsignedBigInteger('zona_id')->nullable();
      $table->string('zona')->nullable();
      $table->unsignedBigInteger('rubro_id')->nullable();
      $table->string('rubro')->nullable();
      $table->unsignedBigInteger('tamanio_id')->nullable();
      $table->string('tamanio')->nullable();
      $table->unsignedBigInteger('modo_id')->nullable();
      $table->string('modo')->nullable();
      $table->string('telefono')->nullable();
      $table->time('desde1')->nullable();
      $table->time('hasta2')->nullable();
      $table->string('auto')->nullable();
      $table->unsignedBigInteger('pedido_id')->nullable();
      $table->longText('obsEntrega')->nullable();
      $table->string('chofer')->nullable();
      $table->decimal('orden')->nullable();
      $table->string('pago')->nullable();
      $table->string('tpago')->nullable();
      $table->string('cobrar')->nullable();
      $table->decimal('estadoPedido', 10, 0)->nullable();
      $table->string('status', 1)->nullable();
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('distribucionagenda');
  }
};
