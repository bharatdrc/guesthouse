<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddGalleryFieldToGuesthousesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('guesthouses', function (Blueprint $table) {
			$table->integer('gallery');
		 });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('guesthouses', function(Blueprint $table){
			$table->dropColumn('gallery');
		});
	}
}
