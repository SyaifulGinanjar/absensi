<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToPresensisTable extends Migration
{
    public function up()
    {
        Schema::table('presensis', function (Blueprint $table) {
            $table->unsignedBigInteger('nama_sesi_id')->nullable();
            $table->foreign('nama_sesi_id', 'nama_sesi_fk_7553085')->references('id')->on('sessions');
            $table->unsignedBigInteger('nama_peserta_id')->nullable();
            $table->foreign('nama_peserta_id', 'nama_peserta_fk_7553086')->references('id')->on('peserta');
        });
    }
}
