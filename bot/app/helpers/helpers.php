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


if (!function_exists(function: 'dump')) {
    function dump(mixed ...$value): void
    {
        echo '<pre>';
        var_dump(...$value);
        echo '</pre>';
    }
} else {
    echo "function dump is not exists";
}



if (!function_exists(function: 'dd')) {
    function dd(mixed ...$value): never
    {
        echo '<pre>';
        var_dump(...$value);
        echo '</pre>';

        die;
    }
} else {
    echo "function dd is not exists";
}



