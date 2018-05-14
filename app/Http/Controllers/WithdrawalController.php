<?php namespace App\Http\Controllers;

use Auth;
use App\Traits\Inventory;
use App\Traits\Poker;
use App\Withdrawal;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class WithdrawalController extends Controller
{
    use Inventory, Poker;

    private $withdrawal;

    private $bots;

    public function __construct(Withdrawal $withdrawal, Request $request) {
        $this->withdrawal = $withdrawal;
        $this->bots = config('bots');
    }

    public function getInventory(Request $request): JsonResponse {
        $inventory = [];
        $this->validate($request, [
            'inventory' => 'required|string'
        ]);
        $k = $this->bots[$request->input('inventory')];
        if(empty($k)) {
            logger("Unknown bot $k");
            return response()->json('Error. Try again later.', 400);
        }
        $data = [];
        try {
            $data = $this::getInventoryFromSteam($k);
        } catch(\Exception $e) {
            logger($e);
            return response()->json('Error. Try again later.', 400);
        }

        $marketHashNames = [];
        foreach($data as $item) if(isset($item['market_hash_name'])) $marketHashNames[] = $item['market_hash_name'];

        $itemPrices = $this::getItemValues($marketHashNames);

        foreach($data as $item) {
            if(isset($item['type'])) $item['rarity'] = $this::getItemRarity($item['type']);
            if(isset($item['market_hash_name'])) {
                $val = $itemPrices->filter(function($v, $key) use ($item) {
                    return isset($v->market_hash_name) && $v->market_hash_name == $item['market_hash_name'];
                });
                if(!count($val->first())) {
                    $item['value'] = 0;
                    continue;
                }
                $item['value'] = $val->first()->price;
            }
            if((int)$item['assetid'] !== 5305059322) $inventory[] = $item; // skip tec9 toxic giveaway
        }
        return response()->json($inventory);
    }

    public function withdrawItems(Request $request): JsonResponse {
        $this->validate($request, [
            'inventory' => 'required|string',
            'items' => 'required'
        ]);

        if(!\App\Traits\Helper::isPingable('io')) return response()->json('The cashier is not ready just yet. Try again later.', 400);

        $items = json_decode($request->input('items'));
        $bot = $request->input('inventory');
        if(!$this->bots[$bot]) return response()->json('Unknown Inventory!', 400);
        $invSteamId = $this->bots[$bot];
        $user = Auth::user();
        if(empty($user->trade_link))
            return response()->json('Aborting because your tradelink could not be found. Did you set one up?', 400);

        try {
            $itemNames = $this::getMarketHashNames($invSteamId, $items);
        } catch(\Exception $e) {
            return response()->json('Failed to get item names.', 400);
        }

        if(count($itemNames) !== count($items))
            return response()->json('Unexpected count. Probably failed to get all market hash names.', 400);
        $itemsValue = $this::getItemValues($itemNames);
        if(!$itemsValue)
            return response()->json('Failed to get item prices.', 400);

        if(count($itemsValue) !== count($itemNames)) return response()->json('Failed to get a price for each item. Please try again.', 400);
        $iv = 0;
        foreach($itemsValue as $v) $iv += $v->price;
        $itemsValue = (int)$iv;

        if($itemsValue === 0 || !is_int($itemsValue))
            return response()->json('Aborting because the total item value could not be calculated. Please try again.', 400);

        $balance = $this->getBalance($user->player);
        if($balance < $itemsValue)
            return response()->json('Aborting because your balance is not high enough to withdraw these items.', 400);

        $withdrawal = $this->withdrawal->withdrawItems($user->steamid, $user->player, $items, $invSteamId, $user->trade_link, $itemNames, $itemsValue);
        if(isset($withdrawal['success']) && isset($withdrawal['id']))
            return response()->json($withdrawal['id']);
        return response()->json('Error while withdrawing items. Please contact an admin.', 400);
    }
}
