<?php

if(empty($_SESSION['panier'])){
    $message = "Votre panier est vide";
}
else{
    $articles=$_SESSION['panier'];
}

$date = new DateTimeImmutable();
$dateLivraison = dateFr($date->format('D d M Y'));
$dateLivraison1 = addDayDate(1);
$dateLivraison2 = addDayDate(2);

$articleModel = new ArticleModel();
if(!empty($_POST)) {
    $idArticle = intval($_POST['id_article']);
    $article = $articleModel ->getOneArticle($idArticle);
    $label = strip_tags(trim($_POST['label_article' . $article['id_article']]));
    $quantite = strip_tags(trim($_POST['quantite' . $article['id_article']]));
    modifierQTeArticle($idArticle,$quantite);
}
dump($_SESSION['panier']);

$title = "Votre panier";
$template = "panier";
include '../templates/base.phtml';