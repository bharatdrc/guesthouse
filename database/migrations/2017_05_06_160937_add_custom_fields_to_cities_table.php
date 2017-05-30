<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCustomFieldsToCitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
          Schema::table('cities', function (Blueprint $table) {
                $table->string('name')->nullable(false);
                $table->integer('region_id')->index();
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
        Schema::table('cities', function(Blueprint $table){
            $table->dropColumn('name');
            $table->dropColumn('hidden');
             $table->dropColumn('region_id');
        });
    }
}
