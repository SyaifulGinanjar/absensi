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
            $table->integer('angkatan')->nullable();
            $table->string('uuid')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
