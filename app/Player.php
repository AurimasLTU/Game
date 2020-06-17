<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    protected $table = 'player';

    public $incrementing = false;

    protected $fillable = [
        'id',
        'balance'
    ];

    public function balance_transactions()
    {
        return $this->hasMany(BalanceTransaction::class);
    }

    public function bets()
    {
        return $this->hasMany(Bet::class);
    }
}
