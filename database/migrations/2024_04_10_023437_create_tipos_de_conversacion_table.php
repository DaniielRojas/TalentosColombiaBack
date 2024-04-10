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
        Schema::create('tipos_de_conversacion', function (Blueprint $table) {
            $table->integer('id')->autoIncrement()->nullable(false);
            $table->string('nombre')->nullable(false);
            $table->timestamps();
            $table->softDeletes();
        });
        DB::table('tipos_de_conversacion')->insert([
            ['nombre' => 'individual'],
            ['nombre' => 'llamadas'],
            ['nombre' => 'foro'],
            ['nombre' => 'grupal'],
            ['nombre' => 'publica'],
            ['nombre' => 'privada'],    
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tipos_de_conversacion');
    }
};
