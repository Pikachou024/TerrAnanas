<?php

//unset($_SESSION['panier']);
$articleModel = new ArticleModel();
$articles = $articleModel->getAllArticles();

if(!empty($_GET['articleSearch'])){
    $articleSearch = $_GET['articleSearch'];
    $_SESSION['articleSearch'] = searchArticle($articleSearch,$articles);
}
else {
    unset($_SESSION['articleSearch']);
}

if(!empty($_POST)){

    $idArticle =$_POST['id_article'];
    $famille =$_POST['label_famille'];
    $unite =$_POST['label_unite'];
    $label =$_POST['label_article'];
    $origine =$_POST['origine'];
    $poids =$_POST['poids'];
    $prix = $_POST["prix"];
    $quantite = $_POST['quantite'];

    for($i=0 ; $i<(count($articles)-1) ; $i++){
        addArticle($idArticle[$i],$label[$i],$origine[$i],$poids[$i],$prix[$i],$quantite[$i],$famille[$i],$unite[$i]);
    }
}


//session_destroy();
if(isset($_SESSION['panier'])){
    dump($_SESSION['panier']);
}

$title = " Nos articles";
$template = "article_client";
include '../templates/base_user.phtml';
