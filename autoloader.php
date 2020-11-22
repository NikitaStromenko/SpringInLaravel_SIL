<?php

require_once __DIR__ . '/mapmaker.php';


$routes = json_decode(file_get_contents('directory_map.json'), true);

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
    createMap( $_SERVER['DOCUMENT_ROOT']);

    findAndLoadClass($class);
}

spl_autoload_register('findAndLoadClass');
spl_autoload_register('rewritePackageRouteAndReFind');
