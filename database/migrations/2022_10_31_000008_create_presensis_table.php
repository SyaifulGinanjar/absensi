<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePresensisTable extends Migration
{
    public function up()
    {
        Schema::create('presensis', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('type')->nullable();
            $table->string('status')->nullable();
            $table->string('refer_to')->nullable();
            $table->datetime('waktu')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
