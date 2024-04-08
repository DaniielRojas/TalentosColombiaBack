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
        //relciones:
        


        Schema::table('users', function (Blueprint $table) {
            // Agregar una nueva clave foránea
             $table->foreign('id_rol')->references('id')->on('roles');
             $table->foreign('id_tipo_documento')->references('id')->on('tipo_documento');
        });

       

        Schema::table('evaluaciones', function (Blueprint $table) {
            // Agregar una nueva clave foránea
            $table->foreign('id_docente')->references('id')->on('users');
            $table->foreign('id_curso')->references('id')->on('cursos');
        });
        Schema::table('cursos', function (Blueprint $table) {
            // Agregar una nueva clave foránea
            $table->foreign('id_docente')->references('id')->on('users');
            $table->foreign('id_categoria')->references('id')->on('categorias');
        });
        Schema::table('notas_estudiantes', function (Blueprint $table) {
            // Agregar una nueva clave foránea
            $table->foreign('id_estudiante')->references('id')->on('users');
            $table->foreign('id_evaluacion')->references('id')->on('evaluaciones');
        });

        Schema::table('matriculas', function (Blueprint $table) {
            // Agregar una nueva clave foránea
            $table->foreign('id_estudiante')->references('id')->on('users');
            $table->foreign('id_curso')->references('id')->on('cursos');
        });
        Schema::table('curso_estudiante', function (Blueprint $table) {
            // Agregar una nueva clave foránea
            $table->foreign('id_estudiante')->references('id')->on('users');
            $table->foreign('id_curso')->references('id')->on('cursos');
        });
        Schema::table('lecciones', function (Blueprint $table) {
            // Agregar una nueva clave foránea
            $table->foreign('id_docente')->references('id')->on('users');
            $table->foreign('id_curso')->references('id')->on('cursos');
        });
        Schema::table('calificaciones', function (Blueprint $table) {
            // Agregar una nueva clave foránea
            $table->foreign('id_estudiante')->references('id')->on('users');
            $table->foreign('id_curso')->references('id')->on('cursos');
        });
        Schema::table('comentarios', function (Blueprint $table) {
            // Agregar una nueva clave foránea
            $table->foreign('id_usuario')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
 
    }
};