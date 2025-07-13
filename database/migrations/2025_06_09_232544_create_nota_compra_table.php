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
        Schema::create('nota_compra', function (Blueprint $table) {
            $table->id();
            $table->string('codigo', 5)->unique();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('gestion_id')->constrained('gestiones')->onDelete('cascade');
            $table->foreignId('proveedor_id')->constrained('proveedor')->onDelete('cascade');
            $table->string('codigo_factura')->unique();
            $table->string('codigo_alterno')->nullable();
            $table->boolean('nota_alterna')->default(0);
            $table->string('motivo')->nullable('sin motivo');
            $table->date('fecha');
            $table->decimal('monto_total', 10, 2)->default(0);
            $table->string('lugar')->nullable();
            $table->string('recibido')->nullable();
            $table->boolean('compra_credito')->default(0);
            $table->boolean('estado')->default(0);
            $table->boolean('firma')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nota_compra');
    }
};
