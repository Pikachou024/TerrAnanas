<?php

$roleUser=getUserRole();

//if($roleUser != "admin") {
//    http_response_code(403);
//    echo("Désolé la page n'existe pas");
//    exit;
//}

$idArticle = $_GET['id'];
$errors=[];


$articleModel = new ArticleModel();
$article = $articleModel ->getOneArticle($idArticle);

if(!$article){
    http_response_code(404);
    echo("Article introuvable");
    exit;
}

$familleModel = new FamilleModel();
$familles = $familleModel ->getAllFamille();

$uniteModel = new UniteModel();
$unites = $uniteModel ->getAllUnite();

$statusModel = new StatusModel();
$status = $statusModel ->getAllStatusArticle();

$label = $article['label_article'];
$origine = $article['origine'];
$prix = $article['prix'];
$poids = $article['poids'];



if(!empty($_POST)){
    $label = $_POST['label'];
    $origine = $_POST['origine'];
    $prix = $_POST['prix'];
    $poids = $_POST['poids'];
    $unite = $_POST['unite'];
    $famille = $_POST['famille'];
    $status = $_POST['status'];

    if(empty($errors)){

        $articleModel->editArticle($label,$poids,$unite,$prix,$origine,$famille,$status,$idArticle);

        header('location: articles');
        exit;
    }

}

$title ='Modfier un article';
$template='edit_article';
include '../templates/admin/base_admin.phtml';