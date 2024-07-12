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
            $table->increments('id');
            $table->string('ProductCode',20)->unique();
            $table->Integer('InsysProductId')->default(-1);
            $table->string('InsysProductCode',20)->unique();
            $table->string('Barcode',20)->nullable();
            $table->string('Name',50);            
            $table->float('Cost', 8, 2);
            $table->float('Price', 8, 2);
            $table->integer('isMarkDown')->default(-1);            
            $table->integer('categoryId')->nullable()->default(-1);            
            $table->integer('modelId')->nullable()->default(-1);            
            $table->integer('status')->default(-1);            
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
        Schema::dropIfExists('products');
    }
};
