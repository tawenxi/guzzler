<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateZfpzsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zfpzs', function (Blueprint $table) {
            $table->increments('id');

            $table->string("XH");
            $table->string("KJND");
            $table->string("PDQJ");
            $table->string("PDH");
            $table->string("PDRQ");
            $table->string("DJBH");
            $table->string("YSDWDM");
            $table->string("ZY");
            $table->string("SKR");
            $table->string("SKZH");
            $table->string("SKRKHYH");
            $table->string("FKR");
            $table->string("FKZH");
            $table->string("FKRKHYH");
            $table->string("ZBID");
            $table->string("JE");
            $table->string("DZKMC");
            $table->string("YSDWMC");
            $table->string("YSDWQC");
            $table->string("ZJXZMC");
            $table->string("JSFSMC");
            $table->string("YSKMMC");
            $table->string("YSKMQC");
            $table->string("JFLXMC");
            $table->string("JFLXQC");
            $table->string("ZFFSMC");
            $table->string("ZCLXMC");
            $table->string("ZBLYMC");
            $table->string("XMMC");
            $table->string("YSGLLXMC");
            $table->string("NEWDYBZ");
            $table->string("NEWZZPZ");
            $table->string("NEWPZLY");
            $table->string("NEWZT");
            $table->string("NEWCXBZ");
            $table->string("MXZBWH");
            $table->string("BJWH");

            $table->string('account_number')->nullable();

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
        Schema::drop('zfpzs');
    }
}
