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
        Schema::create('mensajes', function (Blueprint $table) {
            $table->integer('id')->autoIncrement()->nullable(false);
            $table->integer('id_tipo_conversacion')->nullable(false);
            $table->integer('id_usuario')->nullable(false);
            $table->string('contenido')->nullable(false);
            $table->timestamp('fecha')->nullable(false);
            $table->boolean('estado')->nullable(false);
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
        Schema::dropIfExists('mensajes');
    }
};
