<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToSessionsTable extends Migration
{
    public function up()
    {
        Schema::table('sessions', function (Blueprint $table) {
            $table->unsignedBigInteger('nama_agenda_id')->nullable();
            $table->foreign('nama_agenda_id', 'nama_agenda_fk_7552607')->references('id')->on('agendas');
        });
    }
}
