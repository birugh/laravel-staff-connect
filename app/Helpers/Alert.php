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
