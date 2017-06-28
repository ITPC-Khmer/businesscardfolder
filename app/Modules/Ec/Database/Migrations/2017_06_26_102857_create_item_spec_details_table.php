<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemSpecDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_spec_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('item_id')->index()->nullable()->default(0);
            $table->integer('spec_id')->index()->nullable()->default(0);
            $table->string('spec_value')->index()->nullable();
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
        Schema::dropIfExists('item_spec_details');
    }
}
