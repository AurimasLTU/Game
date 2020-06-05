<?php


namespace App\Http\Controllers;


use App\Player;

class PlayerController {
    function create($id) {
        $player = new Player();
        $player->id = $id;
        $player->save();

        return $player;
    }

    function get($id) {
        return Player::where('id', '=', $id)->get();
    }

    function update($id, $newBalance) {
        $player = Player::where('id', '=', $id)->get();
        $player->balance = $newBalance;
        $player->save();
        return $player;
    }

    public function destroy($id) {
        $player = Player::where('id', '=', $id)->get();
        $player->delete();

        return "success";
    }
}
