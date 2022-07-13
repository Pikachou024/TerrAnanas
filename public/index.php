<?php
include "../app/config.php";
include "../src/Core/AbstractModel.php";
include "../src/Core/Database.php";
include "../src/Model/ArticleModel.php";
include "../src/Model/UserModel.php";
include "../src/Model/FamilleModel.php";
include "../src/Model/UniteModel.php";

include '../lib/functions.php';

session_start();

$routes = include '../app/routes.php';
$page = getURL($_SERVER["REDIRECT_URL"]);

if(!$page){
    $page='articles';
}
if(!array_key_exists($page,$routes)){
    http_response_code(404);
    echo("Page introuvable");
    exit;
}

$controllerFile=$routes[$page];
include '../controllers/'.$controllerFile;