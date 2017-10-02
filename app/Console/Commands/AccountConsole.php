<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class AccountConsole extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:account {date} {--income} {--withallaccount}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'make account';

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
        $hasAccount = $this->option('withallaccount');
        $is_income = $this->option('income');
        if ($is_income) {
            $results = \App\Model\Zb::search($this->argument('date'), 0.01, true)
            ->Hasaccount($hasAccount)
            ->orderBy('LR_RQ')
            ->get()
            ->unique();
        } else {
            $results = \App\Model\Zfpz::search($this->argument('date'), 0.01, true)
            ->Hasaccount($hasAccount)
            ->orderBy('PDH')
            ->get()
            ->unique();
            //dd($results);
        }

        foreach ($results as $key => $result) {
            //$this->comment($this->option('account'));
            $this->comment($result->ZY.'  '.$result->JE);
            if (! empty($result->account_number)) {
                $this->error($result->account->name);
            }
            do {
                do {
                    $key = $this->ask('请输入科目关键字');
                    $topics =
                    \App\Model\Account::select(['id', 'name'])
                    ->where('name', 'like', '%'.$key.'%')->get();
                } while (empty($topics->first()));

                foreach ($topics as $key => $topic) {
                    $this->info($topic->id.'--'.$topic->name);
                }
                $YN = $this->ask('是否找到科目');
            } while ($YN !== 'y' and $YN !== 'q');
            if ($YN === 'q') {
                $this->error('跳过这个业务');
                continue;
            }
            do {
                $topics_id = $this->ask('请选择科目id');
            } while (! in_array($topics_id, $topics->pluck('id')->toArray()));

            $account_number = \App\Model\Account::
                                where('id', $topics_id)
                                ->value('account_number');
            $result->account_number = $account_number;
            $result->save();
            $this->info('保存成功');
        }
    }
}
