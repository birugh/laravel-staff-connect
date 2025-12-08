<?php

if (!function_exists('sort_link')) {
    function sort_link($column, $label)
    {
        $currentSort = request('sort');
        $currentDir  = request('dir');

        if ($currentSort !== $column) {
            $nextSort = $column;
            $nextDir  = 'asc';
        } elseif ($currentDir === 'asc') {
            $nextSort = $column;
            $nextDir  = 'desc';
        } else {
            $nextSort = null;
            $nextDir  = null;
        }

        $params = array_filter([
            'search' => request('search'),
            'filter' => request('filter'),
            'sort' => $nextSort,
            'dir' => $nextDir,
        ]);

        $url = request()->url() . '?' . http_build_query($params);

        $icon = '';
        if ($currentSort === $column) {
            if ($currentDir === 'asc')  $icon = '↑';
            if ($currentDir === 'desc') $icon = '↓';
        }

        return "<a href=\"$url\">$label $icon</a>";
    }
}
