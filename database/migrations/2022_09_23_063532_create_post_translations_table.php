<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_translations', function (Blueprint $table) {
            $table->unsignedBigInteger('post_id');
            $table->unsignedBigInteger('language_id');
            $table->string('title');
            $table->text('description');
            $table->longText('content');

            //IDX
            $table->index('post_id','post_translation_post_idx');
            $table->index('language_id','post_translation_language_idx');

            //FK
            $table->foreign('post_id','post_translation_post_fk')->on('posts')->references('id');
            $table->foreign('language_id','post_translation_language_fk')->on('languages')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post_translations');
    }
}
