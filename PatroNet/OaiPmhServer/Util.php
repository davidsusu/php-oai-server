<?php

namespace PatroNet\OaiPmhServer;

use PatroNet\Core\Request\Controller;
use PatroNet\Core\Request\Request;

class Util {
    
    public static function toUtc($date) {
        $time = is_numeric($date) ? $date : strtotime($date);
        $previousTimezone = date_default_timezone_get();
        date_default_timezone_set("UTC");
        $result = date("c", $time);
        $result = preg_replace('/\\+00:00$/', 'Z', $result);
        date_default_timezone_set($previousTimezone);
        return $result;
    }
    
}
