<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('cardid')->nullable();
            $table->string('bankaccount')->nullable();
            
            $table->string('bumen');
            $table->string('class')->nullable();
            $table->string('gangwei')->nullable();
            $table->string('sex')->nullable();
            $table->string('educational')->nullable();
            $table->date('worktime')->nullable();
            $table->string('ruraltime')->nullable();
            $table->integer('xiangzhen_bz')->nullable();
            $table->integer('gongche_bz')->nullable();
            $table->float('sb_js')->nullable();
            $table->float('gjj_js')->nullable();
            $table->integer('jb_gz1')->nullable();
            $table->integer('jb_gz2')->nullable();
            $table->integer('jinbutie')->nullable();
            $table->string('status')->default('在职');
            $table->date('lizhiriqi')->nullable();
            $table->text('resume')->nullable();
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
        Schema::drop('members');
    }
}
