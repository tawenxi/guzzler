<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salaries', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('member_id');
            $table->string('name');
            $table->string('account');
            $table->string('bumen');

            $table->float('yishu_bz')->nullable();
            $table->float('tuixiu_gz')->nullable();

            $table->float('jb_gz1')->nullable();
            $table->float('jb_gz2')->nullable();
            $table->float('jinbutie')->nullable();
            $table->float('gongche_bz')->nullable();
            $table->float('xiangzhen_bz')->nullable();

            $table->float('bufa_gz')->nullable();
            $table->float('nianzhong_jj')->nullable();
            $table->float('gaowen_jiangwen')->nullable();
            $table->float('jiangjin')->nullable();
            $table->string('jiangjin_beizhu')->nullable();
            $table->float('gjj_dw')->nullable();
            $table->float('sb_dw')->nullable();
            $table->float('gjj_gr')->nullable();
            $table->float('sb_gr')->nullable();
            $table->float('zhiye_nj')->nullable();
            $table->float('daikou_gz')->nullable();
            $table->float('fanghong_zj')->nullable();

            $table->float('yiliao_bx')->nullable();
            $table->float('shiye_bx')->nullable();
            $table->float('shengyu_bx')->nullable();
            $table->float('gongshang_bx')->nullable();
            $table->float('yirijuan')->nullable();
            $table->float('other_daikou')->nullable();
            $table->string('daikou_beizhu')->nullable();

            $table->float('tiaozheng_gjj')->nullable();
            $table->float('tiaozheng_sb')->nullable();

            $table->float('sb_js')->nullable();
            $table->float('gjj_js')->nullable();

            $table->date('date')->nullable();
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
        Schema::drop('salaries');
    }
}
