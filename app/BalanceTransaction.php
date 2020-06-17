<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BalanceTransaction extends Model
{
    protected $table = 'balance_transaction';

    protected $fillable = [
        'player_id',
        'amount',
        'amount_before'
    ];

    public function player()
    {
        return $this->belongsTo(Player::class);
    }
}
