<?php


namespace App\Http\Controllers;

use App\BetSelections;

class BetSelectionsController {
    function create($betId, $odds) {
        $balance = new BetSelections();
        $balance->bet_id = $betId;
        $balance->odds = $odds;
        $balance->save();

        return $balance;
    }
}
