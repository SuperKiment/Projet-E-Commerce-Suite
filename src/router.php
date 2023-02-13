<?php

function initRouter($routes, $db)
{
    //Si la variable page existe donc dans l'url on a mis ?page=truc alors $page devient ?page
    if (isset($_GET['page'])) {
        $page = $_GET['page'];
    } else $page = "home";

    //Si page est dans le tableau des routes alors $route devient la route (homeController)
    if (isset($routes[$page])) {
        $route = $routes[$page];
    } else {
        $route = $routes["home"];
    }

    if ($db == null) {
        $route = $routes["dbError"];
    }

    $routeParameters = explode(':', $route);
    $controller = ucfirst($routeParameters[0]);
    $access = $routeParameters[1] ?? 0;
    if ($access != 0) {
        if (!isset($_SESSION['auth']) || $_SESSION['auth']['role'] < $access) {
            $controller = "HomeController";
        }
    }
    
    require_once 'controller/' . $controller . '.php';
    return $controller;
}
