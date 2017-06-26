<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class InsertCost extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature =  'insert:excel {excel?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '注入支出';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $excel2 = new \App\Model\Excel($this->argument('excel'));


         $excel2->getExcel()->map(function($v){
        static $i;
        \DB::table($this->argument('excel').'s')->insert($v->toArray());
        $this->info("插入第{$i}条数据成功"."--".$v['zhaiyao'].$v['amount']);

      });


        
    }
}
