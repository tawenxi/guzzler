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
            $table->date('borthday');
            $table->string('bumen');
            $table->string('class');
            $table->string('gangwei');
            $table->string('sex');
            $table->string('educational');
            $table->date('worktime');
            $table->string('ruraltime');
            $table->integer('xiangzhen_bz');
            $table->float('sb_js');
            $table->text('resume');
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
