<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BetSelections extends Model {
    protected $table = 'bet_selections';

    protected $fillable = ['bet_id', 'odds'];

    public function bet() {
        return $this->belongsTo(BetSelections::class);
    }
}
