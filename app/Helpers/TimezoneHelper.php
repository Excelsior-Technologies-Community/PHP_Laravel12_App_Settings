<?php

namespace App\Helpers;

class TimezoneHelper
{
    public static function getTimezoneList()
    {
        return [
            'UTC' => 'UTC',
            'America/New_York' => 'America/New_York (EST/EDT)',
            'America/Chicago' => 'America/Chicago (CST/CDT)',
            'America/Denver' => 'America/Denver (MST/MDT)',
            'America/Los_Angeles' => 'America/Los_Angeles (PST/PDT)',
            'Europe/London' => 'Europe/London',
            'Europe/Paris' => 'Europe/Paris',
            'Asia/Kolkata' => 'Asia/Kolkata (IST)',
            'Asia/Tokyo' => 'Asia/Tokyo (JST)',
            'Australia/Sydney' => 'Australia/Sydney (AEDT/AEST)',
            'Africa/Johannesburg' => 'Africa/Johannesburg (SAST)',
            'America/Sao_Paulo' => 'America/Sao_Paulo (BRT)',
        ];
    }
}