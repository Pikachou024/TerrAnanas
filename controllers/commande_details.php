<?php

$idCommande = intval($_GET['id']);

$commandeModel = new CommandeModel();
$articlesCommande = $commandeModel -> getOneCommandeDetails($idCommande);

$dateCommande = dateFr(date('D d M Y', strtotime($articlesCommande[0]['date_commande'])));
$dateLivraison = dateFr(date('D d M Y', strtotime($articlesCommande[0]['date_livraison'])));

$montantCommande = $articlesCommande[0]['montant'];
$client = $commandeModel->getClientByIdCommande($idCommande);

if(!empty($_POST)){
//    $montant = $_POST['montant'];
//    $prix = $_POST['prix'];
//    $quantite = $_POST['quantite'];
    $remise = intval($_POST['remise']);
    $montantRemise = round(remiseCommande($montantCommande,$remise),2);
    $commandeModel->addDiscount($remise,$montantRemise,$idCommande);

}

$title = "Commande N° ".$idCommande ;
$template = "commande_details";
include "../templates/base_admin.phtml";
