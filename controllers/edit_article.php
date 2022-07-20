<?php

$roleUser=getUserRole();

if($roleUser != "admin") {
    http_response_code(403);
    echo("Désolé la page n'existe pas");
    exit;
}

$idArticle = $_GET['id'];
$errors=[];

$articleModel = new ArticleModel();
$article = $articleModel ->getOneArticle($idArticle);

$familleModel = new FamilleModel();
$familles = $familleModel ->getAllFamille();

$uniteModel = new UniteModel();
$unites = $uniteModel ->getAllUnite();

$label = $article['label_article'];
$origine = $article['origine'];
$prix = $article['prix'];
$poids = $article['poids'];
//$unite = $article['id_unite'];
//$famille = $article['id_famille'];

if(!empty($_POST)){
    $label = $_POST['label'];
    $origine = $_POST['origine'];
    $prix = $_POST['prix'];
    $poids = $_POST['poids'];
    $unite = $_POST['unite'];
    $famille = $_POST['famille'];

    if(empty($errors)){

        $articleModel->editArticle($label,$poids,$unite,$prix,$origine,$famille,$idArticle);

        header('location: articles');
        exit;
    }

}

$title ='Modfier un article';
$template='edit_article';
include'../templates/base_admin.phtml';