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
        Schema::create('archivos_leccion', function (Blueprint $table) {
                $table->integer('id')->autoIncrement()->nullable(false);
                $table->integer('id_leccion')->nullable(false)->onDelete("cascade");
                $table->string('tipo')->nullable(false);
                $table->string('ubicacion')->nullable(false);
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
        Schema::dropIfExists('archivos_leccion');
    }
};
