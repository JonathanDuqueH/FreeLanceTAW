<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTareasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tareas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('titulo', 150)->unique();
            $table->string('descripcion', 255);
            
            $table->unsignedBigInteger('iduser');
            $table->foreign('iduser')->references('id')->on('users')->onDelete('cascade');

            $table->dateTime('inicio');
            $table->dateTime('fin');

            $table->unsignedBigInteger('idhito');
            $table->foreign('idhito')->references('id')->on('hitos')->onDelete('cascade');

            $table->boolean('condicion')->default(0);
            $table->boolean('pagado')->default(0);

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
        Schema::dropIfExists('tareas');
    }
}
