<?php

/*
 * Validation de la commande traitée en changeant le status
 * 1) en attente
 * 2) validé
 * 3) refusé
 */
$idCommande = $_GET['id'];

if(!empty($_POST['status'])){
    $statusCommande = strip_tags(trim($_POST['status']));
}
$commandeModel = new CommandeModel();
$commandeModel->validCommande($statusCommande,$idCommande);

header('location:commande_admin');