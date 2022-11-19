<?php

$idCommande = intval($_GET['id']);

$statusModel = new StatusModel();
$status = $statusModel->getAllStatus();

$commandeModel = new CommandeModel();
$commande = $commandeModel->getOneCommande($idCommande);
$articlesCommande = $commandeModel -> getOneCommandeDetails($idCommande);

$dateCommande = dateFr(date('D d M Y', strtotime($commande['date_commande'])));
$dateLivraison = dateFr(date('D d M Y', strtotime($commande['date_livraison'])));

$montantCommande = $articlesCommande[0]['montant'];

$client = $commandeModel->getClientByIdCommande($idCommande);
if(!empty($_POST)) {
    $idArticle =$_POST['id_article'];
    $prix = $_POST["prix"];
    $quantite = $_POST['quantite'];
    $statusCommande = strip_tags(trim($_POST['status']));
    for($i=0 ; $i<(count($idArticle)-1) ; $i++){
        $commandeModel->editCommandeDetail($idArticle[$i],$prix[$i],$quantite[$i]);
    }
    $commandeModel->editMontantCommande(montantTotal($articlesCommande),$idCommande);
    $commandeModel->validCommande($statusCommande,$idCommande);
    header('location:commande_admin');
}



$title = "Commande N° ".$idCommande ;
$template = "commande_details";
include "../templates/base_admin.phtml";
