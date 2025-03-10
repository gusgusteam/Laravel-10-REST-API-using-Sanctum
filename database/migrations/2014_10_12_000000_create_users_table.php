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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
           // $table->integer('ci')->unique();
           // $table->string('paterno');
           // $table->string('materno');
           // $table->string('direccion');
           // $table->date('fechaNacimiento');
           // $table->tinyInteger('edad');
           // $table->tinyInteger('estado')->default(1);
           // $table->tinyInteger('superAdmin')->default(0);
           $table->boolean('estado')->default(1);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
