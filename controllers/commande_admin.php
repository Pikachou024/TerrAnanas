<?php

$commandeModel = new CommandeModel();
$commandes = $commandeModel -> getAllCommandes();

if(!empty($_POST['searchDate'])){
    $date = $_POST['searchDate'];
    $dateTime = DateTime::createFromFormat('d/m/Y', $date);
    $newFormatDate = $dateTime->format('Y-m-d');
    $_SESSION['commandeByDate']=  $commandeModel->getCommandeByDate($newFormatDate);
}
else{
    unset($_SESSION['commandeByDate']);
}
$title = "Listes des commandes";
$template="commande_admin";
include "../templates/base_admin.phtml";