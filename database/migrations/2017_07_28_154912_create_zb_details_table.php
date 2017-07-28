<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateZbDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zb_details', function (Blueprint $table) {
            $table->increments('id');
            
            $table->string("BJDJ");
            $table->string("BGDJID");
            $table->string("DJZT");
            $table->string("ZY");
            $table->string("SQJE1");
            $table->string("JE");
            $table->string("WH");
            $table->string("DZKDM");
            $table->string("DZKMC");
            $table->string("YSDWDM");
            $table->string("YSDWMC");
            $table->string("YSKMDM");
            $table->string("YSKMMC");
            $table->string("JFLXDM");
            $table->string("JFLXMC");
            $table->string("XMDM");
            $table->string("XMMC");
            $table->string("ZJXZDM");
            $table->string("ZJXZMC");
            $table->string("ZBLYDM");
            $table->string("ZBLYMC");
            $table->string("ZCLXDM");
            $table->string("ZCLXMC");
            $table->string("ZFFSDM");
            $table->string("ZFFSMC");
            $table->string("LR_RQ");
            $table->string("LRR");
            $table->string("ZBID");

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
        Schema::drop('zb_details');
    }
}
