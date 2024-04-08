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
        Schema::create('curso_estudiante', function (Blueprint $table) {
          
            $table->integer('id')->autoIncrement()->nullable(false);
            $table->integer('id_estudiante')->nullable(false);
            $table->integer('id_curso')->nullable(false);
            $table->timestamp('fecha_inscripcion')->nullable(false);
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
        Schema::dropIfExists('curso_estudiante');
    }
};
