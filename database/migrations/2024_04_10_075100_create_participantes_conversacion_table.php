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
        Schema::create('participantes_conversacion', function (Blueprint $table) {
            $table->integer('id')->autoIncrement()->nullable(false);
            $table->integer('id_conversacion')->nullable(false)->onDelete("cascade");
            $table->integer('id_usuario')->nullable(false)->onDelete("cascade");
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
        Schema::dropIfExists('participantes_conversacion');
    }
};
