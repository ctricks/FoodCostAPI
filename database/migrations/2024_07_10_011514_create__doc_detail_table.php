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
        Schema::create('docdetail', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('DocHeaderID');
            $table->integer('lineNumber');
            $table->string('ItemCode',20);
            $table->string('ProductCode',20);
            $table->string('Barcode',20);
            $table->string('Description',50)->nullable();
            $table->integer('ActualQuantity');
            $table->integer('OrderQuantity');
            $table->float('SubTotalPrice', 8, 2)->defaul(0);
            $table->float('SubTotalCost', 8, 2)->defaul(0);
            $table->float('Price', 8, 2)->defaul(0);
            $table->float('Cost', 8, 2)->defaul(0);
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
        Schema::dropIfExists('docdetail');
    }
};
