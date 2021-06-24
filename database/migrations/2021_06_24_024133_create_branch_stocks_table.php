<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBranchStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('branch_stocks', function (Blueprint $table) {
            $table->id();
            $table->integer('product_id');
            $table->integer('branch_id');
            $table->integer('price');
            $table->integer('stock');
            $table->timestamps();
        });
        Schema::create('branch_stock_histories', function (Blueprint $table) {
            $table->id();
            $table->integer('stock_id');
            $table->integer('branch_id');
            $table->enum('status', ['masuk', 'keluar']);
            $table->integer('quantity');
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
        Schema::dropIfExists('branch_stocks');
    }
}
