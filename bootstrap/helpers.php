<?php

if (! function_exists('getRelease')) {

    /**
     * @return string|null
     */
    function getRelease()
    {
        $version = \App\Support\GitVersion::getVersion();

        return $version ?: '';
    }
}
