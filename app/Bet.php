<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bet extends Model
{
    protected $table = 'bet';

    protected $fillable = ['stake_amount', 'player_id'];

    public function player()
    {
        return $this->belongsTo(Player::class);
    }

    public function betSelections()
    {
        return $this->hasMany(BetSelections::class);
    }
}
