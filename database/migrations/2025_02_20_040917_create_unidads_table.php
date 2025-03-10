<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUnidadsTable extends Migration
{
    public function up()
    {
        Schema::create('unidads', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->unique();
            $table->string('nombre_corto')->nullable();
            $table->boolean('estado')->default(1);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('unidads');
    }
}
