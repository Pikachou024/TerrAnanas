<?php
$dateDuJour = dateFr(date('D d M Y'));
$idUser = intval(getUserId());
$commandeModel = new CommandeModel();
$commandeEnAttente = $commandeModel->getCommandeByClient($idUser,1);
if(count($commandeEnAttente)>5){
    $commandeEnAttente = array_slice($commandeEnAttente,0,5);
}

$livraisonDuJour = $commandeModel->getCommandeByLivraison($idUser,1,date('Y-m-d'));
dump($commandeEnAttente);
$title = " - TerrAnanas";
$template='client';
include '../templates/client/base_client.phtml';