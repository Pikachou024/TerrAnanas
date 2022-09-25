<?php

$idCommande = intval($_GET['id']);

$commandeModel = new CommandeModel();
$articlesCommande = $commandeModel -> getOneCommandeDetails($idCommande);
$montantCommande = $articlesCommande[0]['montant'];

if(!empty($_POST)) {

    $remise = intval($_POST['remise']);
    $montantRemise = round(remiseCommande($montantCommande,$remise),2);
    $commandeModel->addDiscount($remise,$montantRemise,$idCommande);

}

header('location: commande_details?id='.$idCommande);