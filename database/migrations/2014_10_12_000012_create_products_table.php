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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2);
            $table->integer('quantity')->unsigned()->default(0);
            $table->string('image')->nullable();
            $table->decimal('weight', 10, 2)->nullable();
            $table->string('sku')->unique()->nullable();
            $table->tinyInteger('status');
            $table->boolean('is_hot')->default(false);
            $table->boolean('is_sale')->default(false);
            $table->decimal('price_sale', 10, 2)->nullable();
            $table->string('barcode')->nullable();
            $table->string('origin')->nullable();
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('brand_id')->nullable();
            $table->timestamps();

            // Add foreign key constraint
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
