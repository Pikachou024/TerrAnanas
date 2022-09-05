<?php

$idCommande = $_GET['id'];

$commandeModel = new CommandeModel();
$articlesCommande = $commandeModel -> getOneCommandeDetails($idCommande);
$dateCommande = $articlesCommande[0]['date_commande'];
$dateLivraison = $articlesCommande[0]['date_livraison'];
//dump($dateCommande);
dump($articlesCommande);
$client = $commandeModel->getClientByIdCommande($idCommande);

if($_POST){
    $montant = $_POST['montant'];
    $prix = $_POST['prix'];
    $quantite = $_POST['quantite'];
}

$title = "Commande N° ".$idCommande ;
$template = "commande_details";
include "../templates/base_admin.phtml";
