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
        Schema::create('auxmunicipios', function (Blueprint $table) {
            $table->id();
            $table->string('ciudadmunicipio')->nullable();
            $table->string('representaciones')->nullable();
            $table->string('distribuciones')->nullable();
            $table->string('molinos')->nullable();
            $table->string('proveedores')->nullable();
            $table->string('agros')->nullable();
            $table->string('transportes')->nullable();
            $table->string('agendas')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('auxmunicipios');
    }
};