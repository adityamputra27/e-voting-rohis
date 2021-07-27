<?php

use Illuminate\Support\Facades\Route;

function set_active($uri, $output = 'active')
{
    // cek jika uri itu array
    if (is_array($uri)) {
        // lalu looping uri / routenya
        foreach ($uri as $key => $value) {
            if (Route::currentRouteName() == $value) {
                return $output;
            }
        }
    } else {
        // jika bkan array
        if (Route::currentRouteName() == $uri) {
            return $output;
        }
    }
}