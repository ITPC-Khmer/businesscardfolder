<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemSpecsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_specs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('key')->index()->nullable();
            $table->string('title')->nullable();
            $table->integer('category_id')->index()->nullable()->default(0);
            $table->integer('status')->index()->default(0)->nullable();
            $table->integer('user_id')->index()->default(0)->nullable();
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
        Schema::dropIfExists('item_specs');
    }
}
