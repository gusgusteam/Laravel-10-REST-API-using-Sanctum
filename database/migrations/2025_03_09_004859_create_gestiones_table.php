<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('gestiones', function (Blueprint $table) {
            $table->id();
            $table->integer('anio');
            $table->string('nombre_campania');
            $table->boolean('gestion_actual')->default(0);
            $table->boolean('estado')->default(1);
            $table->timestamps();
            $table->unique(['anio', 'nombre_campania']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gestiones');
    }
};
