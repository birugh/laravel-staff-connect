<?php

if (!function_exists('generateBreadcrumbs')) {
    function generateBreadcrumbs()
    {
        $route = request()->route()->getName();
        $parts = explode('.', $route);

        $links = [];
        $path = '';

        foreach ($parts as $p) {
            $path .= ($path ? '.' : '') . $p;

            $hasRoute = \Illuminate\Support\Facades\Route::has($path);

            $links[] = [
                'label' => ucfirst($p),
                'url'   => $hasRoute
                    ? route($path, request()->route()->parameters ?? [])
                    : null,
            ];
        }

        return $links;
    }
}
