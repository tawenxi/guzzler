<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Cost extends Model
{
    protected $fillable = [
        'date',
        'payee',
        'payeeaccount',
        'payeebanker',
        'amount',
        'zhaiyao',
        'income_id',
        'kemu',
        'beizhu',
        ];

    public function income()
    {
        return $this->belongsTo(Income::class);
    }
}
