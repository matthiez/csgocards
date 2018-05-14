<?php namespace App\Traits;

trait Poker
{
    private $callbackPath = '/backend/callbacks.txt';

    public $reservedAccounts = [
        'Admin',
        'Cashier',
        'Dev',
        'Developer',
        'Hacker',
        'Moderator',
        'root',
        'Administrator',
        'csgocards',
        'csg0cards',
        'csgo_cards',
        'csgo-cards',
        'Service',
        'Sysadmin',
        'SystemAccount',
        'System',
        'Staff',
        'csgocards_staff',
        'csgocards-staff',
        'csgocardsstaff',
        'superuser'
    ];

    public function api($params) {
        $params['Password'] = config('pm.pw');
        $params['JSON'] = 'Yes';
        $curl = curl_init(config('pm.api'));
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($params));
        curl_setopt($curl, CURLOPT_TIMEOUT, 30);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_VERBOSE, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($curl);
        if (curl_errno($curl)) $object = (object)['Result' => 'Error', 'Error' => curl_error($curl)];
        else if (empty($response)) $object = (object)['Result' => 'Error', 'Error' => 'Connection failed'];
        else $object = json_decode($response);
        curl_close($curl);
        if (isset($object->Error) && $params['Command'] !== 'AccountsGet') logger((array)$object);
        return $object;
    }

    public function callbacks() {
        $file = $_SERVER['DOCUMENT_ROOT'].$this->callbackPath;
        if (file_exists($file)) {
            if (filesize($file) == 0) {
                \Log::error('PM-API Error: '.$file.' found, but it is empty.');
                echo $file . ' found, but it is empty';
            }
            else readfile($file);
        }
        else {
            \Log::error('PM-API Error: '.$file.' not found.');
            echo $file.' not found';
        }
    }

    public function getBalance($player) {
        $api = $this->api([
            'Command' => 'AccountsGet',
            'Player' => $player
        ]);
        if (isset($api->Balance)) {
            $balance = (int)$api->Balance;
            session()->put('pokerBalance', $balance);
            return $balance;
        }
        return 0;
    }

    public function systemStats() {
        $api = $this->api(['Command' => "SystemStats"]);
        if (isset($api->Error)) {
            \Log::error("API Error: ".PHP_EOL.$api->Error);
            return false;
        }
        return $api;
    }

    public function accountsGet($player) {
        return $this->api([
            'Command' => 'AccountsGet',
            'Player' => $player
        ]);
    }

    public function nicknameInUse($player) {
        $api = $this->api([
            'Command' => 'AccountsGet',
            'Player' => $player
        ]);
        return !isset($api->Error) ? true : false;
    }

    public function chipLeaders() {
        $api = $this->api(['Command' => "AccountsList", "Fields" => "Player,Balance"]);
        $data = [];
        if (isset($api->Accounts)) {
            $accounts = $api->Accounts;
            for ($i = 0; $i < $accounts; $i++) {
                $player = $api->Player[$i];
                $data[$player] = $api->Balance[$i];
            }
            arsort($data);
        }
        return $data;
    }

    public function tourneyResults() {
        $api = $this->api(['Command' => "TournamentsResults"]);
        $data['total'] = $api->Files;
        for ($i = 0; $i < $data['total']; $i++) {
            $tr = $api->Date[$i] . "  " . htmlspecialchars($api->Name[$i], ENT_QUOTES);
            $data['options'] = "<option value='".$tr."'>".$tr."</option>";
        }
        return $data;
    }

    public function errorLogs() {
        $error_logs = null;
        $api = $this->api(['Command' => "LogsError"]);
        $count = $api->Files;
        for ($i = 0; $i < $count; $i++) {
            $error_log = $api->Date[$i];
            $error_logs .= "<option value='" . $error_log . "'>" . $error_log . "</option>";
        }
        return $error_logs;
    }

    public function errorLog($edate) {
        $api = $this->api(['Command' => "LogsError", "Date" => $edate]);
        for ($i = 0; $i < count($api->Data); $i++) echo "".$api->Data[$i]."<br>";
    }

    public function eventLogs() {
        $event_logs = null;
        $api = $this->api(['Command' => "LogsEvent"]);
        $count = $api->Files;
        for ($i = 0; $i < $count; $i++) {
            $event_log = $api->Date[$i];
            $event_logs .= "<option value='" . $event_log . "'>" . $event_log . "</option>";
        }
        return $event_logs;
    }

    public function eventLog($edate) {
        $api = $this->api(['Command' => "LogsEvent", "Date" => $edate]);
        if (count($api->Data) > 0) {
            for ($i = 0; $i < count($api->Data); $i++) echo "".$api->Data[$i]."<br>";
            return true;
        }
        return false;
    }

    public function handHistories() {
        $hands = '';
        $api = $this->api(['Command' => "LogsHandHistory"]);
        $count = $api->Files;
        for ($i = 0; $i < $count; $i++) {
            $hand_history = $api->Date[$i] . "  " . htmlspecialchars($api->Name[$i], ENT_QUOTES);
            $hands .= "<option value='" . $hand_history . "'>" . $hand_history . "</option>";
        }
        return $hands;
    }

    public function handHistory($history) {
        $hand_history = null;
        $history = stripslashes($history);
        $hhdate = substr($history, 0, 10);
        $hhname = substr($history, 12);
        $api = $this->api(['Command' => "LogsHandHistory", "Date" => $hhdate, 'Name' => $hhname]);
        if (!isset($api->Error)) {
            for ($i = 0; $i < count($api->Data); $i++) echo "<pre>".$api->Data[$i]."</pre>";
        }
    }

    public function customRingGameValidatorRazzStud($seats, $bigBet, $smallBet) {
        if (($seats < \Config::get('poker.minSeats') || $seats > \Config::get('poker.maxSeatsRazzStud')))  {
            return ['success' => false, 'error' => 'Razz/Stud seat count must be from '.\Config::get('poker.minSeats').' to '.\Config::get('poker.maxSeatsRazzStud').'.'];
        }
        if ($bigBet < \Config::get('poker.minBigBet') || $bigBet > \Config::get('poker.maxBigBet')) {
            return ['success' => false, 'error' => 'Big bet must be from '.\Config::get('poker.minBigBet').' to '.\Config::get('poker.maxBigBet').' chips.'];
        }
        if ($smallBet < \Config::get('poker.minSmallBet') || $smallBet > \Config::get('poker.maxSmallBet')) {
            return ['success' => false, 'error' => 'Small bet must be from '.\Config::get('poker.minSmallBet').' to '.\Config::get('poker.maxSmallBet').' chips.'];
        }
        return ['success' => true, 'msg' => 'All custom game rules passed.'];
    }

    public function customRingGameErrors($name, $game, $minBuyIn, $maxBuyIn, $seats, $bb, $sb) {
        $errors = [];
        if ($maxBuyIn < $minBuyIn) $errors[] = "Maximum buy-in cannot be less than minimum buy-in.";
        if ($bb < $sb) $errors[] = "Big blind/bet cannot be less than small blind/bet.";
        if (strpos($name, "[") !== false ||
            strpos($name, "=") !== false ||
            strpos($name, "\\") !== false ||
            strpos($name, "<") !== false)
            $errors[] = "Table name cannot contain reserved characters [, =, \\, <";
        if (!in_array($game, \Config::get('poker.gameTypes'))) $errors[] = "Unknown game type.";

        if ($minBuyIn < \Config::get('poker.minBuyIn') || $minBuyIn > \Config::get('poker.maxBuyIn')) {
            $errors[] = "Minimum Buy-In must be a number between ".\Config::get('poker.maxTableNameLength')." - ".\Config::get('poker.maxBuyIn').".";
        }

        if ($maxBuyIn < \Config::get('poker.minBuyIn') || $maxBuyIn > \Config::get('poker.maxBuyIn')) {
            $errors[] = 'Maximum Buy-In must be a number between '.\Config::get('poker.minBuyIn').' - '.\Config::get('poker.maxBuyIn').'.';
        }

        if (($seats < \Config::get('poker.minSeats') || $seats > \Config::get('poker.maxSeats')))  {
            $errors[] = 'Hold\'Em/Omaha seat count must be from '.\Config::get('poker.minSeats').' to '.\Config::get('poker.maxSeatsRazzStud').'.';
        }

        if ($bb < \Config::get('poker.minBigBlind') || $bb > \Config::get('poker.maxBigBlind')) {
            $errors[] = 'Big Blind must be from '.\Config::get('poker.minBigBlind').' to '.\Config::get('poker.maxBigBlind').' chips.';
        }

        if ($sb < \Config::get('poker.minSmallBlind') || $sb > \Config::get('poker.maxSmallBlind')) {
            $errors[] = 'Small Blind must be from '.\Config::get('poker.minSmallBlind').' to '.\Config::get('poker.maxSmallBlind').' chips.';
        }
        return $errors;
    }

    public function _createCustomRingGameHoldemOmaha($player, $name, $game, $seats, $sb, $bb, $minBuyIn, $maxBuyIn, $pw) {
        return $this->api([
            'Command' => 'RingGamesAdd',
            'Name' => $name,
            'Game' => $game,
            'PW' => $pw,
            'Private' => 'Yes',
            'Seats' => $seats,
            'BuyInMin' => $minBuyIn,
            'BuyInMax' => $maxBuyIn,
            'BuyInDef' => ($maxBuyIn / 2),
            'RakePercent' => \Config::get('poker.rakePercentage'),
            'SmallBlind' => $sb,
            'BigBlind' => $bb,
            'DupeIPs' => 'No',
            'Log' => "Creating custom ring game $game by user $player."
        ]);
    }

    public function _createCustomRingGameRazzStud($player, $name, $game, $seats, $smallBet, $bigBet, $minBuyIn, $maxBuyIn, $pw) {
        return $this->api([
            'Command' => 'RingGamesAdd',
            'Log' => "Custom ring game creation by player $player",
            'Name' => $name,
            'Game' => $game,
            'PW' => $pw,
            'Private' => 'Yes',
            'Seats' => $seats,
            'BuyInMin' => $minBuyIn,
            'BuyInMax' => $maxBuyIn,
            'BuyInDef' => ($maxBuyIn / 2),
            'RakePercent' => \Config::get('poker.rakePercentage'),
            'SmallBet' => $smallBet,
            'BigBet' => $bigBet,
            'BringIn' => ($smallBet / 2),
            'Ante' => ($smallBet / 2),
            'DupeIPs' => 'No'
        ]);
    }

    public function apiError($api) { logger('API Error: '.PHP_EOL.print_r($api, 1)); }

    public function _setAvatar($player, $avatar) {
        return $this->api([
            'Command' => 'AccountsEdit',
            'Player' => $player,
            'Avatar' => $avatar,
            'Log' => "Setting avatar #$avatar for player $player"
        ]);
    }

    public function _setLocation($player, $location) {
        return $this->api([
            'Command' => 'AccountsEdit',
            'Player' => $player,
            'Location' => $location,
            'Log' => "Setting location $location for player $player."
        ]);
    }

    public function _setEmail($player, $email) {
        return $this->api([
            'Command' => 'AccountsEdit',
            'Player' => $player,
            'Email' => $email,
            'Log' => "Setting email $email for player $player."
        ]);
    }

    public function _setAvatarCustom($player, $avatarFile) {
        return $this->api([
            'Command' => 'AccountsEdit',
            'Player' => $player,
            'AvatarFile' => $avatarFile,
            'Avatar' => 0,
            'Log' => "Setting custom avatar $avatarFile for player $player."
        ]);
    }

    public function putRingGameOnline($name) {
        return $this->api([
            'Command' => 'RingGamesOnline',
            'Name' => $name,
            'Log' => "Putting Ring Game $name online."
        ]);
    }

    public function putRingGameOffline($name) {
        return $this->api([
            'Command' => 'RingGamesOffline',
            'Name' => $name,
            'Log' => "Putting Ring Game $name offline."
        ]);
    }
}
