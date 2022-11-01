<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSessionsTable extends Migration
{
    public function up()
    {
        Schema::create('sessions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama_sesi');
            $table->datetime('start_time');
            $table->datetime('end_time');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
