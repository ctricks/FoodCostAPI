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
        Schema::create('docheader', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('SourceId');
            $table->integer('TargetId');
            $table->date('DocDate');
            $table->string('DocCode',20);
            $table->integer('Status');
            $table->string('DocTypeCode',20);
            $table->integer('CreatedBy');
            $table->date('CreatedDate');
            $table->integer('RefDocID');
            $table->integer('PostedBy');
            $table->date('PostedDate');
            $table->integer('ApprovedBy');
            $table->date('ApprovedDate');
            $table->integer('UpdatedBy');
            $table->date('UpdatedDate');
            $table->integer('SysSourceId');
            $table->integer('SysTargetId');
            $table->string('SysDocName',20);
            $table->string('SysDocNo',20);
            $table->date('SysDocDate');
            $table->integer('isUpload');
            $table->integer('UploadBy');
            $table->string('UploadFile',50);
            $table->date('UploadDate');
            $table->float('SysTotalCost', 8, 2)->defaul(0);
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
        Schema::dropIfExists('docheader');
    }
};
