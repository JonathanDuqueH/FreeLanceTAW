<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('apellido_p');
            $table->string('apellido_m');
            $table->string('telefono');
            $table->boolean('condicion')->default(1);
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->unsignedBigInteger('idrol');
            $table->foreign('idrol')->references('id')->on('roles')->onDelete('cascade');
            $table->rememberToken();
            $table->timestamps();
          
            });
      
            DB::insert('insert into users (id, name, apellido_p, apellido_m, telefono, condicion, email, password, idrol) values (?, ?, ?, ?, ?, ?, ?, ?, ?)', [1, 'Jonathan' ,'Duque', 'Hernandez', '8311030571', '1','1630206@upv.edu.mx','$2y$10$SZLn95ye3hV6sAGamQflmeXfh8Hfv6ILo2srJFJJ5FYxWyVl2I7Ly','1']);
            DB::insert('insert into users (id, name, apellido_p, apellido_m, telefono, condicion, email, password, idrol) values (?, ?, ?, ?, ?, ?, ?, ?, ?)', [2, 'Citlaly' ,'Reyes', 'Mejorado', '8342103924', '1','1630035@upv.edu.mx','$2y$10$R/WcHVGdusLoeOAv5DHOY.l.FzPciTifBSRlYK41KnFxEPPYZ.O56','1']);
            DB::insert('insert into users (id, name, apellido_p, apellido_m, telefono, condicion, email, password, idrol) values (?, ?, ?, ?, ?, ?, ?, ?, ?)', [3, 'Liliana' ,'Lince', 'Andrade', '8345555555', '1','1530048@upv.edu.mx','$2y$10$NvNKMeSUyHhe/YecrNvAuuTxMqeSjg00YKcKSKd35M/Xh3AUpny7C','1']);
            DB::insert('insert into users (id, name, apellido_p, apellido_m, telefono, condicion, email, password, idrol) values (?, ?, ?, ?, ?, ?, ?, ?, ?)', [4, 'Jose' ,'Colchado', 'Sanchez', '8342515159', '1','1530424@upv.edu.mx','$2y$10$GgZvV9xWkIisdvI0MTw0/ekphJvtgMtZCtdU6FVzcghKhx8SWe556','1']);
        
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}