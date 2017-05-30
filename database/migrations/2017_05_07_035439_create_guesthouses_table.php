<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGuesthousesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guesthouses', function (Blueprint $table) {
            $table->increments('id');
             $table->string('name')->nullable(false);
             $table->string('sender_name')->nullable(false);
             $table->string('sender_email')->nullable(false);
             $table->integer('city_id')->index();
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
        Schema::dropIfExists('guesthouses');
    }
}
