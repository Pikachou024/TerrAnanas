<?php

$idCommande = intval($_GET['id']);

$statusModel = new StatusModel();
$status = $statusModel->getAllStatus();

$commandeModel = new CommandeModel();
$articlesCommande = $commandeModel -> getOneCommandeDetails($idCommande);

$dateCommande = dateFr(date('D d M Y', strtotime($articlesCommande[0]['date_commande'])));
$dateLivraison = dateFr(date('D d M Y', strtotime($articlesCommande[0]['date_livraison'])));

$montantCommande = $articlesCommande[0]['montant'];

$client = $commandeModel->getClientByIdCommande($idCommande);

$title = "Commande N° ".$idCommande ;
$template = "commande_details";
include "../templates/base_admin.phtml";
