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
        Schema::create('producthistorycost', function (Blueprint $table) {
            $table->id();
            $table->integer('ProductId');
            $table->date('EffectivityDate');
            $table->float('NewCost', 8, 2)->defaul(0);
            $table->float('OldCost', 8, 2)->defaul(0);
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
        Schema::dropIfExists('producthistorycost');
    }
};
