<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id')->index()->nullable()->default(0);
            $table->integer('member_id')->index()->nullable()->default(0);
            $table->integer('brand_id')->index()->nullable()->default(0);

            $table->string('code')->index()->nullable();
            $table->string('barcode')->index()->nullable();
            $table->string('title')->index()->nullable();
            $table->string('description')->nullable();

            $table->double('start_price')->nullable()->default(0);
            $table->double('promotion_price')->nullable()->default(0);
            $table->date('promotion_expire')->nullable();
            $table->integer('private_price')->nullable()->default(0);// 0,1

            $table->integer('condition')->nullable()->default(1);// 0=use, 1=new
            $table->text('condition_description')->nullable();
            $table->text('return_policy')->nullable();

            $table->longText('option')->nullable();// json
            $table->text('image')->nullable();// json

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
        Schema::dropIfExists('items');
    }
}
