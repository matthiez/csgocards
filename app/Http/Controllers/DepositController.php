<?php namespace App\Http\Controllers;

use App\Traits\Helper;
use App\Traits\Inventory;
use Auth;
use App\Deposit;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class DepositController extends Controller
{
    use Inventory;
    use Helper;

    private $model;

    public function __construct(Deposit $deposit, Request $request) {
        $this->model = $deposit;
    }

    public function deposit(Request $request): JsonResponse {
        $this->validate($request, [
            'items' => 'required'
        ]);

        if(!$this::isPingable('io'))
            return response()->json('The cashier is not ready just yet. Try again later.', 400);

        $items = json_decode($request->input('items'));
        $user = Auth::user();

        if(!isset($user->trade_link))
            return response()->json('Aborting because your tradelink could not be found. Did you set one up?', 400);

        if(!isset($user->steamid))
            return response()->json('Failed to retrieve your SteamID. Try again.', 400);

        if(!isset($user->player))
            return response()->json('Failed to retrieve your player name. Are you registered?', 400);

        try {
            $itemNames = $this::getMarketHashNames($user->steamid, $items);
        } catch(\Exception $err) {
            logger($err);
        }

        if(!isset($itemNames))
            return response()->json('Failed to get all market hash names. Are all items still in your inventory?', 400);

        if(count($itemNames) !== count($items))
            return response()->json('Unexpected items count. Probably failed to get all market hash names.', 400);

        $itemsValue = $this::getItemValues($itemNames);
        if(!$itemsValue)
            return response()->json('Failed to get item prices.', 400);
        if(count($itemsValue) !== count($itemNames)) return response()->json('Failed to get a price for each item. Please try again.', 400);
        $iv = 0;
        foreach($itemsValue as $v) $iv += $v->price;
        $itemsValue = $iv;

        if($itemsValue === 0)
            return response()->json("Aborting because the total item value could not be calculated. Please contact an admin.");

        $deposit = $this->model->depositItems($itemNames, $itemsValue, $items, $user->steamid, $user->player, $user->trade_link);

        if($deposit['success'])
            return response()->json($deposit['id']);

        if(isset($deposit['error']))
            return response()->json('Error depositing items. Please contact an admin.', 400);
        return response()->json('Error depositing items. Please contact an administrator.', 400);
    }
}
