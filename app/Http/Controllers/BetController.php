<?php

namespace App\Http\Controllers;

use App\Bet;
use App\Constants\ErrorData;
use App\Player;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BetController
{
    function bet(Request $request)
    {
        $playerId = $request->input('player_id');
        $stakeAmount = $request->input('stake_amount');
        $selections = $request->input('selections');

        $errorController = new ErrorController();
        $checkResult = $errorController->checkForErrors($playerId, $stakeAmount, $selections);
        if ($checkResult === false) {
            $playerController = new PlayerController();
            $balanceTransactionController = new BalanceTransactionController();
            $betSelectionsController = new BetSelectionsController();

            $player = Player::find($playerId);
            $bet = $this->create($player->id, $stakeAmount);
            $balanceTransaction = $balanceTransactionController->create(
                $player->id,
                $player->balance,
                $player->balance - $stakeAmount
            );

            foreach ($selections as $selection) {
                $betSelectionsController->create($bet->id, floatval($selection['odds']), $selection['id']);
            }

            $playerController->updateBalance($player->id, $balanceTransaction->amount);

            return response(json_encode([], JSON_FORCE_OBJECT), 201);
        } else {
            return $checkResult;
        }
    }

    function create($playerId, $stakeAmount)
    {
        $bet = new Bet();
        $bet->player_id = $playerId;
        $bet->stake_amount = $stakeAmount;
        $bet->save();

        return Bet::find($bet->id);
    }
}
