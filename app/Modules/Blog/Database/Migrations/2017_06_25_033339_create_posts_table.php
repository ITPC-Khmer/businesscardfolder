<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id')->index()->nullable()->default(0);
            $table->string('title')->index()->nullable();
            $table->string('description')->nullable();
            $table->text('image')->nullable();
            $table->longText('content')->nullable();
            $table->longText('option')->nullable();

            $table->string('meta_title')->index()->nullable();
            $table->string('meta_description')->index()->nullable();

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
        Schema::dropIfExists('posts');
    }
}
