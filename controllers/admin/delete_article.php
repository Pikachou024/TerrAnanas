<?php

$roleUser = getUserRole();

//if($roleUser != "admin") {
//    http_response_code(403);
//    echo("Désolé la page n'existe pas");
//    exit;
//}

$idArticle = $_GET['id'];

$articleModel = new ArticleModel();
$articleModel->deleteArticle($idArticle);

header('location: articles_admin');
exit;