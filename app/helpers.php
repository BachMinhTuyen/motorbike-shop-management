<?php

if (!function_exists('format_currency')) {
    function format_currency($number) {
        return number_format($number, 0, ',', '.');
    }
}
