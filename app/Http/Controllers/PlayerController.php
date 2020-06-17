<?php

namespace App\Http\Controllers;

use App\Player;

class PlayerController
{
    function create($id)
    {
        $player = new Player();
        $player->id = $id;
        $player->save();

        return Player::find($id);
    }

    function get($id)
    {
        return Player::find($id);
    }

    function updateBalance($id, $newBalance)
    {
        $player = $this->get($id);
        $player->balance = $newBalance;
        $player->save();
        return $player;
    }

    public function checkIfPlayerExistsAndGet($playerId)
    {
        return !Player::where('id', '=', $playerId)->exists() ? $this->create($playerId) : false;
    }
}
