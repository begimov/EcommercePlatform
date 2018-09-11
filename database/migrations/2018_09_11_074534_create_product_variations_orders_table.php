<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductVariationsOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_variations_orders', function (Blueprint $table) {
            $table->integer('product_variation_id')->unsigned()->index();
            $table->integer('order_id')->unsigned()->index();
            $table->integer('quantity')->unsigned();
            $table->timestamps();

            $table->foreign('product_variation_id')->references('id')->on('product_variations');
            $table->foreign('order_id')->references('id')->on('orders');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_variations_orders');
    }
}
