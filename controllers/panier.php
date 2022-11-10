<?php

if(empty($_SESSION['panier'])){
    $message = "Votre panier ne contient actuellement aucun article.";
}
else{
    $articles=$_SESSION['panier'];
}

$date = new DateTimeImmutable();
$dateLivraison = dateFr($date->format('D d M Y'));
$dateLivraison1 = addDayDate(1);
$dateLivraison2 = addDayDate(2);

$articleModel = new ArticleModel();
if(!empty($_POST)){
    dump('ok');
    $idArticle = $_POST['id_article'];
    $label = $_POST['label_article'];
    $quantite = $_POST['quantite' ];

    for($i=0 ; $i<(count($articles)-1) ; $i++) {
        modifierQTeArticle($idArticle[$i], $quantite[$i]);
    }
}

//dump($articles);
$title = "Votre panier";
$template = "panier";
include '../templates/base_user.phtml';