<?php

$routes = json_decode(file_get_contents('SIL/json/directory_map.json'), true);
$endpoint_map_path = 'SIL/json/endpoint_map.json';

function create_endpoint_map() {
    global $routes, $endpoint_map_path;

    $endpoint_map = array();
    foreach ($routes as $route) {

        if ($dh = opendir($route)) {
            while (($file = readdir($dh)) !== false) {
                if (strpos($file, ".php")) {
                    $file = str_replace('.php', '', $file);
                    $class = new ReflectionClass($file);

                    if (!$class->isInterface() &&
                        !empty($class->getParentClass()) &&
                        $class->getParentClass()->getName() === 'MarkController') {

                        $endpoint_map = array_merge($endpoint_map, getAnnotations($class));
                    }
                }
            }
            closedir($dh);
        }
    }

    if (!empty($endpoint_map)) {
        $fp = fopen($endpoint_map_path, 'w+');
        fwrite($fp, json_encode($endpoint_map));
        fclose($fp);
    }
}

function getAnnotations($class) {
    $allMethods = $class->getMethods();

    $endpoint_map = array();
    foreach ($allMethods as $method) {
        $methodArray = (array) $method;

        if ($methodArray['class'] === $class->getName()) {
            $classMethod = new ReflectionMethod($class->getName(), $methodArray['name']);
            $doc = $classMethod->getDocComment();
            preg_match_all('#@.*?\n#s', $doc, $annotations);

            foreach ($annotations[0] as $annotation) {

            preg_match('#(?<=["\'])([^"\']+)#', $annotation, $root);

                if(!empty($root)) {
                    preg_match('#[A-Za-z]+#', $annotation, $requestMethod);
                    $endpoint_map[] = array("controller" => $class->getName(), "endpoint" => $classMethod->getName(), "url" => $root[0], "request_method" => RequestAnnotations::getRequestMethod($requestMethod[0]));
                }
            }
        }
    }
    return $endpoint_map;
}
