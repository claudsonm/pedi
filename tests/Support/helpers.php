<?php

if (! function_exists('test_path')) {
    function test_path(string $path = '')
    {
        $testDirectory = getcwd().DIRECTORY_SEPARATOR.'tests';

        return $testDirectory.($path ? DIRECTORY_SEPARATOR.ltrim($path, DIRECTORY_SEPARATOR) : $path);
    }
}
