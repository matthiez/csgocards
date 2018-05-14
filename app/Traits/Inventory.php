<?php namespace App\Traits;

use Illuminate\Support\Collection;

trait Inventory
{
    public static $appid = 730;
    public static $contextid = 2;

    /**
     * @param $steamId
     * @param array $assetIds
     * @return array
     * @throws \Exception
     */
    public static function getMarketHashNames($steamId, $assetIds = []): array {
        $marketHashNames = [];
        try {
            $inventory = static::getInventoryFromSteam($steamId);
        } catch(\Exception $err) {
            logger($err);
        }
        if(isset($inventory))
            if(empty($assetIds))
                foreach($inventory as $item)
                    $marketHashNames[] = $item['market_hash_name'];
            else
                foreach($inventory as $item)
                    foreach($assetIds as $assetId)
                        if(isset($item['assetid']) && $assetId == $item['assetid'])
                            $marketHashNames[] = $item['market_hash_name'];
                        else throw new \Exception('Failed to get Steam inventory.');
        return $marketHashNames;
    }

    public static function getItemValues($market_hash_names): Collection {
        return \DB::connection('pdb')->table('csgo')->whereIn('market_hash_name', $market_hash_names)->get();
    }

    public static function getItemRarity($rarity): String {
        if(stripos($rarity, 'Base Grade') !== false) return "base";
        if(stripos($rarity, 'Consumer Grade') !== false) return "consumer";
        if(stripos($rarity, 'Industrial Grade') !== false) return "industrial";
        if(stripos($rarity, 'Mil-spec') !== false) return "mil-spec";
        if(stripos($rarity, 'Restricted') !== false) return "restricted";
        if(stripos($rarity, 'Classified') !== false) return "classified";
        if(stripos($rarity, 'Covert') !== false) return "covert";
        if(stripos($rarity, 'Exceedingly Rare') !== false) return "rare";
        if(stripos($rarity, 'Contraband') !== false) return "contraband";
        return '';
    }


    /**
     * @param $steamId
     * @param null $appid
     * @param null $contextid
     * @return Collection
     * @throws \Exception
     */
    public static function getInventoryFromSteam($steamId, $appid = null, $contextid = null): Collection {
        $steamInventory = app()->make('steam-inventory');
        if(!isset($appid)) $appid = config('steam-inventory.app_id', static::$appid);
        if(!isset($contextid)) $contextid = config('steam-inventory.context_id', static::$contextid);

        if(!is_numeric($steamId)) throw new \Exception('SteamID must be numeric.');
        if(strlen($steamId) !== 17) throw new \Exception('SteamID must be be 17 digits long.');
        return $steamInventory->loadInventory($steamId, $appid, $contextid)->getInventoryWithDescriptions($contextid);
    }
}
