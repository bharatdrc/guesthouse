<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForiegntablenameandidToImagesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('images', function (Blueprint $table) {
			$table->string('foriegn_table')->nullable(false);
			$table->integer('foriegn_id')->index();
		 });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('images', function(Blueprint $table){
			$table->dropColumn('foriegn_table');
			$table->dropColumn('foriegn_id');
		});
	}
}
