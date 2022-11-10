<?php

$statusModel = new StatusModel();
$status = $statusModel->getAllStatus();
//$statusCommande = 1;
//
//if(!empty($_POST['status'])){
//    $statusCommande = strip_tags(trim($_POST['status']));
//}
$statusCommande = (!empty($_POST['status'])) ? strip_tags(trim($_POST['status'])) : 1;
$commandeModel = new CommandeModel();
$commandes = $commandeModel -> getAllCommandes($statusCommande);

if(!empty($_POST['searchDate'])){
    $date = strip_tags(trim($_POST['searchDate']));
    $dateTime = DateTime::createFromFormat('d/m/Y', $date);
    $newFormatDate = $dateTime->format('Y-m-d');
    $_SESSION['commandeByDate']=  $commandeModel->getCommandeByDate($newFormatDate);
}
else{
    unset($_SESSION['commandeByDate']);
}

//if(!isset($_GET['ajax'])){
    $title = "Listes des commandes";
    $template="commande_admin";
    include "../templates/base_admin.phtml";
//}
//else{
//    echo json_encode($statusCommande);
//}
