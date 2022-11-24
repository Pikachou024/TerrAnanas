<?php

$idUser = getUserId();

$statusModel = new StatusModel();
$status = $statusModel->getAllStatus();
$statusCommande = (!empty($_POST['status'])) ? strip_tags(trim($_POST['status'])) : 1;
$commandeModel = new CommandeModel();
$commandes = $commandeModel -> getCommandeByClient($idUser,$statusCommande);

if(!empty($_POST['searchDate'])){
    $date = strip_tags(trim($_POST['searchDate']));
    $dateTime = DateTime::createFromFormat('d/m/Y', $date);
    $newFormatDate = $dateTime->format('Y-m-d');
    $_SESSION['commandeByDate']=  $commandeModel->getCommandeByDate($newFormatDate,$statusCommande);
}
else{
    unset($_SESSION['commandeByDate']);
}

$title = "Mes comnmandes";
$template="commande_client";
include "../templates/base_user.phtml";