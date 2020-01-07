<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('fecha_pago');
            $table->string('asunto', 20);
            $table->string('descripcion', 150);
            
            $table->unsignedBigInteger('idacreedor');
            $table->foreign('idacreedor')->references('id')->on('users')->onDelete('cascade');

            $table->unsignedBigInteger('idpaga');
            $table->foreign('idpaga')->references('id')->on('users')->onDelete('cascade');

            $table->unsignedBigInteger('idmetodo');
            $table->foreign('idmetodo')->references('id')->on('metodos_pago')->onDelete('cascade');

            $table->float('monto', 8,2);

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
        Schema::dropIfExists('pagos');
    }
}
