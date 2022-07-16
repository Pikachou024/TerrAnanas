<?php


$articleModel=new ArticleModel();
$articles=$articleModel ->getAllArticles();

if(isset($_SESSION['panier'])){
    $_SESSION['panier']=array();
}
//$array=["panier"=>["0"=>"article1","2"=>"article2"]];
//var_dump($array);


if(!empty($_POST)){
//    $idArticle = $_GET['id'];
    $idArticle=$_POST['idArticle'];
    $article=$articleModel->getOneArticle($idArticle);

//$colis = $_POST['colis'];
//$_SESSION['panier'] = $colis ;
        $_SESSION['panier'] =
            array(
                "idArticle"=>$idArticle,
                "label"=>$_POST['label'.$article['id_article']],
                "quantite"=>$_POST['quantite'.$article['id_article']],
                "prix"=> $_POST["prix".$article['id_article']],
                "colis"=>$_POST['colis'.$article['id_article']]
        );

var_dump($_SESSION['panier']);
//    var_dump($_POST['idArticle']);
//    unset($_SESSION['panier']);
}


include '../templates/commande.phtml';

