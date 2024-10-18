<?php

if (!function_exists(function: 'env')) {
    function env($key, $default = null)
    {
        $value = getenv(name: $key);

        if ($value === false || null) {
            return $default;
        }

        return $value;
    }
} else {
    echo "function env is not exists";
}