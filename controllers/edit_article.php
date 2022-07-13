<?php

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
$quantite = $article['quantite'];
//$unite = $article['id_unite'];
//$famille = $article['id_famille'];

if(!empty($_POST)){
    $label = $_POST['label'];
    $origine = $_POST['origine'];
    $prix = $_POST['prix'];
    $quantite = $_POST['quantite'];
    $unite = $_POST['unite'];
    $famille = $_POST['famille'];

    if(empty($errors)){

        $articleModel->editArticle($label,$quantite,$unite,$prix,$origine,$famille,$idArticle);

        header('location: articles');
        exit;
    }

}

include'../templates/edit_article.phtml';