<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePesertaTable extends Migration
{
    public function up()
    {
        Schema::create('peserta', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama');
            $table->string('asal_dprd');
            $table->string('jenis_kelamin')->nullable();
            $table->string('nomor_ponsel')->nullable();
            $table->string('uuid')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
