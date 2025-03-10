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
            $table->foreignId('producto_id')->constrained('productos')->onDelete('cascade'); // Relación con la tabla 'producto'
            $table->foreignId('unidad_id')->constrained('unidads')->onDelete('cascade'); // Relación con la tabla 'unidad'
            $table->integer('cantidad');
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
