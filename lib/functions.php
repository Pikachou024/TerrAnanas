<?php

function getURL($url){
    return str_replace(PATH_ROOT2,'',$url);
}

function checkEmail($email,$users){
    foreach ($users as $user){
        if($email == $user['email']){
            return true;
        }
    }
    return false;
}

function checkUser(string $email, string $password)
{
    // On récupère l'utilisateur à partir de son email
    $userModel = new UserModel();
    $user = $userModel->getUserByEmail($email);
    // Si on trouve bien un utilisateur...
    if ($user) {
        var_dump($user);
        // On vérifie son mot de passe
        if (password_verify($password, $user['hash'])) {

            // Tout est ok, on retourne l'utilisateur
            return $user;
        }
    }

    // Si l'email ou le mot de passe est incorrect...
    return false;
}

function registerUser(string $id,string $society, string $email)
{
    // On commence par vérifier qu'une session est bien démarrée
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    // Puis on enregistre les données de l'utilisateur en session
    $_SESSION['user'] = [
        'id' => $id,
        'society' => $society,
        'contact' => $contact,
        'email' => $email,
//        'role' => $role
    ];
}

function creationPanier(){
    if (!isset($_SESSION['panier'])){
        $_SESSION['panier']=array();
        $_SESSION['panier']['idArticle']=array();
        $_SESSION['panier']['label'] = array();
        $_SESSION['panier']['quantite'] = array();
        $_SESSION['panier']['prix'] = array();
        $_SESSION['panier']['colis'] = array();

    }
    return true;
}
function addArticle($label,$quantite,$prix,$idArticle,$colis){

    //Si le panier existe
    if (creationPanier())
    {
        //Si le produit existe déjà on ajoute seulement la quantité
        $positionProduit = array_search($label,  $_SESSION['panier']['label']);

        if ($positionProduit !== false)
        {
            $_SESSION['panier']['colis'][$positionProduit] += $colis ;
        }
        else
        {
            //Sinon on ajoute le produit
            array_push( $_SESSION['panier']['idArticle'],$idArticle);
            array_push( $_SESSION['panier']['label'],$label);
            array_push( $_SESSION['panier']['quantie'],$quantite);
            array_push( $_SESSION['panier']['prix'],$prix);
            array_push( $_SESSION['panier']['colis'],$colis);
        }
    }
    else
        echo "Un problème est survenu veuillez contacter l'administrateur du site.";
}

function deleteArticle($label){
    //Si le panier existe
    if (creationPanier())
    {
        //Nous allons passer par un panier temporaire
        $tmp=array();
        $tmp['libelleProduit'] = array();
        $tmp['qteProduit'] = array();
        $tmp['prixProduit'] = array();
        $tmp['verrou'] = $_SESSION['panier']['verrou'];

        for($i = 0; $i < count($_SESSION['panier']['libelleProduit']); $i++)
        {
            if ($_SESSION['panier']['libelleProduit'][$i] !== $libelleProduit)
            {
                array_push( $tmp['libelleProduit'],$_SESSION['panier']['libelleProduit'][$i]);
                array_push( $tmp['qteProduit'],$_SESSION['panier']['qteProduit'][$i]);
                array_push( $tmp['prixProduit'],$_SESSION['panier']['prixProduit'][$i]);
            }

        }
        //On remplace le panier en session par notre panier temporaire à jour
        $_SESSION['panier'] =  $tmp;
        //On efface notre panier temporaire
        unset($tmp);
    }
    else
        echo "Un problème est survenu veuillez contacter l'administrateur du site.";
}