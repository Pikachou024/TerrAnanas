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


//session_destroy();
$routes = include '../app/routes.php';

$page = getURL($_SERVER["REDIRECT_URL"]);
if(!$page){
    $page='login';
}
if(!array_key_exists($page,$routes)){
    http_response_code(404);
    echo("Page introuvable");
    exit;
}
//unset($_SESSION['panier']);
$controllerFile=$routes[$page];
include '../controllers/'.$controllerFile;