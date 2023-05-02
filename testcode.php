<?php
function formatBytes($size, $precision = 2)
{
    $base = log($size, 1000);
    $suffixes = array('bytes', 'KB', 'MB', 'GB', 'TB');   

    return round(pow(1000, $base - floor($base)), $precision) .' '. $suffixes[floor($base)];
}

echo formatBytes(1.41e+9);
// 23.81M

echo formatBytes(24962496, 2);
// 24M

echo formatBytes(24962496, 4);
// 23.8061M
?>