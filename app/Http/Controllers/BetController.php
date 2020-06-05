<?php


namespace App\Http\Controllers;


use App\Bet;
use App\Player;
use Illuminate\Http\Request;

class BetController {
    function bet(Request $request) {
        $playerId = $request->input('player_id');
        $stakeAmount = $request->input('stake_amount');
        $selections = $request->input('selections');
        $playerController = new PlayerController();


        if (!Player::where('id', '=', $playerId)->exists()) {
            $player = $playerController->create($playerId);
        } else {
            $player = $playerController->get($playerId);
        }
    }

    function createInDb($playerId, $stakeAmount) {
        $bet = new Bet();
        $bet->player_id = $playerId;
        $bet->stake = $stakeAmount;
        $bet->save();

        return $bet;
    }

    function get() {

    }

    function update() {

    }

    function delete() {

    }
}
