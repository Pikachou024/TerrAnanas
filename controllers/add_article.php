<?php

$label='';
$origine='';
$prix='';
$quantite='';

$familleModel = new FamilleModel();
$familles = $familleModel ->getAllFamille();

$uniteModel = new UniteModel();
$unites = $uniteModel ->getAllUnite();

$error=[];

if(!empty($_POST)){
    $label = strip_tags(trim($_POST['label']));
    $origine = strip_tags(trim($_POST['origine']));
    $prix = (double) strip_tags(trim($_POST['prix']));
    $quantite = (int) strip_tags(trim($_POST['quantite']));
    $famille = (int) strip_tags(trim($_POST['famille']));
    $unite = (int) strip_tags(trim($_POST['unite']));

    var_dump($label);
    var_dump($origine);
    var_dump($prix);
    var_dump($quantite);
    var_dump($unite);
    var_dump($famille);

    if(!$label){
        $error['label']="Le champ est vide";
    }
    if(!$origine){
        $error['origine']="Le champ est vide";
    }
    if(!$prix){
        $error['prix']="Le champ est vide";
    }
    if(!$quantite){
        $error['quantite']="Le champ est vide";
    }
    if($famille == 0){
        $error['famille']="Veuillez sélectionner un champ";
    }
    if($unite == 0){
        $error['unite']="Veuillez sélectionner un champ";
    }

    if(empty($error)){
        $articleModel = new ArticleModel();
        $articleModel ->addArticle($label,$quantite,$unite,$prix,$origine,$famille,1);

        header('location: articles');
        exit;
    }
}

include "../templates/add_article.phtml";