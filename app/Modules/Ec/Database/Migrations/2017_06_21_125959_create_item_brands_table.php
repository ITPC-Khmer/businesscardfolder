<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemBrandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_brands', function (Blueprint $table) {
            $table->increments('id');
            $table->string('brand_name')->index()->nullable();
            $table->string('logo')->index()->nullable();
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
        Schema::dropIfExists('item_brands');
    }
}
