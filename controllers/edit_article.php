<?php

$idArticle = $_GET['id'];
$errors=[];

$articleModel = new ArticleModel();
$article = $articleModel ->getOneArticle($idArticle);

$label = $article['label'];
$origine = $article['origine'];
$prix = $article['prix'];
$quantite = $article['quantite'];
$famille = $article['famille'];

if(!empty($_POST)){
    $label = $_POST['label'];
    $origine = $_POST['origine'];
    $prix = $_POST['prix'];
    $quantite = $_POST['quantite'];
    $famille = $_POST['famille'];

    if(empty($errors)){

        $articleModel->editArticle($label,$quantite,$prix,$origine,$famille,$idArticle);

        header('location: articles');
        exit;
    }

}

include'../templates/edit_article.phtml';