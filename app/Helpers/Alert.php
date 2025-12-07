<?php

if (!function_exists('swal')) {
    function swal($type, $message, $title = null)
    {
        session()->flash('swal', [
            'type' => $type,
            'message' => $message,
            'title' => $title ?? ucfirst($type),
        ]);
    }
}

if (!function_exists('swal_confirm')) {
    function swal_confirm($title, $message, $confirmRoute, $method = 'GET')
    {
        session()->flash('swal_confirm', [
            'title' => $title,
            'message' => $message,
            'confirmRoute' => $confirmRoute,
            'method' => strtoupper($method),
        ]);
    }
}


if (!function_exists('swal_toast')) {
    function swal_toast($type, $message)
    {
        session()->flash('swal_toast', [
            'type' => $type,
            'message' => $message,
        ]);
    }
}
