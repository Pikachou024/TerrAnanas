<?php

$idCommande = intval($_GET['id']);

$commandeModel = new CommandeModel();
$commandeModel->addDiscount(null,null,$idCommande);

header("location: commande_details?id=$idCommande");
exit;