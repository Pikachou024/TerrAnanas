<?php

$idCommande = intval($_GET['id']);
$commandeModel = new CommandeModel();

if(!empty($_POST)) {
    $idArticle =$_POST['id_article'];
    $prix = $_POST["prix"];
    $quantite = $_POST['quantite'];
    for($i=0 ; $i<(count($idArticle)-1) ; $i++){
        $commandeModel->editCommandeDetail($idArticle[$i],$prix[$i],$quantite[$i]);
    }
}

header('location: commande_details?id='.$idCommande);