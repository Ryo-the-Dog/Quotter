<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhraseTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phrase_tag', function (Blueprint $table) {
            $table->bigInteger('phrase_id')->unsigned();
            $table->integer('tag_id')->unsigned();
            $table->primary(['phrase_id','tag_id']);

            $table->foreign('phrase_id')->references('id')->on('phrases')->onDelete('cascade');
            $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('phrase_tag');
    }
}
