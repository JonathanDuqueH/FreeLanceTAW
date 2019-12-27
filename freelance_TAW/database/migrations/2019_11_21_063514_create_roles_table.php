<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('tipo',30)->unique();
            $table->string('descripcion', 100)->nullable();
            $table->boolean('condicion')->default(1);
        });
        DB::table('roles')->insert(array('id'=>'1','tipo'=>'Administrador','descripcion'=>'Administradores generales.'));
        DB::table('roles')->insert(array('id'=>'2','tipo'=>'Project manager','descripcion'=>'Administradores de proyectos.'));
        DB::table('roles')->insert(array('id'=>'3','tipo'=>'Desarrollador','descripcion'=>'Programadores.'));
        DB::table('roles')->insert(array('id'=>'4','tipo'=>'Cliente','descripcion'=>'Clientes.'));

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles');
    }
}
