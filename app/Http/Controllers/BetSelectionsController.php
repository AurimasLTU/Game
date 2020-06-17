<?php

namespace App\Http\Controllers;

use App\BetSelections;

class BetSelectionsController
{
    function create($betId, $odds, $selectionId)
    {
        $betSelections = new BetSelections();
        $betSelections->bet_id = $betId;
        $betSelections->selection_id = $selectionId;
        $betSelections->odds = $odds;
        $betSelections->save();

        return $betSelections;
    }
}
