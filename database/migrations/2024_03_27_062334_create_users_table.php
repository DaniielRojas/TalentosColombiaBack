<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->integer('id')->autoIncrement()->nullable(false);   
            $table->string('nombre')->nullable(false);
            $table->string('apellido')->nullable(false);
            $table->string('numero_documento')->unique()->nullable(false);
            $table->string('usuario')->nullable(false);
            $table->string('email')->unique()->nullable(false);
            $table->string('direccion')->nullable(false);
            $table->timestamp('fecha_nacimiento')->nullable(false);
            $table->string('password')->nullable(false);
            $table->string('imagen')->nullable(false);
            $table->integer('id_rol')->nullable(false)->onDelete("cascade");
            $table->integer('id_tipo_documento')->nullable(false)->onDelete("cascade");
            $table->timestamps();
            $table->softDeletes();
        });

    
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
};
