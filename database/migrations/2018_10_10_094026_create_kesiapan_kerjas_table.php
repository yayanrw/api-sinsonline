<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKesiapanKerjasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kesiapan_kerja', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('p5m_id')->unsigned();
            $table->foreign('p5m_id')->references('id')->on('p5m')->onDelete('cascade');
            $table->time('jamtidur');
            $table->time('jambangun');
            $table->string('minepermit');
            $table->string('masalahpribadi');
            $table->string('rompi');
            $table->string('sepatu');
            $table->string('helm');
            $table->string('kacamata');
            $table->string('loto');
            $table->string('siap');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kesiapan_kerja');
    }
}
