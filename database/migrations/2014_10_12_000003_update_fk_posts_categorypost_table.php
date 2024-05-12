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
        // Schema::create('category_posts', function (Blueprint $table) {
        //     $table->foreignId('post_id')->constrained()->onDelete('cascade');
        //     $table->foreignId('category_id')->constrained()->onDelete('cascade');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::table('category_posts', function (Blueprint $table) {
        //     $table->dropForeign(['post_id']);
        //     $table->dropForeign(['category_id']);
        // });

        // Schema::dropIfExists('category_posts');
    }
};
