<?php namespace App;

use App\Traits\Inventory;
use Illuminate\Database\Eloquent\Model;

class Deposit extends Model
{
    use Inventory;

    public function depositItems($itemNames, $itemsValue, $items, $steamId, $player, $tradeLink) {
        $deposit = new Deposit;
        $deposit->steamid = $steamId;
        $deposit->trade_link = $tradeLink;
        $deposit->items = json_encode($items);
        $deposit->item_names = json_encode($itemNames);
        $deposit->items_value = $itemsValue;
        $deposit->player = $player;
        $deposit->status = 'Waiting for Socket.IO';
        if($deposit->save()) {
            return [
                "success" => true,
                "id" => $deposit->id,
                "itemNames" => $deposit->item_names,
                "items" => $deposit->items,
                "itemsValue" => $deposit->items_value,
                "steamId" => $deposit->steamid,
                "tradeLink" => $deposit->trade_link
            ];
        }
        return [
            "success" => false,
            "error" => "Error when saving Deposit to Database."
        ];
    }

    public static function stats($steamid) {
        $whereAccepted = Deposit::where([['steamid', '=', $steamid], ['status', '=', 'Accepted']]);

        $amountDeposited = 0;
        foreach($whereAccepted->select(['items_value'])->get() as $deposit) $amountDeposited = $amountDeposited + $deposit->items_value;
        return [
            'amountDeposited' => $amountDeposited,
            'timesDeposited' => $whereAccepted->count()
        ];
    }

    public function amountDeposited($steamid) {
        $amountDeposited = 0;
        foreach(Deposit::where([['steamid', '=', $steamid], ['status', '=', 'Accepted']])->select(['items_value'])->get() as $deposit)
            $amountDeposited = $amountDeposited + $deposit->items_value;
        return $amountDeposited;
    }

    public function timesDeposited($steamid) {
        return Deposit::where([['steamid', '=', $steamid], ['status', '=', 'Accepted']])->count();
    }
}
