<?php

$commandeModel = new CommandeModel();
$francoModel = new FrancoModel();

$idUser = getUserId();
$montant = montantPanier();

if(empty($_SESSION['panier'])){
    header('location: panier');
    exit;
}

/**
 * On redirige sur la page "panier" si le montant du panier n'atteint pas le franco
 */
//if($montant<$francoModel->getFranco(1)){
//    header('location:panier');
//    exit;
//}


if(!empty($_POST)){
    $dateLivraison = strip_tags(trim($_POST['dateLivraison']));
    $idStatus = 1;
    $commandeModel -> addCommande($idUser,$montant,$dateLivraison,$idStatus);
    $idCommande = $commandeModel->lastCommandeId($idUser);

    for($i=0 ; $i < count($_SESSION['panier'])  ; $i++ ){
        $commandeModel->addDetailsCommande($idCommande["max(id_commande)"],$_SESSION['panier'][$i]['id_article'],$_SESSION['panier'][$i]['prix'],$_SESSION['panier'][$i]['quantite']);
    }

//    TODO s'il n'y a pas d'érreur, on vide le panier'
    unset($_SESSION['panier']);

}

header('location: article_client');
exit;