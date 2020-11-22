<?php

function findDirectories($dir) {
    $routes = array();
    $ffs = scandir($dir);

    foreach ($ffs as $ff) {
        if ($ff != '.' && $ff != '..') {
            if (is_dir($dir.'/'.$ff)) {
                $routes[] = $dir.'/'.$ff;
                findDirectories($dir.'/'.$ff);
            }
        }
    }

    return $routes;
}

function createMap($dir) {
    $routes = findDirectories($dir);

    $fp = fopen('json/directory_map.json', 'w+');
    fwrite($fp, json_encode($routes));
    fclose($fp);
}