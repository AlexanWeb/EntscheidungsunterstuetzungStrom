<?php

if (!function_exists('on_page')) {
    function on_page($path) {
        return request()->is($path);
    }
}

if (!function_exists('return_if')) {
    function return_if($condition, $value) {
        if ($condition) {
            return $value;
        }
    }
}

if (!function_exists('bg_color_prices')) {
    function bg_color_prices($pricesDifference, $basePrice) {
            $color = 'rgba(0,0,0,.8)';
        if ($pricesDifference < 0) {
            $percentage = abs(abs($pricesDifference) / ($basePrice == 0 ? 0.01 : $basePrice));
            $color = 'rgba(255,0,0,'.$percentage.')';
        } else {
            $percentage = abs($pricesDifference / ($basePrice == 0 ? 0.01 : $basePrice));
            $color = 'rgba(0, 255,0 ,'.$percentage.')';
        }
        return $color;
    }
}
