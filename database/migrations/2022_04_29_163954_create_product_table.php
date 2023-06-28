<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
            $table->id('id');
            $table->integer('supplier_id');
            $table->integer('producttype_id');
            $table->string('name_product');
            $table->string('serie');
            $table->string('old_price');
            $table->float('price_product');
            $table->integer('amount');
            $table->string('depscribe');
            $table->string('img_product');
            $table->string('product_views');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
        });
    }
    // $products = Product::join('suppliers', 'products.suppelier_id', 'suppliers.id');

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product');
    }
};
