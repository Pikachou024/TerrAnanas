<?php

$roleUser=getUserRole();

//if($roleUser != "admin") {
//    http_response_code(403);
//    echo("Désolé la page n'existe pas");
//    exit;
//}

$francoModel = new FrancoModel();
$franco = $francoModel->getFranco(1);

$articleModel = new ArticleModel();
$articles = $articleModel ->getAllArticles();

if(!empty($_POST['articleSearch'])){
    $articleSearch = $_POST['articleSearch'];
    $_SESSION['articleSearch'] = searchArticle($articleSearch,$articles);

}else{
    unset( $_SESSION['articleSearch']);
}

if(!empty($_POST['franco'])){

    $francoModel->editFranco($_POST['franco'],1);

    header('location: articles');
    exit;
}
$title = "Liste articles";
$template='articles';
include'../templates/base_admin.phtml';