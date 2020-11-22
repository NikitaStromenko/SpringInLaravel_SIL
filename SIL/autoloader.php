<?php

require_once __DIR__ . '/mapmaker.php';

$json_route = 'SIL/json/directory_map.json';

if (!file_exists($json_route)) {
    createMap(__DIR__);
}

$routes = json_decode(file_get_contents($json_route), true);

function findAndLoadClass($class) {
    global $routes;

    $disassembled = explode('\\', $class);
    $className = array_pop($disassembled);

    foreach ($routes as $route) {

        $classRoute = $route . '/'. $className . '.php';

        if (file_exists($classRoute)) {
            require_once $classRoute;
        }
    }
}

function rewritePackageRouteAndReFind($class) {
    createMap(__DIR__);

    findAndLoadClass($class);
}

spl_autoload_register('findAndLoadClass');
spl_autoload_register('rewritePackageRouteAndReFind');
