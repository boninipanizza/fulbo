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
        Schema::drop('categories_posts');

        Schema::table('posts', function (Blueprint $table) {
            $table->foreignId('category_id')->constrained()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('categories_posts', function (Blueprint $table) {
            $table->foreignId('categories_id')->constrained()->cascadeOnUpdate();
            $table->foreignId('posts_id')->constrained()->cascadeOnUpdate();
        });

        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn('category_id');
        });

    }
};
