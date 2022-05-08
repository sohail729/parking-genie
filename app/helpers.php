<?php

use Illuminate\Http\Request;
use Stevebauman\Location\Facades\Location;

if (!function_exists('getNameInitials')) {
    function getNameInitials($user)
    {
        $initials = '';
        if($user->fname){
            $initials .= $user->fname[0];

        }
        if($user->lname){
            $initials .= $user->lname[0];
        }
        return strtoupper($initials);
    }
}

if (!function_exists('getFirstName')) {
    function getFirstName($name)
    {
        $name = explode(" ", $name);
        return $name[0];
    }
}

if (!function_exists('getFormattedDate')) {
    function getFormattedDate($datetime, $format = 'd-m-Y')
    {
        return Carbon\Carbon::parse($datetime)->format($format);
    }
}

if (!function_exists('htmlToText')) {
    function htmlToText($content, $length)
    {
        $str = substr(strip_tags($content), 0, $length);
        return !empty($str) ? (strlen($str) >= $length ? $str . '...' : $str) : null;
    }
}

if (!function_exists('getPageType')) {
    function getPageType()
    {
        $routeName = request()->route()->getName();
        if (strpos($routeName, 'edit') !== false) {
            return 'PUT';
        }
        return 'GET';
    }
}

if (!function_exists('getMonths')) {
    function getMonths()
    {
        return ['1' => 'January', '2' => 'February', '3' => 'March', '4' => 'April', '5' => 'May', '6' => 'June', '7' => 'July', '8' => 'August', '9' => 'September', '10' => 'October', '11' => 'November', '12' => 'December'];
    }
}

if (!function_exists('getMonth')) {
    function getMonth($monthNum)
    {
        $dateObj   = DateTime::createFromFormat('!m', $monthNum);
        $monthName = $dateObj->format('F');
        return $monthName;
    }
}

if (!function_exists('getTime')) {
    function getTime($time)
    {
        return date('h:i a', strtotime($time));
    }
}

if (!function_exists('get_calender_month')) {
    function get_calender_month($monthNum)
    {
        if($monthNum){
            $dateObj   = DateTime::createFromFormat('m', $monthNum);
            $formattedDate = $dateObj->format('Y-m');
        }
        return $formattedDate ?? null;
    }
}

if (!function_exists('toFloat')) {
    function toFloat($num)
    {
        return number_format((float)$num, 2, '.', '');
    }
}

if (!function_exists('format_stripe_amount')) {
    function format_stripe_amount($amount)
    {
        return (float)$amount / 100;
    }
}

if (!function_exists('getHours')) {
    function getHours($lower = 0, $upper = 86400, $step = 3600, $format = '')
    {
        $times = array();
        if (empty($format)) {
            $format = 'g:i a';
        }
        foreach (range($lower, $upper, $step) as $increment) {
            $increment = gmdate('H:i', $increment);
            list($hour, $minutes) = explode(':', $increment);
            $date = new DateTime($hour . ':' . $minutes);
            $times[(string) $increment] = $date->format($format);
        }
        return $times;
    }
}

if (!function_exists('getDistance')) {
    function getDistance($latTo, $lngTo, $earthRadius = 3958.755866) // in miles
    {
        if (config('app.env') == 'local') {
            $ip = '162.159.24.227'; /* Static IP address */            
        }else{
            $ip = request()->ip();    //  Dynamic IP address 
        }

        $userinfo = Location::get($ip);
        $latFrom = $_COOKIE['lat_local'] ?? $userinfo->latitude;
        $lngFrom = $_COOKIE['lng_local'] ?? $userinfo->longitude;

        // convert from degrees to radians
        $latFrom = deg2rad($latFrom);
        $lonFrom = deg2rad($lngFrom);
        
        $latTo = deg2rad($latTo);
        $lngTo = deg2rad($lngTo);

        $lonDelta = $lngTo - $lonFrom;

        $a = pow(cos($latTo) * sin($lonDelta), 2) + pow(cos($latFrom) * sin($latTo) - sin($latFrom) * cos($latTo) * cos($lonDelta), 2);
        $b = sin($latFrom) * sin($latTo) + cos($latFrom) * cos($latTo) * cos($lonDelta);

        $angle = atan2(sqrt($a), $b);
        return number_format((float)($angle * $earthRadius), 2, '.', '');
    }
}
