<?php

//a simple router which uses the http method and route to call a callback function
//with the url params
function router($httpMethods, $route, $callback, $exit = true)
{
    static $path = null;

    //parse the request to get correct path
    if ($path === null) {
        $path = parse_url($_SERVER['REQUEST_URI'])['path'];
        $scriptName = dirname(dirname($_SERVER['SCRIPT_NAME']));
        $scriptName = str_replace('\\', '/', $scriptName);
        $len = strlen($scriptName);
        if ($len > 0 && $scriptName !== '/') {
            $path = substr($path, $len);
        }
    }
    //check a valid request is being made
    if (!in_array($_SERVER['REQUEST_METHOD'], (array) $httpMethods)) {
        return;
    }


    $matches = null;
    $regex = '/' . str_replace('/', '\/', $route) . '/';

    //check the path is valid
    if (!preg_match_all($regex, $path, $matches)) {
        return;
    }

    //if there are no url params after the path then call function with no params
    if (empty($matches)) {
        $callback();
    } else {
        //otherwise call function with url params as params of function
        $params = array();
        foreach ($matches as $k => $v) {
            if (!is_numeric($k) && !isset($v[1])) {
                $params[$k] = $v[0];
            }
        }
        $callback($params);
    }
    if ($exit) {
        exit;
    }
}