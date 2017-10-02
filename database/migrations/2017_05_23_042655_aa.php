<?php

use Illuminate\Database\Migrations\Migration;

class Aa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('ALTER TABLE payouts MODIFY COLUMN amount float(2)');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('ALTER TABLE payouts MODIFY COLUMN amount varchar(255)');
    }
}
