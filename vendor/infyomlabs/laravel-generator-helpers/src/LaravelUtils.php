<?php

namespace InfyOm\GeneratorHelpers;

class LaravelUtils
{
    /**
     * Get full view path relative to the application's configured view path.
     *
     * @param  string  $path
     * @return string
     */
    public static function getViewPath($path = '')
    {
        return implode(DIRECTORY_SEPARATOR, [
            config('view.paths')[0] ?? resource_path('views'), $path,
        ]);
    }
}
