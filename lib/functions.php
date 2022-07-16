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
//        'contact' => $contact,
        'email' => $email,
//        'role' => $role
    ];
}

function creationPanier(){
    if (!isset($_SESSION['panier'])){
        $_SESSION['panier']=array();
        $_SESSION['article']=array();
    }
    return true;
}

function checkArticle($idArticle,$array,$colis){

//    Si le colis est à 0, on ne fait rien
    if($colis == 0){
        return true;
    }

//    Si $_SESSION['article'] est vide, on ne fait rien
    if(empty($_SESSION['article'])){
        return false;
    }
    else{
        for ($i = 0; $i < count($array); $i++) {
            if (in_array($idArticle, $array[$i])) {
                $_SESSION['panier'][$i]['colis'] += $colis;
                return true;
            }
        }
    }
    return false;
}

function addArticle($idArticle,$label,$quantite,$prix,$colis){

//    //Si le panier existe
    if (creationPanier()) {

      /* On vérifie si l'article est présent dans le panier
       si oui, je rajoute le nombre de colis */
        $articleOnPanier = checkArticle($idArticle,$_SESSION['panier'],$colis);

//      si non, je le rajoute dans le panier
        if($articleOnPanier === false){

            //Sinon on ajoute le produit
            $_SESSION['article'] = ['idArticle' => $idArticle,
                'label' => $label,
                'quantite' => $quantite,
                'prix' => $prix,
                'colis' => $colis];

            $_SESSION['panier'][] = $_SESSION['article'];
        }

    }
    else{
        echo "Un problème est survenu veuillez contacter l'administrateur du site.";
    }
}


//TODO fonction suppression d'un article dans le panier
function deleteArticle($label){
    //Si le panier existe
    if (creationPanier())
    {
        //Nous allons passer par un panier temporaire
        $tmp=array();
        $tmp = array();
        $tmp['label'] = array();
        $tmp['quantite'] = array();
        $tmp['prix'] = array();
        $tmp['colis'] = array();
//        $tmp['verrou'] = $_SESSION['panier']['verrou'];

        for($i = 0; $i < count($_SESSION['panier']['label']); $i++)
        {
            if ($_SESSION['panier']['label'][$i] !== $label)
            {
                array_push( $tmp,$_SESSION['panier'][$i]);
                array_push( $tmp['label'],$_SESSION['panier']['label'][$i]);
                array_push( $tmp['quantite'],$_SESSION['panier']['quantite'][$i]);
                array_push( $tmp['prix'],$_SESSION['panier']['prix'][$i]);
                array_push( $tmp['colis'],$_SESSION['panier']['colis'][$i]);
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

//TODO Modifier la quantitée d'un article dans le panier '
function modifierQTeArticle($label,$colis){
    //Si le panier existe
    if (creationPanier())
    {
        //Si la quantité est positive on modifie sinon on supprime l'article
        if ($colis> 0)
        {
            //Recherche du produit dans le panier
            $positionProduit = array_search($label,  $_SESSION['panier']['label']);

            if ($positionProduit !== false)
            {
                $_SESSION['panier']['colis'][$positionProduit] = $colis ;
            }
        }
        else
            deleteArticle($label);
    }
    else
        echo "Un problème est survenu veuillez contacter l'administrateur du site.";
}