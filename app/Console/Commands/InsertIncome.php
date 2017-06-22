<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class InsertIncome extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'insert:income {income?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '注入直接支付';

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
        Global $exce;
        $exce = $this->argument('income');
        //dd($GLOBALS);
        $import =app()->make("\App\SalaryListImport");
        $ziduan=[
        'date',
        'zhaiyao',
        "xingzhi",
        'amount',
        'cost',
        'kemu',
        'beizhu'
        ];//34个字段
       $res = $import->setDateColumns(array(
            'created_at',
            'updated_at',
            'date'
        ))->get($ziduan);  


       $res->map(function($v){
        static $i;
        \App\Model\Income::Create($v->toArray());
        $i++;
        $this->info("插入第{$i}条数据成功"."--".$v['zhaiyao'].$v['amount']);
      });


        
    }
}
