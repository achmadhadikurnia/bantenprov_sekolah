<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProdiSekolahsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prodi_sekolahs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('sekolah_id');
            $table->string('program_keahlian_id')->nullable();
            $table->integer('kuota_siswa');
            $table->string('keterangan')->nullable();
            $table->integer('user_id');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prodi_sekolahs');
    }
}
