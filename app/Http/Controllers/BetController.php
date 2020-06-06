<?php


namespace App\Http\Controllers;


use App\Bet;
use App\Constants\Ranges;
use App\Player;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BetController {
    function bet(Request $request) {
        $playerId = $request->input('player_id');
        $stakeAmount = $request->input('stake_amount');
        $selections = $request->input('selections');
        $playerController = new PlayerController();
        $player = $playerController->checkIfPlayerExistsAndGet($playerId);


        return response()->setStatusCode(201);
    }

    function create($playerId, $stakeAmount) {
        $bet = new Bet();
        $bet->player_id = $playerId;
        $bet->stake = $stakeAmount;
        $bet->save();

        return $bet;
    }

    function isMaxWinExceeded($allSelectionOdds, $stake) {
        $amount = $stake;

        foreach ($allSelectionOdds as $odd) {
            $amount = $odd * $amount;
        }

        return $amount > Ranges::MAX_WIN_AMOUNT;
    }
}
