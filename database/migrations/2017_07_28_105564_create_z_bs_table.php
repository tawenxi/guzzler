<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateZbsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zbs', function (Blueprint $table) {
            $table->increments('id');

            $table->string('GSDM');
            $table->string('KJND');
            $table->string('MXZBLB');
            $table->string('MXZBBH');
            $table->string('MXZBWH');
            $table->string('MXZBXH');
            $table->string('ZZBLB');
            $table->string('ZZBBH');
            $table->string('FWRQ');
            $table->string('DZKDM');
            $table->string('YSDWDM');
            $table->string('ZBLYDM');
            $table->string('YSKMDM');
            $table->string('ZJXZDM');
            $table->string('JFLXDM');
            $table->string('ZCLXDM');
            $table->string('XMDM');
            $table->string('ZFFSDM');
            $table->string('JE');
            $table->string('ZY');
            $table->string('LRR_ID');
            $table->string('LRR');
            $table->string('LR_RQ');
            $table->string('XGR_ID');
            $table->string('CSR_ID');
            $table->string('CSR');
            $table->string('CS_RQ');
            $table->string('HQBZ');
            $table->string('HQWCBZ');
            $table->string('SHJBR_ID');
            $table->string('SHR_ID');
            $table->string('SHR');
            $table->string('SH_RQ');
            $table->string('SNJZ');
            $table->string('NCYS');
            $table->string('BNZA');
            $table->string('BNZF');
            $table->string('BNBF');
            $table->string('ZBYE');
            $table->string('SJLY');
            $table->string('YZBLB');
            $table->string('YSGLLXDM');
            $table->string('ZBZT');
            $table->string('TZBZ');
            $table->string('JZRQ');
            $table->string('ZBID');
            $table->string('ZBIDWM');
            $table->string('DCBZ');
            $table->string('DCRID');
            $table->string('STAMP');
            $table->string('OAZT');
            $table->string('TZH');
            $table->string('JZR_ID');
            $table->string('PZFLH');
            $table->string('JZR_ID1');
            $table->string('PZFLH1');
            $table->string('DJZT');
            $table->string('SCJHJE');
            $table->string('DYBZ');
            $table->string('YWLXDM');
            $table->string('XMFLDM');
            $table->string('SJWH');
            $table->string('KZZLDM1');
            $table->string('KZZLDM2');
            $table->string('ASHR_ID');
            $table->string('ASHR');
            $table->string('ASH_RQ');
            $table->string('ASHJD');
            $table->string('AXSHJD');
            $table->string('ASFTH');
            $table->string('ZBLB');
            $table->string('DZKMC');
            $table->string('ZBLYMC');
            $table->string('YSDWMC');
            $table->string('YSDWQC');
            $table->string('YSKMMC');
            $table->string('YSKMQC');
            $table->string('ZJXZMC');
            $table->string('XMMC');
            $table->string('YSGLLXMC');
            $table->string('HQNAME');
            $table->string('ZZBWH');
            $table->string('ZZBXH');
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
        Schema::drop('z_bs');
    }
}
