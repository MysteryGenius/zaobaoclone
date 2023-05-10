<?php

namespace App\Modifiers;

use Statamic\Modifiers\Modifier;

class CustomReadTime extends Modifier
{
    /**
     * Modify a value.
     *
     * @param mixed  $value    The value to be modified
     * @param array  $params   Any parameters used in the modifier
     * @param array  $context  Contextual values
     * @return mixed
     */
    public function index($value, $params, $context)
    {
        // if params are passed, use them as the chars per minute
        $charsPerMinute = 200;
        if (count($params)) $charsPerMinute = $params[0];

        $chars = mb_strlen(trim(strip_tags($value)));
        $mins = $chars / $charsPerMinute;
        $remainderSeconds = round(($mins - floor($mins)) * 60);

        $finalMins = floor($mins) + $this->roundSeconds($remainderSeconds);

        if ($finalMins < 1) return '少于1分钟'; // if it is less than a minute, return "少于1分钟"
        return round($finalMins) . '分钟'; // else return round($time) . '分钟';
    }

    private function roundSeconds($seconds)
    {
        if ($seconds < 30) return 0;
        return 1;
    }
}
