<?php

$idCommande = intval($_GET['id']);
$commandeModel = new CommandeModel();

if(!empty($_POST)) {
    $idArticle = strip_tags(trim($_POST['id_article']));
    $prix = strip_tags(trim($_POST['prix']));
    $quantite = strip_tags(trim($_POST['quantite']));

    $commandeModel->editCommandeDetail($idArticle,$prix,$quantite);
}

header('location: commande_details?id='.$idCommande);