<?php namespace App;

use App\Traits\Inventory;
use App\Traits\Poker;
use Illuminate\Database\Eloquent\Model;

class Withdrawal extends Model
{
    use Inventory, Poker;

    public function withdrawItems($steamId, $player, $items, $invSteamId, $tradeLink, $itemNames, $itemsValue) {
        $withdrawal = new Withdrawal;
        $withdrawal->trade_link = $tradeLink;
        $withdrawal->steamid = $steamId;
        $withdrawal->inventory_steamid = $invSteamId;
        $withdrawal->items = json_encode($items);
        $withdrawal->item_names = json_encode($itemNames);
        $withdrawal->items_value = $itemsValue;
        $withdrawal->player = $player;
        $withdrawal->trade_offer_id = null;
        $withdrawal->status = 'Waiting for Socket.IO';
        $save = $withdrawal->save();
        if($save) {
            return [
                "success" => true,
                "id" => $withdrawal->id,
                "itemNames" => $withdrawal->item_names,
                "items" => $withdrawal->items,
                "itemsValue" => $withdrawal->items_value,
                "steamId" => $withdrawal->steamid,
                "tradeLink" => $withdrawal->trade_link
            ];
        }
        return [
            "success" => false,
            "error" => $save
        ];
    }

    public function whereAccepted() {

    }

    public static function stats($steamid) {
        $whereAccepted = Withdrawal::where([['steamid', '=', $steamid], ['status', '=', 'Accepted']]);

        $amountWithdrawn = 0;
        foreach($whereAccepted->select(['items_value'])->get() as $withdrawal) $amountWithdrawn = $amountWithdrawn + $withdrawal->items_value;
        return [
            'amountWithdrawn' => $amountWithdrawn,
            'timesWithdrawn' => $whereAccepted->count()
        ];
    }

    public static function amountWithdrawn($steamid) {
        $amountWithdrawn = 0;
        foreach(Withdrawal::where([['steamid', '=', $steamid], ['status', '=', 'Accepted']])->select(['items_value'])->get() as $withdrawal)
            $amountWithdrawn = $amountWithdrawn + $withdrawal->items_value;
        return $amountWithdrawn;
    }

    public static function timesWithdrawn($steamid) {
        return Withdrawal::where([['steamid', '=', $steamid], ['status', '=', 'Accepted']])->count();
    }
}
