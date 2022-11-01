<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePresensiMakansTable extends Migration
{
    public function up()
    {
        Schema::create('presensi_makans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->datetime('waktu');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
