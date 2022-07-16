<?php


$articleModel=new ArticleModel();
$articles=$articleModel ->getAllArticles();

//$array=[[1,2,3],[1,2,3],[1,2,3]];
$array=[0=>3,1=>4,3=>5];
//$array['panier']=[];
////$array['panier'];
//$array2=['id'=>'0'];
//array_push($array['panier'],$array2);

//for($i=0;$i<count($array);$i++){
    array_splice($array,2,0);
    dump($array);
//}
//var_dump($array);

if(!empty($_POST)){
//    $idArticle = $_GET['id'];
    $idArticle=$_POST['idArticle'];
    $article=$articleModel->getOneArticle($idArticle);
    $label =strip_tags(trim($_POST['label'.$article['id_article']]));
    $quantite =strip_tags(trim($_POST['quantite'.$article['id_article']]));
    $prix = strip_tags(trim($_POST["prix".$article['id_article']]));
    $colis = strip_tags(trim($_POST['colis'.$article['id_article']]));

//    function addArticle($idArticle,$label,$quantite,$prix,$colis)

    addArticle($idArticle,$label,$quantite,$prix,$colis);


//    var_dump($_POST['idArticle']);
//    unset($_SESSION['panier']);
}
//session_destroy();
if(isset($_SESSION['panier'])){

    dump($_SESSION['panier']);
}
//checkArticle(4,$_SESSION['panier'],1);

include '../templates/commande.phtml';
