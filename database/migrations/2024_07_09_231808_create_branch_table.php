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
        Schema::create('branch', function (Blueprint $table) {
            $table->increments('id');
            $table->string('BranchCode',20)->unique();            
            $table->string('Name',50);
            $table->integer('SysBranchId')->nullable();
            $table->string('SysBranchCode',20)->nullable();
            $table->string('Email',20)->nullable();
            $table->string('MobileNo',20)->nullable();
            $table->integer('Status');
            $table->integer('CreatedBy')->default(-1);
            $table->integer('UpdatedBy')->default(-1);            
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
        Schema::dropIfExists('branch');
    }
};
