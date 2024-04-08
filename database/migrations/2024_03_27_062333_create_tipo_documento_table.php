<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
        Schema::create('tipo_documento', function (Blueprint $table) {
            $table->integer('id')->autoIncrement()->nullable(false);   
            $table->string('nombre')->nullable();
            $table->timestamps();
            });
            DB::table('tipo_documento')->insert([
                ['nombre' => 'Cédula de Ciudadanía'],
                ['nombre' => 'Tarjeta de Identidad'],
                ['nombre' => 'Cédula de Extranjería'],
                ['nombre' => 'Pasaporte'],
            ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tipo_documento');
    }
};
