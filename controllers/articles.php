<?php

$roleUser=getUserRole();

if($roleUser != "admin") {
    http_response_code(403);
    echo("Désolé la page n'existe pas");
    exit;
}
$articleModel = new ArticleModel();
$articles = $articleModel ->getAllArticles();

$title = "Liste articles";
$template='articles';
include'../templates/base_admin.phtml';