<?php
$dateDuJour = dateFr(date('D d M Y'));

/*
 * Partie commande du jour
 * affiche maximum 5 commandes du jour
 */
$commandeModel = new CommandeModel();
$commandeDuJour = $commandeModel->getCommandeByDate(date('Y-m-d'),1);
if(count($commandeDuJour)>5){
    $commandeDuJour = array_slice($commandeDuJour,0,5);
}
dump($commandeDuJour);
/*
 * Partie Inscription
 * affiche les utilisateurs en attentent de validation
 */
$userModel = new userModel();
$users = $userModel ->getAllUsers(1);


/*
 * Partie franco
 * affichage et modification (en ajax)
 */
$francoModel = new FrancoModel();
$franco = $francoModel->getFranco(1);
if(!empty($_POST['franco'])){
    $francoModel->editFranco($_POST['franco'],1);
}
if(!isset($_GET['ajax'])){
    $title = "Admin - TerrAnanas";
    $template='admin';
    include '../templates/admin/base_admin.phtml';
}
else{
    echo "Le franco a été modifié" ;
}

