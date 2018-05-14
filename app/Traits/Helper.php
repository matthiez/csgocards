<?php namespace App\Traits;

trait Helper
{
    public static function timezoneLabel($timezone): String {
        switch($timezone) {
            case 'Pacific/Midway':
                $text = '(UTC-11:00) Midway Island';
                break;
            case 'Pacific/Samoa':
                $text = '(UTC-11:00) Samoa';
                break;
            case 'Pacific/Honolulu':
                $text = '(UTC-10:00) Hawaii';
                break;
            case 'US/Alaska':
                $text = '(UTC-09:00) Alaska';
                break;
            case 'America/Los_Angeles':
                $text = '(UTC-08:00) Pacific Time (US &amp; Canada)';
                break;
            case 'America/Tijuana':
                $text = '(UTC-08:00) Tijuana';
                break;
            case 'US/Arizona':
                $text = '(UTC-07:00) Arizona';
                break;
            case 'America/Chihuahua':
                $text = '(UTC-07:00) Chihuahua';
                break;
            case 'America/Mazatlan':
                $text = '(UTC-07:00) Mazatlan';
                break;
            case 'US/Mountain':
                $text = '(UTC-07:00) Mountain Time (US &amp; Canada)';
                break;
            case 'America/Managua':
                $text = '(UTC-06:00) Central America';
                break;
            case 'US/Central':
                $text = '(UTC-06:00) Central Time (US &amp; Canada)';
                break;
            case 'America/Mexico_City':
                $text = '(UTC-06:00) Mexico City';
                break;
            case 'America/Monterrey':
                $text = '(UTC-06:00) Monterrey';
                break;
            case 'Canada/Saskatchewan':
                $text = '(UTC-06:00) Saskatchewan';
                break;
            case 'America/Bogota':
                $text = '(UTC-05:00) Bogota';
                break;
            case 'US/Eastern':
                $text = '(UTC-05:00) Eastern Time (US &amp; Canada)';
                break;
            case 'US/East-Indiana':
                $text = '(UTC-05:00) Indiana (East)';
                break;
            case 'America/Lima':
                $text = '(UTC-05:00) Lima';
                break;
            case 'Canada/Atlantic':
                $text = '(UTC-04:00) Atlantic Time (Canada)';
                break;
            case 'America/Caracas':
                $text = '(UTC-04:30) Caracas';
                break;
            case 'America/La_Paz':
                $text = '(UTC-04:00) La Paz';
                break;
            case 'America/Santiago':
                $text = '(UTC-04:00) Santiago';
                break;
            case 'Canada/Newfoundland':
                $text = '(UTC-03:30) Newfoundland';
                break;
            case 'America/Sao_Paulo':
                $text = '(UTC-03:00) Brasilia';
                break;
            case 'America/Argentina/Buenos_Aires':
                $text = '(UTC-03:00) Buenos Aires';
                break;
            case 'America/Godthab':
                $text = '(UTC-03:00) Greenland';
                break;
            case 'America/Noronha':
                $text = '(UTC-02:00) Mid-Atlantic';
                break;
            case 'Atlantic/Azores':
                $text = '(UTC-01:00) Azores';
                break;
            case 'Atlantic/Cape_Verde':
                $text = '(UTC-01:00) Cape Verde Is.';
                break;
            case 'Africa/Casablanca':
                $text = '(UTC+00:00) Casablanca';
                break;
            case 'Etc/Greenwich':
                $text = '(UTC+00:00) Greenwich Mean Time : Dublin';
                break;
            case 'Europe/Lisbon':
                $text = '(UTC+00:00) Lisbon';
                break;
            case 'Europe/London':
                $text = '(UTC+00:00) London';
                break;
            case 'Africa/Monrovia':
                $text = '(UTC+00:00) Monrovia';
                break;
            case 'UTC':
                $text = '(UTC+00:00) UTC';
                break;
            case 'Europe/Amsterdam':
                $text = '(UTC+01:00) Amsterdam';
                break;
            case 'Europe/Belgrade':
                $text = '(UTC+01:00) Belgrade';
                break;
            case 'Europe/Berlin':
                $text = '(UTC+01:00) Berlin';
                break;
            case 'Europe/Bratislava':
                $text = '(UTC+01:00) Bratislava';
                break;
            case 'Europe/Brussels':
                $text = '(UTC+01:00) Brussels';
                break;
            case 'Europe/Budapest':
                $text = '(UTC+01:00) Budapest';
                break;
            case 'Europe/Copenhagen':
                $text = '(UTC+01:00) Copenhagen';
                break;
            case 'Europe/Ljubljana':
                $text = '(UTC+01:00) Ljubljana';
                break;
            case 'Europe/Madrid':
                $text = '(UTC+01:00) Madrid';
                break;
            case 'Europe/Paris':
                $text = '(UTC+01:00) Paris';
                break;
            case 'Europe/Prague':
                $text = '(UTC+01:00) Prague';
                break;
            case 'Europe/Rome':
                $text = '(UTC+01:00) Rome';
                break;
            case 'Europe/Sarajevo':
                $text = '(UTC+01:00) Sarajevo';
                break;
            case 'Europe/Skopje':
                $text = '(UTC+01:00) Skopje';
                break;
            case 'Europe/Stockholm':
                $text = '(UTC+01:00) Stockholm';
                break;
            case 'Europe/Vienna':
                $text = '(UTC+01:00) Vienna';
                break;
            case 'Europe/Warsaw':
                $text = '(UTC+01:00) Warsaw';
                break;
            case 'Africa/Lagos':
                $text = '(UTC+01:00) West Central Africa';
                break;
            case 'Europe/Zagreb':
                $text = '(UTC+01:00) Zagreb';
                break;
            case 'Europe/Athens':
                $text = '(UTC+02:00) Athens';
                break;
            case 'Europe/Bucharest':
                $text = '(UTC+02:00) Bucharest';
                break;
            case 'Africa/Cairo':
                $text = '(UTC+02:00) Cairo';
                break;
            case 'Africa/Harare':
                $text = '(UTC+02:00) Harare';
                break;
            case 'Europe/Helsinki':
                $text = '(UTC+02:00) Helsinki';
                break;
            case 'Europe/Istanbul':
                $text = '(UTC+02:00) Istanbul';
                break;
            case 'Asia/Jerusalem':
                $text = '(UTC+02:00) Jerusalem';
                break;
            case 'Africa/Johannesburg':
                $text = '(UTC+02:00) Pretoria';
                break;
            case 'Europe/Riga':
                $text = '(UTC+02:00) Riga';
                break;
            case 'Europe/Sofia':
                $text = '(UTC+02:00) Sofia';
                break;
            case 'Europe/Tallinn':
                $text = '(UTC+02:00) Tallinn';
                break;
            case 'Europe/Vilnius':
                $text = '(UTC+02:00) Vilnius';
                break;
            case 'Asia/Baghdad':
                $text = '(UTC+03:00) Baghdad';
                break;
            case 'Asia/Kuwait':
                $text = '(UTC+03:00) Kuwait';
                break;
            case 'Europe/Minsk':
                $text = '(UTC+03:00) Minsk';
                break;
            case 'Africa/Nairobi':
                $text = '(UTC+03:00) Nairobi';
                break;
            case 'Asia/Riyadh':
                $text = '(UTC+03:00) Riyadh';
                break;
            case 'Europe/Volgograd':
                $text = '(UTC+03:00) Volgograd';
                break;
            case 'Asia/Tehran':
                $text = '(UTC+03:30) Tehran';
                break;
            case 'Asia/Baku':
                $text = '(UTC+04:00) Baku';
                break;
            case 'Europe/Moscow':
                $text = '(UTC+04:00) Moscow';
                break;
            case 'Asia/Muscat':
                $text = '(UTC+04:00) Muscat';
                break;
            case 'Asia/Tbilisi':
                $text = '(UTC+04:00) Tbilisi';
                break;
            case 'Asia/Yerevan':
                $text = '(UTC+04:00) Yerevan';
                break;
            case 'Asia/Kabul':
                $text = '(UTC+04:30) Kabul';
                break;
            case 'Asia/Karachi':
                $text = '(UTC+05:00) Karachi';
                break;
            case 'Asia/Tashkent':
                $text = '(UTC+05:00) Tashkent';
                break;
            case 'Asia/Kolkata':
                $text = '(UTC+05:30) Kolkata';
                break;
            case 'Asia/Calcutta':
                $text = '(UTC+05:30) Mumbai';
                break;
            case 'Asia/Katmandu':
                $text = '(UTC+05:45) Kathmandu';
                break;
            case 'Asia/Almaty':
                $text = '(UTC+06:00) Almaty';
                break;
            case 'Asia/Dhaka':
                $text = '(UTC+06:00) Dhaka';
                break;
            case 'Asia/Yekaterinburg':
                $text = '(UTC+06:00) Ekaterinburg';
                break;
            case 'Asia/Rangoon':
                $text = '(UTC+06:30) Rangoon';
                break;
            case 'Asia/Bangkok':
                $text = '(UTC+07:00) Bangkok';
                break;
            case 'Asia/Jakarta':
                $text = '(UTC+07:00) Jakarta';
                break;
            case 'Asia/Novosibirsk':
                $text = '(UTC+07:00) Novosibirsk';
                break;
            case 'Asia/Chongqing':
                $text = '(UTC+08:00) Chongqing';
                break;
            case 'Asia/Hong_Kong':
                $text = '(UTC+08:00) Hong Kong';
                break;
            case 'Asia/Krasnoyarsk':
                $text = '(UTC+08:00) Krasnoyarsk';
                break;
            case 'Asia/Kuala_Lumpur':
                $text = '(UTC+08:00) Kuala Lumpur';
                break;
            case 'Australia/Perth':
                $text = '(UTC+08:00) Perth';
                break;
            case 'Asia/Singapore':
                $text = '(UTC+08:00) Singapore';
                break;
            case 'Asia/Taipei':
                $text = '(UTC+08:00) Taipei';
                break;
            case 'Asia/Ulan_Bator':
                $text = '(UTC+08:00) Ulaan Bataar';
                break;
            case 'Asia/Urumqi':
                $text = '(UTC+08:00) Urumqi';
                break;
            case 'Asia/Irkutsk':
                $text = '(UTC+09:00) Irkutsk';
                break;
            case 'Asia/Seoul':
                $text = '(UTC+09:00) Seoul';
                break;
            case 'Asia/Tokyo':
                $text = '(UTC+09:00) Tokyo';
                break;
            case 'Australia/Adelaide':
                $text = '(UTC+09:30) Adelaide';
                break;
            case 'Australia/Darwin':
                $text = '(UTC+09:30) Darwin';
                break;
            case 'Australia/Brisbane':
                $text = '(UTC+10:00) Brisbane';
                break;
            case 'Australia/Canberra':
                $text = '(UTC+10:00) Canberra';
                break;
            case 'Pacific/Guam':
                $text = '(UTC+10:00) Guam';
                break;
            case 'Australia/Hobart':
                $text = '(UTC+10:00) Hobart';
                break;
            case 'Australia/Melbourne':
                $text = '(UTC+10:00) Melbourne';
                break;
            case 'Pacific/Port_Moresby':
                $text = '(UTC+10:00) Port Moresby';
                break;
            case 'Australia/Sydney':
                $text = '(UTC+10:00) Sydney';
                break;
            case 'Asia/Yakutsk':
                $text = '(UTC+10:00) Yakutsk';
                break;
            case 'Asia/Vladivostok':
                $text = '(UTC+11:00) Vladivostok';
                break;
            case 'Pacific/Auckland':
                $text = '(UTC+12:00) Auckland';
                break;
            case 'Pacific/Fiji':
                $text = '(UTC+12:00) Fiji';
                break;
            case 'Pacific/Kwajalein':
                $text = '(UTC+12:00) International Date Line West';
                break;
            case 'Asia/Kamchatka':
                $text = '(UTC+12:00) Kamchatka';
                break;
            case 'Asia/Magadan':
                $text = '(UTC+12:00) Magadan';
                break;
            case 'Pacific/Tongatapu':
                $text = "(UTC+13:00) Nuku'alofa";
                break;

            default:
                $text = 'Label not found';
        }
        return $text;
    }

    public static function makeDirectory($path) {
        if(\File::makeDirectory($path, 0775, true, true)) {
            return true;
        }
        logger("Could not create directory $path.");
        return false;
    }

    public static function uploadAvatar($path, $type, $steamid) {
        if(!\File::isDirectory('\upload\avatars')) {
            if(!self::makeDirectory('\upload\avatars')) return false;
        }
        if(\File::exists('\upload\avatars\\' . $steamid . '.' . $type)) \Storage::disk('public')->delete('\upload\avatars\\' . $steamid . '.' . $type);
        if(\Image::make($path)->resize('48', '48')->save(public_path('upload\avatars\\' . $steamid . '.' . $type))) return public_path('upload\avatars\\' . $steamid . '.' . $type);
        logger('Failed to upload avatar', [
            'path' => $path,
            'type' => $type,
            'steamid' => $steamid
        ]);
        return false;
    }

    public static function isPingable($url, $port = 80, $timeout = 5): bool {
        if($url === 'io') {
            $url = config('io.url');
            $port = config('io.port');
        }
        $url = parse_url($url);
        if(!$url)
            return false;
        $url = $url['host'];
        try {
            fsockopen($url, $port, $errno, $errstr, $timeout);
            return true;
        } catch(\Exception $err) {
            if($url === 'io') logger($err);
            return false;
        }
    }

    public static function getHexColorForItemRarity($rarity) {
        if(stripos($rarity, 'Base Grade') !== false) return "000";
        if(stripos($rarity, 'Consumer Grade') !== false) return "c0c0c0";
        if(stripos($rarity, 'Industrial Grade') !== false) return "99ccff";
        if(stripos($rarity, 'Mil-spec') !== false) return "0000ff";
        if(stripos($rarity, 'Restricted') !== false) return "800080";
        if(stripos($rarity, 'Classified') !== false) return "ff00ff";
        if(stripos($rarity, 'Covert') !== false) return "ff0000";
        if(stripos($rarity, 'Exceedingly Rare') !== false) return "ffcc00";
        if(stripos($rarity, 'Contraband') !== false) return "ffcc99";
        return 'ef6c00';
    }
}
