<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use OTPHP\TOTP;

class Price extends Model
{
    private $bitSkinsApiKey;
    private $bitSkinsApiUrl = "https://bitskins.com/api/v1/get_all_item_prices";
    private $bitSkinsTotpToken;

    private $steamApisUrl = 'http://api.steamapis.com/market/items/730';

    private $csgofastApiUrl = 'https://api.csgofast.com/price/all';

    public function __construct(array $attributes = []) {
        parent::__construct();

       $this->bitSkinsApiKey = config('app.bitskins_apiKey');
       $this->bitSkinsTotpToken = config('app.bitskins_totpToken');
    }

    private function getTotpCode() {
        $totp = new TOTP($this->bitSkinsTotpToken);
        return $totp->now();
    }

    private function getPriceListJson($url) {
        $json = file_get_contents($url);
        return $json ? $json : false;
    }

    public function updatePricesSteamApis() {
        foreach(
            json_decode($this->getPriceListJson($this->csgofastApiUrl), true)
            as $key => $value) {
            $price = new Price();
            $price->market_hash_name = $key;
            $price->price = $value * 1000;
            $price->save();
        }
    }
}
