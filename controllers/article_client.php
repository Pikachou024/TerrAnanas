<?php


$articleModel=new ArticleModel();
$articles=$articleModel ->getAllArticles();

if(!empty($_POST)){
//    $idArticle = $_GET['id'];
    $idArticle=$_POST['id_article'];
    $article=$articleModel->getOneArticle($idArticle);
    $famille =strip_tags(trim($_POST['label_famille']));
    $unite =strip_tags(trim($_POST['label_unite']));
    $label =strip_tags(trim($_POST['label_article'.$article['id_article']]));
    $origine =strip_tags(trim($_POST['origine'.$article['id_article']]));
    $poids =strip_tags(trim($_POST['poids'.$article['id_article']]));
    $prix = strip_tags(trim($_POST["prix".$article['id_article']]));
    $quantite = strip_tags(trim($_POST['quantite'.$article['id_article']]));

//    function addArticle($idArticle,$label,$poids,$prix,$quantite)

    addArticle($idArticle,$label,$origine,$poids,$prix,$quantite,$famille,$unite);


//    var_dump($_POST['idArticle']);
//    unset($_SESSION['panier']);
}
//session_destroy();
if(isset($_SESSION['panier'])){

    dump($_SESSION['panier']);
}
//checkArticle(4,$_SESSION['panier'],1);

include '../templates/article_client.phtml';
