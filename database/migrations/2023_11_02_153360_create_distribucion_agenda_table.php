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
      $table->date('fecha')->nullable();
      $table->time('hs')->nullable();
      $table->unsignedBigInteger('prioridad_id')->nullable();
      $table->unsignedBigInteger('accion_id')->nullable();
      $table->longText('temas')->nullable();
      $table->string('cotizacion', 100)->nullable();
      $table->date('fecCotEnt')->nullable();
      $table->date('fecCot')->nullable();
      $table->unsignedBigInteger('producto_id')->nullable();
      $table->unsignedBigInteger('distribucion_id')->nullable();
      $table->unsignedBigInteger('persona_id')->nullable();
      $table->unsignedBigInteger('tipoper_id')->nullable();
      $table->unsignedBigInteger('veraz_id')->nullable();
      $table->unsignedBigInteger('estado_id')->nullable();
      $table->unsignedBigInteger('contacto_id')->nullable();
      $table->unsignedBigInteger('cargo_id')->nullable();
      $table->unsignedBigInteger('barrio_id')->nullable();
      $table->unsignedBigInteger('municipio_id')->nullable();
      $table->unsignedBigInteger('localidad_id')->nullable();
      $table->unsignedBigInteger('zona_id')->nullable();
      $table->unsignedBigInteger('rubro_id')->nullable();
      $table->unsignedBigInteger('tamanio_id')->nullable();
      $table->unsignedBigInteger('modo_id')->nullable();
      $table->unsignedBigInteger('pedido_id')->nullable();
      $table->integer('estadoPedido')->nullable();
      $table->string('status', 1)->nullable();
      $table->timestamps();

      // Relaciones
      $table->foreign('prioridad_id')->references('id')->on('auxprioridades')->onDelete('set null');
      $table->foreign('accion_id')->references('id')->on('auxacciones')->onDelete('set null');
      $table->foreign('producto_id')->references('id')->on('productos_c_d_a')->onDelete('set null');
      $table->foreign('distribucion_id')->references('id')->on('distribucions')->onDelete('set null');
      $table->foreign('persona_id')->references('id')->on('distribucion_personal')->onDelete('set null');
      $table->foreign('tipoper_id')->references('id')->on('auxtipopersonal')->onDelete('set null');
      $table->foreign('veraz_id')->references('id')->on('auxveraz')->onDelete('set null');
      $table->foreign('estado_id')->references('id')->on('auxestados')->onDelete('set null');
      $table->foreign('contacto_id')->references('id')->on('auxcontacto')->onDelete('set null');
      $table->foreign('cargo_id')->references('id')->on('auxcargos')->onDelete('set null');
      $table->foreign('barrio_id')->references('id')->on('auxbarrios')->onDelete('set null');
      $table->foreign('municipio_id')->references('id')->on('auxmunicipios')->onDelete('set null');
      $table->foreign('localidad_id')->references('id')->on('auxlocalidades')->onDelete('set null');
      $table->foreign('zona_id')->references('id')->on('auxzonas')->onDelete('set null');
      $table->foreign('rubro_id')->references('id')->on('auxrubros')->onDelete('set null');
      $table->foreign('tamanio_id')->references('id')->on('auxtamanio')->onDelete('set null');
      $table->foreign('modo_id')->references('id')->on('auxmodos')->onDelete('set null');
      $table->foreign('pedido_id')->references('id')->on('distribucion_nropedidos')->onDelete('set null');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('distribucion_agenda');
  }
};