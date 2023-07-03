<?php

if (!function_exists('_t')) {
    global $words;
    $lang = defined('cfg_locale') ? cfg_locale : 'pl';
    $path = defined('cfg_locale_path') ? cfg_locale_path : dirname(__DIR__);
    $words = file_exists($path.'/i18n/'.$lang.'.php') ? require $path.'/i18n/'.$lang.'.php' : [];

    function _t(string $str, array $values = [], int $type = 0) {
        global $words;
        $translate = match ($type) {
            1=>$words[strtolower($str)]??$str,
            2=>$words[ucfirst(strtolower($str))]??ucfirst(strtolower($str)),
            default=>$words[$str]??$str
        };
        if (!empty($values)) {
            $translate = str_replace(array_keys($values), array_values($values), $translate);
        }
        return $translate;
    }
}
