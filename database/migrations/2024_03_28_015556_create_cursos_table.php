<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cursos', function (Blueprint $table) {
            $table->integer('id')->autoIncrement()->nullable(false);
            $table->integer('id_docente')->nullable(false)->onDelete("cascade");
            $table->integer('id_categoria')->nullable(false)->onDelete("cascade");
            $table->string('titulo')->nullable(false);
            $table->string('descripcion')->nullable(false);
            $table->string('imagen')->nullable(false);
            $table->string('duracion')->nullable(false);
            $table->boolean('estado')->nullable(false);
            $table->timestamp('fecha_inicio')->nullable(false);
            $table->timestamp('fecha_fin')->nullable(false);
            $table->timestamps();
            $table->softDeletes();
            
         
    });



    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cursos');
    }
};