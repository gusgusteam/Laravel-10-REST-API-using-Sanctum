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
        Schema::create('detalle_devolucion', function (Blueprint $table) {
            $table->id();
            $table->foreignId('nota_devolucion_id')->constrained('nota_devolucion')->onDelete('cascade');
            $table->foreignId('producto_envase_id')->constrained('producto_envase')->onDelete('cascade');
            $table->decimal('precio_asignado', 10, 2);
            $table->decimal('cantidad', 10, 2);
            $table->decimal('subtotal', 10, 2)->nullable();
            $table->text('observacion')->nullable();
            $table->boolean('estado')->default(1); // 1 = Activo, 0 = Inactivo
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalle_devolucion');
    }
};
