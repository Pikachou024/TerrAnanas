<?php

session_start();
include "../vendor/autoload.php";
include "../app/config.php";
include "../app/Router.php";

include '../lib/functions.php';
include '../lib/environnement.php';
include '../lib/sendMail.php';
include '../lib/messageFlash.php';
include '../lib/upload.php';

spl_autoload_register("autoloader");

$routes = include '../app/routes.php';
$router = new Router($routes);

$page = getURL($_SERVER["REDIRECT_URL"]);
if (!$page) {
    $page = 'home';
}
if (!array_key_exists($page, $routes)) {
    http_response_code(404);
    header("location:page_404");
    exit;
}

$controllerName = $router->getControllerName($page);
$actionName = $router->getActionName($page);
$path = $router->getPath($page);
$baseTemplate = $router->getBaseTemplate($page);

autoloadController($controllerName, $path);
$controller = new $controllerName($path, $page, $baseTemplate);
$controller->$actionName();


//dump($_SESSION['panier']);
