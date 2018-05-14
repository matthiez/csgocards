<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomGame extends Model
{
    protected $table = 'custom_games';

    public function exists($name) {
        return CustomGame::where('name', '=', $name)->first() ? true : false;
    }

    public function addCustomGame($steamid, $type, $game, $name, $player) {
        $customGame = new CustomGame;
        $customGame->steamid = $steamid;
        $customGame->type = $type;
        $customGame->game = $game;
        $customGame->name = $name;
        $customGame->player = $player;
        return $customGame->save() ? $customGame->id : false;
    }

    public function countCustomGames($steamid) {
        return CustomGame::where('steamid', '=', $steamid)->count();
    }

    public function getCustomGames($steamid) {
        return CustomGame::where('steamid', '=', $steamid)->get();
    }

    public function customGameBelongsToSteamId($id, $steamid) {
        $rows = CustomGame::where('steamid', '=', $steamid)->get();
        if(isset($rows[0])) {
            $ids = [];
            foreach($rows as $row) $ids[] = $row->id;
            if(in_array($id, $ids)) return true;
        }
        return false;
    }

    public function deleteCustomGames($ids) {
        return CustomGame::whereIn('id', $ids)->delete() != count($ids) ? false : true;
    }
}
