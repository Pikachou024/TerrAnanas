<?php

if(!isset($_SESSION['panier']) || empty($_SESSION['panier'])){
    $message = "Votre panier est vide";
}
else{
    $articles=$_SESSION['panier'];
}

$articleModel = new ArticleModel();

if(!empty($_POST)) {

        $idArticle = $_POST['id_article'];
        $article = $articleModel ->getOneArticle($idArticle);

        $label = strip_tags(trim($_POST['label_article' . $article['id_article']]));
        $quantite = strip_tags(trim($_POST['quantite' . $article['id_article']]));

        modifierQTeArticle($idArticle,$quantite);

}
//dump($_SESSION['panier']);

include ('../templates/panier.phtml');