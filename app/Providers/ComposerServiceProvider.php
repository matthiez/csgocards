<?php namespace App\Providers;

use App\CustomGame;
use App\Deposit;
use App\Traits\Helper;
use App\Traits\Inventory;
use App\Traits\Poker;
use App\Withdrawal;
use Auth;
use Syntax\SteamApi\Client as SteamClient;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    use Helper, Inventory, Poker;

    public function boot() {
        $Deposit = new Deposit();
        $Withdrawal = new Withdrawal();

        \View::composer('*', function($view) use ($Deposit, $Withdrawal) {
            $view->user = [
                'steam' => [],
                'general' => [],
                'poker' => []
            ];
            $view->isRegged = false;
            $user = Auth::check() ? Auth::user() : null;
            if(isset($user)) {
                list('amountWithdrawn' => $withdrawalAmountWithdrawn, 'timesWithdrawn' => $withdrawalTimesWithdrawn) = Withdrawal::stats($user->steamid);
                list('amountDeposited' => $depositAmountDeposited, 'timesDeposited' => $depositTimesDeposited) = Deposit::stats($user->steamid);

                $view->user['general']['email'] = $user->email;
                $view->user['general']['id'] = $user->id;
                //$view->user['general']['ip'] = $user->ip;
                $view->user['general']['token'] = $user->token;
                $view->user['general']['timezone'] = $user->timezone;

                $view->user['steam']['id'] = $user->steamid;
                $view->user['steam']['tradeLink'] = $user->trade_link;
                $view->user['steam']['personaName'] = $user->steam_persona_name;
                $view->user['steam']['avatar'] = $user->steam_avatar;

                $view->user['bank']['amountDeposited'] = $depositAmountDeposited;
                $view->user['bank']['amountWithdrawn'] = $withdrawalAmountWithdrawn;
                $view->user['bank']['timesDeposited'] = $depositTimesDeposited;
                $view->user['bank']['timesWithdrawn'] = $withdrawalTimesWithdrawn;

                session()->put('amountDeposited', $depositAmountDeposited);
                session()->put('amountWithdrawn', $withdrawalAmountWithdrawn);
                session()->put('timesDeposited', $depositTimesDeposited);
                session()->put('timesWithdrawn', $withdrawalTimesWithdrawn);

                if(isset($user->player)) {
                    $pmApi = $this->api([
                        "Command" => "AccountsGet",
                        "Player" => $user->player
                    ]);
                    if(isset($pmApi->Error)) {
                        logger('A player was found in DB, but API cant find the player.', [$pmApi]);
                        session()->put('error', 'Error connecting to Poker. Not all functionalities will work at this point. ' . $pmApi->Error);
                    } else {
                        $view->isRegged = true;
                        $view->user['poker']['avatar'] = $pmApi->Avatar;
                        //$view->user['poker']['avatarFile'] = $pmApi->AvatarFile;
                        $view->user['poker']['balance'] = $pmApi->Balance;
                        $view->user['poker']['chat'] = $pmApi->Chat;
                        $view->user['poker']['chatColor1'] = $pmApi->ChatColor1;
                        $view->user['poker']['chatColor2'] = $pmApi->ChatColor2;
                        $view->user['poker']['chipsAccept'] = $pmApi->ChipsAccept;
                        $view->user['poker']['chipsTransfer'] = $pmApi->ChipsTransfer;
                        $view->user['poker']['custom'] = $pmApi->Custom;
                        //$view->user['poker']['email'] = $pmApi->Email;
                        $view->user['poker']['eRake'] = $pmApi->ERake;
                        $view->user['poker']['firstLogin'] = $pmApi->FirstLogin;
                        $view->user['poker']['gender'] = $pmApi->Gender;
                        $view->user['poker']['lastLogin'] = $pmApi->LastLogin;
                        $view->user['poker']['lastReset'] = $pmApi->LastReset;
                        $view->user['poker']['location'] = $pmApi->Location;
                        $view->user['poker']['level'] = $pmApi->Level;
                        $view->user['poker']['logins'] = $pmApi->Logins;
                        //$view->user['poker']['note'] = $pmApi->Note;
                        $view->user['poker']['permissions'] = $pmApi->Permissions;
                        $view->user['poker']['player'] = $pmApi->Player;
                        $view->user['poker']['pRake'] = $pmApi->PRake;
                        $view->user['poker']['profit']
                            = $view->user['bank']['amountWithdrawn']
                            + $pmApi->Balance
                            - $view->user['bank']['amountDeposited'];
                        $view->user['poker']['realName'] = $pmApi->RealName;
                        //$view->user['poker']['sessionId'] = $pmApi->SessionID;
                        $view->user['poker']['tickets'] = $pmApi->Tickets;
                        $view->user['poker']['title'] = $pmApi->Title;
                        $view->user['poker']['tourneyFees'] = $pmApi->TFees;
                        $view->user['poker']['ringChips'] = $pmApi->RingChips;
                        $view->user['poker']['regChips'] = $pmApi->RegChips;
                        //$view->user['poker']['valCode'] = $pmApi->ValCode;

                        session()->put('pokerAvatar', $pmApi->Avatar);
                        //session()->put('pokerAvatarFile', $pmApi->AvatarFile);
                        session()->put('pokerBalance', $pmApi->Balance);
                        session()->put('pokerChat', $pmApi->Chat);
                        session()->put('pokerChatColor1', $pmApi->ChatColor1);
                        session()->put('pokerChatColor2', $pmApi->ChatColor2);
                        session()->put('pokerChipsAccept', $pmApi->ChipsAccept);
                        session()->put('pokerChipsTransfer', $pmApi->ChipsTransfer);
                        session()->put('pokerCustom', $pmApi->Custom);
                        //session()->put('pokerEmail', $pmApi->Email);
                        session()->put('pokerERake', $pmApi->ERake);
                        session()->put('pokerFirstLogin', $pmApi->FirstLogin);
                        session()->put('pokerGender', $pmApi->Gender);
                        session()->put('pokerLastLogin', $pmApi->LastLogin);
                        session()->put('pokerLastReset', $pmApi->LastReset);
                        session()->put('pokerLocation', $pmApi->Location);
                        session()->put('pokerLevel', $pmApi->Level);
                        session()->put('pokerLogins', $pmApi->Logins);
                        //session()->put('pokerNote', $pmApi->Note);
                        session()->put('pokerPermissions', $pmApi->Permissions);
                        session()->put('pokerPlayer', $pmApi->Player);
                        session()->put('pokerPRake', $pmApi->PRake);
                        session()->put('pokerProfit',
                            $view->user['bank']['amountWithdrawn']
                            + $pmApi->Balance
                            - $view->user['bank']['amountDeposited']);
                        session()->put('pokerRealName', $pmApi->RealName);
                        //session()->put('pokerSessionId', $pmApi->SessionID);
                        session()->put('pokerTickets', $pmApi->Tickets);
                        session()->put('pokerTitle', $pmApi->Title);
                        session()->put('pokerTourneyFees', $pmApi->TFees);
                        session()->put('pokerRingChips', $pmApi->RingChips);
                        session()->put('pokerRegChips', $pmApi->RegChips);
                        //session()->put('pokerValCode', $pmApi->ValCode);
                    }
                }
            }
        });

        \View::composer('deposit', function($view) {
            $viewData = [
                'steamDown' => false,
                'inventory' => []
            ];

            $user = Auth::check() ? Auth::user() : null;
            if(!isset($user->steamid)) return;

            $inventory = $this::getInventoryFromSteam($user->steamid);

            $itemPrices = $this::getItemValues($inventory->map(function($v) {
                return $v['market_hash_name'];
            }));

            foreach($inventory as $item) {
                if(!isset($item['type'])) continue;
                $rarity = $this::getItemRarity($item['type']);
                if(empty($rarity)) continue;
                $item['rarity'] = $rarity;
                if(!isset($item['market_hash_name'])) continue;
                $collection = $itemPrices->filter(function($v) use ($item) {
                    return isset($v->market_hash_name) && $v->market_hash_name == $item['market_hash_name'];
                });
                $val = $collection->first();
                $item['value'] = isset($val) ? $val->price : 0;
                $viewData['inventory'][] = $item;
            }
            foreach($viewData as $k => $v)
                if(!property_exists($view, $k))
                    $view->$k = $v;
        });

        \View::composer('partials.poker.my-custom-games', function($view) {
            $CustomGame = new CustomGame();
            $user = Auth::check() ? Auth::user() : null;
            $view->customGamesDb = [];
            $view->customGamesApi = [];
            $customGames = $CustomGame->getCustomGames($user->steamid);
            if(!isset($customGames)) return;
            $view->customGamesDb = $customGames;
            foreach($customGames as $cG) {
                $view->customGamesApi[] = $this->api([
                    "Command" => "RingGamesGet",
                    "Name" => $cG->name
                ]);
            }
        });

        \View::composer('poker', function($view) {
            $user = Auth::check() ? Auth::user() : null;
            $pmApi = $this->api([
                "Command" => "AccountsSessionKey",
                "Player" => $user->player
            ]);
            if(isset($pmApi->Error)) session()->put('error', 'Authentication error. Try to reload the page. ' . $pmApi->Error);
            $view->sessionKey = (isset($pmApi->SessionKey)) ? $pmApi->SessionKey : null;
        });

        \View::composer('statistics', function($view) {
            $view->rank = 0;
            $view->chipLeaders = $this->chipLeaders();
            $view->tourneys = $this->tourneyResults();
        });

        \View::composer('csgo-news', function($view) {
            $SteamClient = new SteamClient();
            $view->news = $SteamClient->news()->GetNewsForApp(730, 6, null)->newsitems;
        });

        \View::composer('history', function($view) {
            $view->deposits = Deposit::get();
            $view->withdrawals = Withdrawal::get();
        });

        \View::composer('withdrawal', function($view) use ($Withdrawal) {
            $view->bots = config('bots');
        });

        \View::composer('admin', function($view) {
            $view->systemStats = $this->systemStats();
        });
    }

    public function register() {
    }
}