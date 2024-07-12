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
        Schema::create('iteminventory', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ProductCode',20)->unique();
            $table->string('Barcode',20)->nullable();
            $table->string('BranchCode',20);
            $table->string('Description',50)->nullable();
            $table->integer('OnHandQuantity')->default(0);
            $table->integer('AvailableQuantity')->default(0);
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
        Schema::dropIfExists('iteminventory');
    }
};
