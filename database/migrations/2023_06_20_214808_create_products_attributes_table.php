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
        Schema::create('products_attributes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBiginteger('product_id')->unsigned();
            $table->unsignedBiginteger('attribute_id')->unsigned();
            $table->string('attribute_value')->nullable();

            $table->foreign('product_id')->references('id')
                ->on('products')->onDelete('cascade');
            $table->foreign('attribute_id')->references('id')
                ->on('attributes')->onDelete('cascade');

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
        Schema::dropIfExists('products_attributes');
    }
};
