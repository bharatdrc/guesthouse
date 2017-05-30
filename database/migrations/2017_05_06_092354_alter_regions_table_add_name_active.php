<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterRegionsTableAddNameActive extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('regions', function(Blueprint $table)
        {
            $table->string('name')-> nullable(false);
            $table->integer('hidden')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // here you're not dropping the whole table, only removing the newly added columns
        Schema::table('regions', function(Blueprint $table){
            $table->dropColumn('name');
            $table->dropColumn('hidden');
        });
    }
}
