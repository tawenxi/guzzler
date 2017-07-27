<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class PukConsole extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:puk {num?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test Puk';

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
        $puk=collect(
            ['3','3','3','3','3','3','3','3',
              '4','4','4','4','4','4','4','4',
              '5','5','5','5','5','5','5','5',
              '6','6','6','6','6','6','6','6',
              '7','7','7','7','7','7','7','7',
              '8','8','8','8','8','8','8','8',
              '9','9','9','9','9','9','9','9',
              '10','10','10','10','10','10','10','10',
              'J','J','J','J','J','J','J','J',
              'Q','Q','Q','Q','Q','Q','Q','Q',
              'K','K','K','K','K','K','K','K',
              'A','A','A','A','A','A','A','A',
              '2','2','2','2','2','2','2','2',]); 
              //->shuffle() 
        $i=0;
        $totalnum=0;
        while ($totalnum < $this->argument('num')) 
        {
            $totalnum++;
            $getpuk = $puk->random(26)->groupBy(function($item,$key){
                    return $item;
              });
            $res= $getpuk->map(function($value){
                return $value->count();
            });
            $jiang = $res->filter(function($item)
                {
                    return $item >= 5;
                });
            if ($res->get(2)==4 || $jiang!=collect($value = null)) 
            {
                $i++;
                $string='';
                foreach ($jiang as $key => $value) {
                    $string.="{$value}个$key,";
                }
                $gailv=$i/$totalnum;
                $this->info("测试第{$totalnum}条数据，本次摇奖情况{$res->get(2)}个2，{$string},(共测试{$totalnum}，其中{$i}有摇，摇奖率{$gailv})");
                continue;               
            } else {
                $gailv=$i/$totalnum;
                $this->info("测试第{$totalnum}条数据，没有中奖,(共测试{$totalnum}，其中{$i}有摇，摇奖率{$gailv})");
            }

            
            
        }
    }
}
