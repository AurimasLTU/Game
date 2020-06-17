<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BetSelections extends Model
{
    protected $table = 'bet_selections';

    protected $fillable = ['bet_id', 'odds', 'selection_id'];

    public function bet()
    {
        return $this->belongsTo(Bet::class);
    }
}
