<?php

function printFolder($path, $indentLine, $file)
{
    if (!is_dir($path) || is_link($path) || (is_dir($path) && !is_readable($path))) {
        echo $indentLine . $file . PHP_EOL;
    } else {
        echo $indentLine . $file . PHP_EOL;
        scanFolder($path, $indentLine . "\t");
    }
}

function scanFolder($folder, $indentLine)
{
    $files = scandir($folder);
    foreach ($files as $file) {
        if (($file == '.') || ($file == '..')) {
            continue;
        }
        $path = $folder . '/' . $file;
        printFolder($path, $indentLine, $file);
    }
}


if (php_sapi_name() != 'cli') {
    $preOpenTag = '<pre>';
    $preCloseTag = '</pre>';
} else {
    $preOpenTag = '';
    $preCloseTag = '';
}
echo $preOpenTag;
scanFolder(__DIR__, "");
echo $preCloseTag;