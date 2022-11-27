<?php
$dateDuJour = dateFr(date('D d M Y'));

$idUser = getUserId();


$commandeModel = new CommandeModel();
$commandeEnAttente = $commandeModel->getCommandeByClient(4,1);
if(count($commandeEnAttente)>5){
    $commandeEnAttente = array_chunk($commandeEnAttente,5);
}

$livraisonDuJour =  $commandeModel->getCommandeByLivraison($idUser,2,$dateDuJour);

$title = " - TerrAnanas";
$template='client';
include '../templates/client/base_client.phtml';