<?php namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Traits\Helper;
use App\Traits\Poker;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use Poker;
    use Helper;

    private $User;

    public function __construct(User $User) {
        $this->User = $User;
    }

    public function setTimezone(Request $request) {
        $this->validate($request, [
            'timezone' => 'string|required',
        ]);
        $timezone = $request->input('timezone');

        $user = Auth::user();

        if($timezone == $user->timezone) return response()->json('Aborting, because the selected timezone is equal to your current one.', 400);

        if($this->User->setTimezone($user->steamid, $timezone)) return response()->json(e($timezone));
        return response()->json('Error. Please contact an admin.', 400);
    }

    public function setTradeLink(Request $request) {
        $this->validate($request, [
            'tradeLink' => 'url|required',
        ]);
        $tradeLink = $request->input('tradeLink');

        $user = Auth::user();

        if($tradeLink === $user->trade_link) return response()->json('Aborting, because the specified tradelink is equal to your current one.', 400);

        if((new User)->setTradelink($user->steamid, $tradeLink)) return response()->json(e($tradeLink));
        return response()->json('An error occured. Contact an admin.', 400);
    }

    public function createAccount(Request $request) {
        $this->validate($request, [
            'player' => 'between:3,12|alpha_dash|required',
            'location' => 'between:1,30|string|required',
            'avatar' => 'numeric|required',
            'gender' => 'string|required|in:Male,Female',
            'customAvatar' => 'image|mimes:gif,png'
        ]);
        $user = Auth::user();

        $player = $request->input('player');
        if(in_array($player, $this->reservedAccounts)) return redirect()->back()->withErrors(['error' => 'Nickname rejected - please choose another one.']);
        if($this->nicknameInUse($player)) return redirect()->back()->withErrors(['error' => 'Nickname already in use - please choose another one.']);

        if(!$this->User->register($user->steamid, $player)) return redirect()->back()->withErrors(['error' => 'Error. Please contact an admin.']);

        $info = '';

        $params = [
            "Command" => "AccountsAdd",
            "Player" => $player,
            "PW" => str_random(8),
            "Location" => $request->input('location'),
            "Avatar" => $request->input('avatar'),
            "Gender" => $request->input('gender'),
            "Custom" => $user->steamid,
            'Email' => 'du@m.my'
        ];
        if($request->hasFile('customAvatar')) {
            $file = $request->file('customAvatar');
            $avatarPath = $this::uploadAvatar($file->getRealPath(), $file->guessClientExtension(), $user->steamid);
            if($avatarPath) {
                $params['AvatarFile'] = $avatarPath;
                $params['Avatar'] = 0;
            } else $info = '<br>Custom avatar could not be uploaded. Using default one instead.';
        }

        $pmApi = $this->api($params);
        if(isset($pmApi->Error)) {
            $this->User->nullPlayer($user->steamid);
            return redirect()->back()->withErrors(['error' => $pmApi->Error])->withInput();
        }
        return redirect('poker')->with('info', "User $player successfully added. Have fun at the tables!" . $info);
    }

    public function getProfile($steamId) {
        /* Redirect User to his own Profile if SteamID does not exist in DB */
        $checkSteamId = (new User)->existingSteamId($steamId);
        if(!$checkSteamId) return redirect('profile/' . $this->user['steamid'] . '')->with('error', 'The given SteamID could not be found.');

        $player = (new User)->getPlayer($steamId);
        return view('profile', ['steamId' => $steamId, 'player' => $player]);
    }

    public function pokerProfile(Request $request) {
        $player = $request->query('Player');
        $steamId = (new User)->getSteamIdFromPlayer($player);
        return redirect('profile/' . $steamId . '');
    }
}
