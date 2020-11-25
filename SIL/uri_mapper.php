<?php

$routes = json_decode(file_get_contents('SIL/json/directory_map.json'), true);

function create_uri_map() {
    global $routes;

    foreach ($routes as $route) {

        if ($dh = opendir($route)) {
            while (($file = readdir($dh)) !== false) {
                if (strpos($file, ".php")) {

                    $file = str_replace('.php', '', $file);
                    $class = new ReflectionClass($file);

                    if (!$class->isInterface() && $class->getParentClass()->getName() === 'MarkController') {
                        echo $file;
                    }
                }
            }
            closedir($dh);
        }
    }

}
