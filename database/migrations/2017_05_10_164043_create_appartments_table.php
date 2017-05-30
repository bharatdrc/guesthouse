<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppartmentsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('appartments', function (Blueprint $table) {
			$table->increments('id');
			$table->string('name')->nullable(false);
			 $table->integer('image')->default(1);
			 $table->integer('gallery');
			 $table->integer('guesthouse_id')->index();
			 $table->integer('hidden')->default(0);
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
		Schema::dropIfExists('appartments');
	}
}
