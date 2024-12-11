<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('expedicion_molinos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('nroMolino_id')->nullable();
            $table->string('calificacion', 200)->nullable();
            $table->string('sigla', 1)->nullable();
            $table->string('nroUPed', 10)->nullable();
            $table->string('contMolino', 255)->nullable();
            $table->string('estadoNroPedido', 1)->nullable();
            $table->unsignedBigInteger('nroCliente_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expedicion_molinos');
    }
};