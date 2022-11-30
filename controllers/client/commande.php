<?php

$commandeModel = new CommandeModel();
$francoModel = new FrancoModel();
$franco = $francoModel->getFranco(1);

$errors=[];
/**
 * On vérifie qu'un utilisateur est bien connecté pour valider le panier
 * sinon on le redirige vers login
 * TODO verifie si l'utilisateur connecté a bien le bon role
 */
$idUser = getUserId();
if(!$idUser){
    header('location: login');
}

/**
 * On vérifie que le panier n'est pas vide
 * sinon on redirige le client vers panier
 */
if(empty($_SESSION['panier'])){
    header('location: panier');
    exit;
}

/**
 * On redirige sur la page "panier" si le montant du panier n'atteint pas le franco
 * TODO afficher un message pour prevenir que le montant n'atteint pas le franco
 */
if(montantTotal($_SESSION['panier']) > $franco){
    header('location:panier');
    exit;
}

/**
 * Validation de la commande
 */
if(!empty($_POST)){
    $dateLivraison = strip_tags(trim($_POST['dateLivraison']));
    $idArticle = $_POST['id_article'];
    $label = $_POST['label_article'];
    $quantite = $_POST['quantite' ];

    for($i=0 ; $i<(count($_SESSION['panier'])) ; $i++) {
        modifierQTeArticle($idArticle[$i], $quantite[$i]);
    }
    $montant = montantTotal($_SESSION['panier']);

    /**
     * Parametre status :
     * 1) En attente
     * 2) Validée
     * 3) Refusée
     */
    $idStatus = 1;

    /**
     * Ajout en BDD dans 2 tables : commande et detailsCommande
     *
     */
    $commandeModel -> addCommande($idUser,$montant,$dateLivraison,$idStatus);
    $idCommande = $commandeModel->lastCommandeId($idUser);
    for($i=0 ; $i < count($_SESSION['panier'])  ; $i++ ){
        $commandeModel->addDetailsCommande($idCommande["max(id_commande)"],$_SESSION['panier'][$i]['id_article'],$_SESSION['panier'][$i]['prix'],$_SESSION['panier'][$i]['quantite']);
    }



//    TODO s'il n'y a pas d'érreur, on vide le panier'
    unset($_SESSION['panier']);

}

header('location: articles_client');
exit;