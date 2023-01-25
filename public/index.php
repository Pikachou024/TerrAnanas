<?php

session_start();
include "../vendor/autoload.php";
include "../app/config.php";
include "../app/Router.php";

include '../lib/functions.php';
include '../lib/environnement.php';
include '../lib/sendMail.php';
include '../lib/messageFlash.php';
//include "../src/Core/AbstractController.php";
//include "../src/Core/AbstractModel.php";
//include "../src/Core/Database.php";
//
//include "../src/Model/ArticleModel.php";
//include "../src/Model/UserModel.php";
//include "../src/Model/FamilleModel.php";
//include "../src/Model/UniteModel.php";
//include "../src/Model/StatusModel.php";
//include "../src/Model/FrancoModel.php";
//include "../src/Model/CommandeModel.php";
//include "../src/Model/MessageModel.php";

spl_autoload_register("autoloader");

//$routes = include '../app/routes.php';
//
//$page = getURL($_SERVER["REDIRECT_URL"]);
//if(!$page){
//    $page='home';
//}
//if(!array_key_exists($page,$routes)){
//    http_response_code(404);
//    echo("Page introuvable");
//    exit;
//}
//$controllerFile = $routes[$page]["controller"];
//$action = $routes[$page]["action"];
//$path = $routes[$page]["path"];
//
//autoloadController($controllerFile,$path);
//$classe = new $controllerFile($path,$page,$routes[$page]['base_template']);
//$classe->$action();



$routes = include '../app/routes.php';
$router = new Router($routes);

$page = getURL($_SERVER["REDIRECT_URL"]);
if (!$page) {
    $page = 'home';
}
if (!array_key_exists($page, $routes)) {
    http_response_code(404);
    echo("404 NOT FOUND");
    exit;
}

$controllerName = $router->getControllerName($page);
$actionName = $router->getActionName($page);
$path = $router->getPath($page);
$baseTemplate = $router->getBaseTemplate($page);

autoloadController($controllerName, $path);
$controller = new $controllerName($path, $page, $baseTemplate);
$controller->$actionName();

