<?php
//declare(strict_types=1);
session_start();
require '../vendor/autoload.php';
include "../app/config.php";
//spl_autoload_register(function ($class) {
//    include '../src/Core/'.$class .'.php';
//    include '../src/Model/'.$class .'.php';
//});
include "../src/Core/AbstractModel.php";
include "../src/Core/Database.php";
include "../src/Model/ArticleModel.php";
include "../src/Model/UserModel.php";
include "../src/Model/FamilleModel.php";
include "../src/Model/UniteModel.php";
include "../src/Model/StatusModel.php";
include "../src/Model/FrancoModel.php";
include "../src/Model/CommandeModel.php";

include '../lib/functions.php';


$routes = include '../app/routes.php';
$router=[];

$page = getURL($_SERVER["REDIRECT_URL"]);
if(!$page){
    $page='home';
}
foreach ($routes as $route){
    if(array_key_exists($page,$route)){
        $router = $route;
    }
}

if(empty($router)){
    http_response_code(404);
    echo("Page introuvable");
    exit;
}

//if(!array_key_exists($page,$routes)){
//    http_response_code(404);
//    echo("Page introuvable");
//    exit;
//}
$path = $router['path'];
$controllerFile = $router[$page];
include '../controllers/'.$path.'/'.$controllerFile;