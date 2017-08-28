<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\Zb;
use Nicolaslopezj\Searchable\SearchableTrait;
use App\Model\Account;

class Zfpz extends Model
{
    use SearchableTrait;
    public $timestamps=false;
    public function getZySkrAttribute()
    {
        return $this->attributes['ZY'].' '.$this->attributes['SKR'].' '.$this->attributes['JE'];
    }
    public function account()
    {
        return $this->belongsTo(Account::class,'account_number','account_number');
    }

    public function scopeHasaccount($query,$account)
    {

        if (!$account) {
                return $query->where('account_number','');           
            }
        return $query;
    }

    protected $searchable = [
    'columns' => [
        'zfpzs.ZY' => 10,
        'zfpzs.JE' => 10,
        'zfpzs.QS_RQ' => 50,
        'zfpzs.YSDWMC' => 50,
        'zfpzs.XMMC' => 10,
        'zfpzs.YSKMMC' => 5,
        'zfpzs.ZFFSMC' => 5,
        ]
    ];

    public function zb()
    {
        return $this->belongsTo(Zb::class,'ZBID','ZBID');
    }

    protected $fillable = [
   			"XH",
            "KJND",
            "PDQJ",
            "PDH",
            "PDRQ",
            "DJBH",
            "YSDWDM",
            "ZY",
            "SKR",
            'QS_RQ',
            "SKZH",
            "SKRKHYH",
            "FKR",
            "FKZH",
            "FKRKHYH",
            "ZBID",
            "JE",
            "DZKMC",
            "YSDWMC",
            "YSDWQC",
            "ZJXZMC",
            "JSFSMC",
            "YSKMMC",
            "YSKMQC",
            "JFLXMC",
            "JFLXQC",
            "ZFFSMC",
            "ZCLXMC",
            "ZBLYMC",
            "XMMC",
            "YSGLLXMC",
            "NEWDYBZ",
            "NEWZZPZ",
            "NEWPZLY",
            "NEWZT",
            "NEWCXBZ",
            "MXZBWH",
            "BJWH",
            'account_number',
];
}
