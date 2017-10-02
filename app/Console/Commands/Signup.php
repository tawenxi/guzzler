<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class Signup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'signup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '注入用户';

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
        global $exce;
        $exce = 'users';
        $import = app()->make("\App\Model\SalaryListImport");
        $ziduan = ['id', 'name', 'email', 'password']; //3个字段
        $res = $import->skipRows(1)->setDateColumns([
            'created_at',
            'updated_at',
        ])->get($ziduan);
        $res->map(function ($v) {
            static $i;
            $v['name'] = str_replace(' ', '', $v['name']);
            $v['password'] = bcrypt($v['password']);
            \App\Model\User::updateOrCreate([
            'id'=>$v['id'],
            'name'=>$v['name'],
            ], $v->toArray());
            $i++;
            $this->info("插入第{$i}条数据成功".'--'.$v['id'].$v['name']);
        });
    }
}
