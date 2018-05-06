<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSekolahsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
	public function up()
	{
		Schema::create('sekolahs', function(Blueprint $table) {
			$table->string('id');
			$table->string('nama');
			$table->string('npsn');
			$table->integer('jenis_sekolah_id')->nullable();
			$table->string('alamat');
			$table->string('logo')->nullable();
			$table->string('foto_gedung')->nullable();
			$table->string('province_id')->nullable();
			$table->string('city_id')->nullable();
			$table->string('district_id')->nullable();
			$table->string('village_id')->nullable();
			$table->string('no_telp');
			$table->string('email');
			$table->string('kode_zona')->nullable();
			$table->integer('user_id')->nullable();
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
		Schema::drop('sekolahs');
	}
}
