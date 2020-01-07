<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('page', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('correo',250);
            $table->string('telefono',250);
            $table->string('horario',250);
            $table->string('imagen_1',250);
            $table->string('imagen_2',250);
            $table->string('titulo_1',250);
            $table->string('titulo_2',250);
            $table->string('parrafo_t2',250);
            $table->string('imagen_3',250);
            $table->string('titulo_3',250);
            $table->string('parrafo_t3',250);
            $table->string('titulo_4',250);
            $table->string('parrafo_t4',250);
            $table->string('titulo_5',250);
            $table->string('parrafo_t5',250);
            $table->string('titulo_1pp',250);
            $table->string('contenido_1pp',250);
            $table->string('imagen_pp',250);
            $table->string('contenio_2pp',250);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('page');
    }
}
