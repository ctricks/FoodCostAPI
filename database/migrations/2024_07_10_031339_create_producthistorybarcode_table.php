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
        Schema::create('producthistorybarcode', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ProductId');
            $table->date('EffectivityDate');
            $table->string('NewProductBarcode', 8, 2);
            $table->string('OldProductBarcode', 8, 2);
            $table->integer('CreatedBy')->default(-1);
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
        Schema::dropIfExists('producthistorybarcode');
    }
};
