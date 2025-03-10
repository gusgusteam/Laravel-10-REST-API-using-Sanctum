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
        Schema::create('nota_ventas', function (Blueprint $table) {
            $table->id();
            $table->string('codigo', 5)->unique();
            $table->foreignId('cliente_id')->constrained('clientes')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('gestion_id')->constrained('gestiones')->onDelete('cascade');
            $table->foreignId('cultivo_id')->constrained('cultivos')->onDelete('cascade');
            $table->string('codigo_factura')->unique();
            $table->date('fecha');
            $table->decimal('monto_total', 10, 2)->default(0);
            $table->string('lugar')->nullable();
            $table->string('recibido')->nullable();
            $table->boolean('venta_credito')->default(0);
            $table->boolean('estado')->default(0);
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nota_ventas');
    }
};
