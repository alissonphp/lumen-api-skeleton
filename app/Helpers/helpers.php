<?php
if ( ! function_exists('config_path'))
{
    /**
     * Get the configuration path.
     *
     * @param  string $path
     * @return string
     */
    function config_path($path = '')
    {
        return app()->basePath() . '/config' . ($path ? '/' . $path : $path);
    }
}

if ( ! function_exists('bcrypt'))
{
    /**
     * Generate a hash of the secret string
     *
     * @param string $secret
     * @return mixed
     */
    function bcrypt($secret = '')
    {
        return app('hash')->make($secret);
    }
}