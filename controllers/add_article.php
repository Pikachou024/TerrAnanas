<?php

$label='';
$origine='';
$prix='';
$poids='';

$familleModel = new FamilleModel();
$familles = $familleModel ->getAllFamille();

$uniteModel = new UniteModel();
$unites = $uniteModel ->getAllUnite();

$statusModel = new StatusModel();
$status = $statusModel ->getAllStatusArticle();

$error=[];

if(!empty($_POST)){
    $label = strip_tags(trim($_POST['label']));
    $origine = strip_tags(trim($_POST['origine']));
    $prix = (double) strip_tags(trim($_POST['prix']));
    $poids = (int) strip_tags(trim($_POST['poids']));
    $famille = (int) strip_tags(trim($_POST['famille']));
    $unite = (int) strip_tags(trim($_POST['unite']));
    $statu = (int) strip_tags(trim($_POST['status']));

    if(!$label){
        $error['label']="Le champ est vide";
    }
    if(!$origine){
        $error['origine']="Le champ est vide";
    }
    if(!$prix){
        $error['prix']="Le champ est vide";
    }
    if(!$poids){
        $error['poids']="Le champ est vide";
    }
    if($famille == 0){
        $error['famille']="Veuillez sélectionner un champ";
    }
    if($unite == 0){
        $error['unite']="Veuillez sélectionner un champ";
    }
    if($statu == 0){
        $error['unite']="Veuillez sélectionner un champ";
    }

    if(empty($error)){
        $articleModel = new ArticleModel();
        $articleModel ->addArticle($label,$poids,$unite,$prix,$origine,$famille,$statu);

        header('location: articles');
        exit;
    }
}

$title="Ajouter un article";
$template = 'add_article';
include "../templates/base_admin.phtml";