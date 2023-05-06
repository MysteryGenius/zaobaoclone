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
        // if params are passed, use them as the words per minute
        if (count($params)) $wordsPerMinute = $params[0];
        else $wordsPerMinute = 200;

        $words = strlen(strip_tags($value));
        $time = $words / $wordsPerMinute;

        if ($time < 1) return '少于1分钟'; // if it is less than a minute, return "少于1分钟"
        return round($time) . '分钟'; // else return round($time) . '分钟';
    }
}
