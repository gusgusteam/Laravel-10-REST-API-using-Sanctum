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
        Schema::create('producto_envase', function (Blueprint $table) {
            $table->id();
            $table->string('codigo')->nullable();
            $table->string('image')->nullable();
            $table->foreignId('producto_id')->constrained('productos')->onDelete('cascade'); // Relación con la tabla 'producto'
            $table->foreignId('unidad_id')->constrained('unidads')->onDelete('cascade'); // Relación con la tabla 'unidad'
            $table->integer('cantidad');
            $table->decimal('precio_estimado', 10, 2);
            $table->decimal('margen_minimo', 10, 2);
            $table->decimal('margen_standar', 10, 2);
            $table->decimal('margen_maximo', 10, 2);
            $table->boolean('estado')->default(1); 
            //$table->primary(['producto_id', 'unidad_id']);
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('producto_envase');
    }
};
