<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news_categories_has_news', function (Blueprint $table) {
            $table->id();
            $table->foreignId('new_category_id');
            $table->foreign('new_category_id')->references('id')->on('new_categories')->onDelete('cascade');
            $table->foreignId('new_id');
            $table->foreign('new_id')->references('id')->on('news')->onDelete('cascade');
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
        Schema::dropIfExists('news_categories_has_news');
    }
};
