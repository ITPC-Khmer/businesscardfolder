<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->index()->nullable();
            $table->string('description')->nullable();
            $table->integer('parent')->index()->nullable()->default(0);
            $table->text('image')->nullable();
            $table->text('option')->nullable();
            $table->integer('status')->index()->nullable()->default(0);
            $table->integer('user_id')->index()->nullable()->default(0);
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
        Schema::dropIfExists('post_categories');
    }
}
