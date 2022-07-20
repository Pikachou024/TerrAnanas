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
        // On vérifie son mot de passe
        if (password_verify($password, $user['hash'])) {

            // Tout est ok, on retourne l'utilisateur
            return $user;
        }
    }

    // Si l'email ou le mot de passe est incorrect...
    return false;
}

function registerUser(string $id,string $society, string $email, $role)
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
        'role' => $role
    ];
}

function creationPanier(){
    if (!isset($_SESSION['panier'])){
        $_SESSION['panier']=array();
        $_SESSION['article']=array();
    }
    return true;
}

function checkArticle($idArticle,$quantite){

//    Si le quantite est à 0, on ne fait rien
    if($quantite == 0){
        return true;
    }

//    Si $_SESSION['article'] est vide, on ne fait rien
    if(empty($_SESSION['article'])){
        return false;
    }
    else{
        for ($i = 0; $i < count($_SESSION['panier']); $i++) {
            if (in_array($idArticle, $_SESSION['panier'][$i])) {
                $_SESSION['panier'][$i]['quantite'] += $quantite;
                return true;
            }
        }
    }
    return false;
}

function addArticle($idArticle,$label,$origine,$poids,$prix,$quantite,$famille,$unite){

//    //Si le panier existe
    if (creationPanier()) {

      /* On vérifie si l'article est présent dans le panier
       si oui, je rajoute le nombre de quantite */
        $articleOnPanier = checkArticle($idArticle,$quantite);

//      si non, je le rajoute dans le panier
        if($articleOnPanier === false){

            //Sinon on ajoute le produit
            $_SESSION['article'] = ['id_article' => $idArticle,
                'label_article' => $label,
                'origine'=>$origine,
                'poids' => $poids,
                'label_unite'=>$unite,
                'prix' => $prix,
                'label_famille'=>$famille,
                'quantite' => $quantite];

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
        $tmp['label_article'] = array();
        $tmp['poids'] = array();
        $tmp['prix'] = array();
        $tmp['quantite'] = array();
//        $tmp['verrou'] = $_SESSION['panier']['verrou'];

        for($i = 0; $i < count($_SESSION['panier']['label_article']); $i++)
        {
            if ($_SESSION['panier']['label_article'][$i] !== $label)
            {
                array_push( $tmp,$_SESSION['panier'][$i]);
                array_push( $tmp['label_article'],$_SESSION['panier']['label_article'][$i]);
                array_push( $tmp['poids'],$_SESSION['panier']['poids'][$i]);
                array_push( $tmp['prix'],$_SESSION['panier']['prix'][$i]);
                array_push( $tmp['quantite'],$_SESSION['panier']['quantite'][$i]);
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

function modifierQTeArticle($idArticle,$quantite)
{
    //Si le panier existe
    if (creationPanier()) {
        //Si la quantité est positive on modifie sinon on supprime l'article
        if ($quantite > 0) {
            //Recherche du produit dans le panier
            for ($i = 0; $i < count($_SESSION['panier']); $i++) {
                if (in_array($idArticle, $_SESSION['panier'][$i])) {
                    $_SESSION['panier'][$i]['quantite'] = $quantite;
//            $array[$idArticle]['quantite'] = $quantite;
//                    return true;
//                }
                }
            }
        }

        else{
                deleteArticle($idArticle);
            }
        }
    else {

            echo "Un problème est survenu veuillez contacter l'administrateur du site.";
        }


}
