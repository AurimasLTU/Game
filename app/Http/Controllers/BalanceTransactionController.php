<?php

namespace App\Http\Controllers;

use App\BalanceTransaction;

class BalanceTransactionController
{
    function create($playerId, $oldAmount, $newAmount)
    {
        $balance = new BalanceTransaction();
        $balance->player_id = $playerId;
        $balance->amount = $newAmount;
        $balance->amount_before = $oldAmount;
        $balance->save();

        return BalanceTransaction::find($balance->id);
    }
}
