<?php

$commandeModel = new CommandeModel();

if(empty($_SESSION['panier'])){
    header('location: article_client');
    exit;
}

$idUser = getUserId();
$montant = montantPanier();
$dateLivraison = "2022-08-31";
$idStatus = 1;

$commandeModel -> addCommande($idUser,$montant,$dateLivraison,$idStatus);
$idCommande = $commandeModel->lastCommandeId($idUser);

for($i=0 ; $i < count($_SESSION['panier'])  ; $i++ ){
    $commandeModel->addDetailsCommande($idCommande["max(id_commande)"],$_SESSION['panier'][$i]['id_article'],$_SESSION['panier'][$i]['prix'],$_SESSION['panier'][$i]['quantite']);
}

//header('location: article_client');
//exit;