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
        Schema::create('m_kelurahan', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kelurahan');
            $table->bigInteger('kecamatan_id')->unsigned();
            $table->timestamps();
            $table->foreign('kecamatan_id')->references('id')->on('m_kecamatan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('m_kelurahan');
    }
};
