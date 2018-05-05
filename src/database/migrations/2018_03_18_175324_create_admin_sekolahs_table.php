<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAdminSekolahsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
	public function up()
	{
		Schema::create('admin_sekolahs', function(Blueprint $table) {
			$table->increments('id');
			$table->string('sekolah_id');
			$table->string('admin_sekolah_id');
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
		Schema::drop('admin_sekolahs');
	}
}
