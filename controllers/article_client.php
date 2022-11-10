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

//    $idArticle=intval($_POST['id_article']);
//    $article=$articleModel->getOneArticle($idArticle);
//    $famille =strip_tags(trim($_POST['label_famille']));
//    $unite =strip_tags(trim($_POST['label_unite']));
//    $label =strip_tags(trim($_POST['label_article'.$article['id_article']]));
//    $origine =strip_tags(trim($_POST['origine'.$article['id_article']]));
//    $poids =intval(strip_tags(trim($_POST['poids'.$article['id_article']])));
//    $prix = floatval(strip_tags(trim($_POST["prix".$article['id_article']])));
//    $quantite = intval(strip_tags(trim($_POST['quantite'.$article['id_article']])));
//    addArticle($idArticle,$label,$origine,$poids,$prix,$quantite,$famille,$unite);



    $idArticle =$_POST['id_article'];
    $famille =$_POST['label_famille'];
    $unite =$_POST['label_unite'];
    $label =$_POST['label_article'];
    $origine =$_POST['origine'];
    $poids =$_POST['poids'];
    $prix = $_POST["prix"];
    $quantite = $_POST['quantite'];

//    dump($idArticle,$unite,$label,$origine,$poids,$prix,$quantite);

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
