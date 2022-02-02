<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDisposisiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('disposisi', function (Blueprint $table) {
            $table->id();
            $table->string('dari');
            $table->dateTime('tanggal_dibuat');
            $table->string('no_surat');
            $table->longText('isi_surat');

            $table->string('no_agenda');
            $table->dateTime('tanggal_diterima');
            $table->string('kepada');

            $table->bigInteger('status_id');
            $table->bigInteger('users_id');

            $table->softDeletes();
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
        Schema::dropIfExists('disposisi');
    }
}
