<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnvasesTable extends Migration
{
    public function up()
    {
        Schema::create('envases', function (Blueprint $table) {
            $table->id();
            $table->integer('cantidad');
            $table->boolean('estado')->default(1); // 1 = activo, 0 = inactivo
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('envases');
    }
}

