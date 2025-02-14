<?php
if (!function_exists('css_classes')) {
    function css_classes($classes)
    {
        return Arr::toCssClasses($classes);
    }
}

if (!function_exists('is_json')) {
    function is_json($value)
    {
        if (!is_string($value)) {
            return false;
        }
        try {
            json_decode($value);
            return json_last_error() === JSON_ERROR_NONE;
        } catch (Exception $e) {
            return false;
        }
    }
}