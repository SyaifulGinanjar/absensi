<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToPresensiMakansTable extends Migration
{
    public function up()
    {
        Schema::table('presensi_makans', function (Blueprint $table) {
            $table->unsignedBigInteger('peserta_id')->nullable();
            $table->foreign('peserta_id', 'peserta_fk_7556699')->references('id')->on('peserta');
        });
    }
}
