<?php namespace App\Http\Controllers;

use Auth;
use App\CustomGame;
use App\Classes\Poker;
use Illuminate\Http\Request;

class CustomGameController extends Controller
{
    public $Model, $Poker;

    public function __construct(CustomGame $model) {
        $this->Poker = new Poker(config('pm.pw'), config('pm.api'));
        $this->Model = $model;
    }

    public function deleteCustomGames(Request $request) {
        $this->validate($request, [
            'customGameIds' => 'required'
        ]);

        $ids =  json_decode($request->input('customGameIds'));
        $type = gettype($ids);
        $user = Auth::user();
        if ($type !== 'array') {
            logger("Wrong type for customGameIds. Expected an array, but received '$type' instead!", ['user' => $user, 'request' => $request->all()]);
            return response()->json("Wrong type for customGameIds. Expected an array, but received '$type' instead!", 400);
        }
        foreach ($ids as $id) {
            if (!ctype_digit($id))
                return response()->json('Invalid Game-ID.', 400);
            if (!$this->Model->customGameBelongsToSteamId($id, $user->steamid))
                return response()->json("The Game-ID $id seems not to belong to you!", 400);
            $name = CustomGame::where('id', '=', $id)->select('name')->get()[0]['name'];
            if (!$this->Poker->stopRingGame($name))
                return response()->json("Failed to stop ring game $name($id)! ".$this->Poker->error, 400);
            if (!$this->Poker->deleteRingGame($name))
                return response()->json("Failed to delete ring game $name($id)! ".$this->Poker->error, 400);
        }
        if (!$this->Model->deleteCustomGames($ids))
            return response()->json('Sorry, something went wrong. Contact an admin.', 400);
        return response()->json("Your custom ". count($ids) > 1 ? 'games have' : 'game has'." been successfully deleted.");
    }

    public function createRingGame(Request $request) {
        $type = $request->input('type');
        if ($type === 'Razz/Stud')
            return $this->createRingGameRazzStud($request);
        else if ($type === 'HoldEm/Omaha')
            return $this->createRingGameHoldEmOmaha($request);
        else
            return response()->json("Unknown game type: $type", 400);
    }

    public function createRingGameHoldEmOmaha(Request $request) {
        $this->validate($request, [
            'name' => 'required|string|between:1,40',
            'game' => 'required|string|in:Limit Hold\'em,Pot Limit Hold\'em,No Limit Hold\'em,Limit Omaha,Pot Limit Omaha,No Limit Omaha,Limit Omaha Hi-Lo,Pot Limit Omaha Hi-Lo,No Limit Omaha Hi-Lo',
            'seats' => 'required|integer|between:'.\Config::get('poker.minSeats').','.\Config::get('poker.maxSeats').'',
            'smallBlind' => 'required|integer|different:bigBlind|between:'.\Config::get('poker.minSmallBlind').','.\Config::get('poker.maxSmallBlind').'',
            'bigBlind' =>'required|integer|different:smallBlind|between:'.\Config::get('poker.minBigBlind').','.\Config::get('poker.maxBigBlind').'',
            'minBuyIn' => 'required|integer|different:maxBuyIn|min:'.\Config::get('poker.minBuyIn').'',
            'maxBuyIn' => 'required|integer|different:minBuyIn|max:'.\Config::get('poker.maxBuyIn').''
        ]);
        $name = $request->input('name');
        $game = $request->input('game');
        $seats = $request->input('seats');
        $smallBlind = $request->input('smallBlind');
        $bigBlind = $request->input('bigBlind');
        $minBuyIn = $request->input('minBuyIn');
        $maxBuyIn = $request->input('maxBuyIn');
        $pw = str_random(8);

        $customGameErrors = $this->Poker->customRingGameErrors($name, $game, $minBuyIn, $maxBuyIn, $seats, $bigBlind, $smallBlind);
        if ($customGameErrors)
            return response()->json($customGameErrors, 400);

        if ($this->Model->exists($name))
            return response()->json('The game name is already in use.');

        $user = Auth::user();

        if ($this->Model->countCustomGames($user->steamid) >= \Config::get('poker.maxCustomGames'))
            return response()->json('Max amount of custom games reached.', 400);

        if (!$this->Poker->createCustomRingGameHoldemOmaha($user->player, $name, $game, $seats, $smallBlind, $bigBlind, $minBuyIn, $maxBuyIn, $pw))
            return response()->json('Failed to create custom ring game Hold\'Em/Omaha! '.$this->Poker->error, 400);

        $id = $this->Model->addCustomGame($user->steamid, 'Ring Game', $game, $name, $user->player);
        if (!$id)
            return response()->json('An error occured while adding your custom ring game. Please contact an admin.', 400);

        $data = CustomGame::where('id', '=', $id)->first();
        if (!$data)
            return response()->json('An error occured while adding your custom ring game. Please contact an admin.', 400);
        $data->steamid = (string)$data->steamid;

        if (!$this->Poker->startRingGame($data->name))
            return response()->json("Contact an admin: Failed to start ring game '$name'! ".$this->Poker->error, 400);

        $data->msg = "<p>Your custom ring game '$data->name' has been created.<br>A password has been created for you to join the table: <strong>$pw</strong><br>Make sure to write it down, as you are not able to change or recover it afterwards.<br>Have fun!</p>";
        return response()->json($data);
    }

    public function createRingGameRazzStud(Request $request) {
        $this->validate($request, [
            'name' => 'required|between:1,40',
            'game' => 'required|string|in:Limit Razz,Limit Stud,Limit Stud Hi-Lo',
            'seats' => 'required|integer|between:'.\Config::get('poker.minSeats').','.\Config::get('poker.maxSeatsRazzStud').'',
            'smallBet' => 'required|integer|different:bigBet|between:'.\Config::get('poker.minSmallBet').','.\Config::get('poker.maxSmallBet').'',
            'bigBet' =>'required|integer|different:smallBet|between:'.\Config::get('poker.minBigBet').','.\Config::get('poker.maxBigBet').'',
            'minBuyIn' => 'required|integer|different:maxBuyIn|min:'.\Config::get('poker.minBuyIn').'',
            'maxBuyIn' => 'required|integer|different:minBuyIn|max:'.\Config::get('poker.maxBuyIn').''
        ]);

        $name = $request->input('name');
        $game = $request->input('game');
        $seats = $request->input('seats');
        $smallBet = $request->input('smallBet');
        $bigBet = $request->input('bigBet');
        $minBuyIn = $request->input('minBuyIn');
        $maxBuyIn = $request->input('maxBuyIn');
        $pw = str_random(8);

        $customGameErrors = $this->Poker->customRingGameErrors($name, $game, $minBuyIn, $maxBuyIn, $seats, $bigBet, $smallBet);
        $specificCustomGameErrors = $this->Poker->customRingGameValidatorRazzStud($seats, $bigBet, $smallBet);
        if ($customGameErrors || $specificCustomGameErrors)
            return response()->json($customGameErrors || $specificCustomGameErrors);

        if ($this->Model->exists($name))
            return response()->json('The game name is already in use.', 400);

        $user = Auth::user();

        if ($this->Model->countCustomGames($user->steamid) >= \Config::get('poker.maxCustomGames'))
            return response()->json('Max amount of custom games reached.', 400);

        if (!$this->Poker->createCustomRingGameRazzStud($user->player, $name, $game, $seats, $smallBet, $bigBet, $minBuyIn, $maxBuyIn, $pw))
            return response()->json("Failed to create customg ring game Razz/Stud! ".$this->Poker->error, 400);

        $id = $this->Model->addCustomGame($user->steamid, 'Ring Game', $game, $name, $user->player);
        if (!$id)
            return response()->json('An error occured while adding your custom ring game. Please contact an admin.', 400);

        $data = CustomGame::where('id', '=', $id)->first();
        if (!$data)
            return response()->json('An error occured while adding your custom ring game. Please contact an admin.', 400);
        $data->steamid = (string)$data->steamid;

        if (!$this->Poker->startRingGame($name))
            return response()->json("Contact an admin: Failed to start ring game '$name'! ".$this->Poker->error, 400);

        $data->msg = "<p>Your custom ring game '$data->name' has been created.<br>A password has been created for you to join the table: <strong>$pw</strong><br>Make sure to write it down, as you are not able to change or recover it afterwards.<br>Have fun!</p>";
        //return response()->json($data);
        $html = "
            <tr data-id='$data->id'>
                <td>
                    <label for='custom_game_$data->id' class='mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect mdl-data-table__select' data-id='$data->id'>
                        <input id='custom_game_$data->id' class='mdl-checkbox__input' type='checkbox' data-id='$data->id' />
                    </label>
                </td>
                <td>$data->type</td>
                <td>$data->game</td>
                <td>$data->name</td>
                <td>$data->created_at</td>
            </tr>
        ";
        return response()->json([
            'html' => $html,
            'msg' => "<p>Your custom ring game '$data->name' has been created.<br>A password has been created for you to join the table: <strong>$pw</strong><br>Make sure to write it down, as you are not able to change or recover it afterwards.<br>Have fun!</p>"
        ]);
    }

}
