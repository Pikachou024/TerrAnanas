<?php

function getURL($url){
    return str_replace(PATH_ROOT2,'',$url);
}
/*
 * inclusion des Classe
 */
function autoloadController($class_name,$path): void
{
    include '../controllers/'.$path.'/'.ucfirst($class_name) . '.php';
}

function checkEmail($email,$users):bool{
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



/**
 * Recherche
 *
 * Article, client, commande
 */

function searchArticle(string $article, array $listeArticle): array
{
    $articles=[];
    for($i=0 ; $i<count($listeArticle) ; $i++){
        if(!substr_compare(strtolower($listeArticle[$i]['label_article']),strtolower($article),0,strlen($article))){
            $articles[] = $listeArticle[$i];
        }
    }
    return $articles;
}

function searchUser(string $user, array $listeUser): array
{
    $users = [];
    for($i=0 ; $i<count($listeUser) ; $i++){
        if(!substr_compare(strtolower($listeUser[$i]['society']),strtolower($user),0,strlen($user))){
            $users[] = $listeUser[$i];
        }
    }
    return $users;
}

/**
 * Gestion panier
 *
 * Ajout, modification ou suppression d'article
 */
function translateStatusArticle(int $status): string
{
    if($status == 1){
        return "Stock";
    }
    else{
        return "Rupture";
    }
}

function creationPanier() : bool
{
    if (!isset($_SESSION['panier'])){
        $_SESSION['panier']=array();
        $_SESSION['article']=array();
    }
    return true;
}

function checkArticle($idArticle,$quantite) :bool {
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
            if ($idArticle==$_SESSION['panier'][$i]['id_article']){
                $_SESSION['panier'][$i]['quantite'] += $quantite;
                return true;
            }
        }
    }
    return false;
}

function addArticle($idArticle,$label,$origine,$poids,$prix,$quantite,$famille,$unite): void
{
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

function deleteArticle($idArticle){
    //Si le panier existe
    if (creationPanier())
    {
        //Nous allons passer par un panier temporaire
        $tmp = array();
        for($i = 0; $i < count($_SESSION['panier']); $i++) {
            if ($_SESSION['panier'][$i]['id_article'] !== $idArticle){
                $tmp[] = ['id_article' => $_SESSION['panier'][$i]['id_article'],
                    'label_article' => $_SESSION['panier'][$i]['label_article'],
                    'origine' => $_SESSION['panier'][$i]['origine'],
                    'poids' => $_SESSION['panier'][$i]['poids'],
                    'label_unite' => $_SESSION['panier'][$i]['label_unite'],
                    'prix' => $_SESSION['panier'][$i]['prix'],
                    'label_famille' => $_SESSION['panier'][$i]['label_famille'],
                    'quantite' => $_SESSION['panier'][$i]['quantite']];
            }

        }
        unset($_SESSION['panier']);
        if(!empty($tmp)){
            //On remplace le panier en session par notre panier temporaire à jour
            $_SESSION['panier']= $tmp;
            //On efface notre panier temporaire
            unset($tmp);

        }
    }
    else
        echo "Un problème est survenu veuillez contacter l'administrateur du site.";
}

function modifierQTeArticle($idArticle,$quantite){
    //Si le panier existe

    if (creationPanier()) {
        //Si la quantité est positive on modifie sinon on supprime l'article
        if ($quantite > 0) {
            //Recherche du produit dans le panier
            for ($i = 0; $i < count($_SESSION['panier']); $i++) {
                if($idArticle === $_SESSION['panier'][$i]['id_article'] ){
                    $_SESSION['panier'][$i]['quantite'] = $quantite;
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

function montantTotal(array $listeArticle): float|int
{
    $totalPanier = 0;

    for($i=0 ; $i < count($listeArticle) ; $i++){
        $totalArticle = ($listeArticle[$i]["prix"] * $listeArticle[$i]["poids"])*$listeArticle[$i]["quantite"];
        $totalPanier += $totalArticle;
    }
    return $totalPanier;
}

function remiseCommande($montantCommande,$remise) : float{
    return $montantCommande - $montantCommande*($remise/100);

}

/**
 * Gestion date
 *
 * Changement du format date en français
 */
function dateFr(string $date){

    $days =["Sun"=>"Dimanche",
        "Mon"=>"Lundi",
        "Tue"=>"Mardi",
        "Wed"=>"Mercredi",
        "Thu"=>"Jeudi",
        "Fri"=>"Vendredi",
        "Sat"=>"Samedi"];

    $months = ["Jan"=>"janvier",
        "Feb"=>"février",
        "Mar"=>"mars",
        "Apr"=>"avril",
        "May"=>"mai",
        "Jun"=>"juin",
        "Jul"=>"juillet",
        "Aug"=>"août",
        "Sep"=>"septembre",
        "Oct"=>"octobre",
        "Nov"=>"novembre",
        "Dec"=>"décembre"];

    $date = replaceDate($days,$date);
    return replaceDate($months,$date);
}

function replaceDate(Array $tableDates, string $date){
    foreach($tableDates as $tableDate => $tableDateReplace){
        if(strpos($date,$tableDate) !== false){
            return str_replace($tableDate,$tableDateReplace,$date);
        }
    }
}

function addDayDate(int $addDay){
    $date = date('D d M Y', strtotime('+'.$addDay.'days'));
    return dateFr($date);
}

function changeFormatDate(string $date){
    if(strpos($date,'/')){
       return str_replace('/','-',$date);
    }
    elseif (strpos($date,'-')){
        return str_replace('-','/',$date);
    }
}
/**
 * Gestion connexion session
 *
 * Détermine si l'utilisateur est connecté ou non
 * @return bool - true si l'utilisateur est connecté, false sinon
 */

function isConnected(): bool {
    // On commence par vérifier qu'une session est bien démarrée
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    return array_key_exists('user', $_SESSION) && isset($_SESSION['user']);
}

function registerUser(string $id,string $society, string $email, $role): void
{
    // On commence par vérifier qu'une session est bien démarrée
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    // Puis on enregistre les données de l'utilisateur en session
    $_SESSION['user'] = [
        'id' => $id,
        'society' => $society,
        'email' => $email,
        'role' => $role
    ];
}

function disconnect(){
    // Si l'utilisateur est connecté...
    if (isConnected()) {
        // On efface nos données en session
        $_SESSION['user'] = null;
        // On ferme la session
        session_destroy();
    }
}

/**
 * Retourne le rôle de l'utilisateur connecté
 */
function getUserRole(){
    // Si l'utilisateur est connecté...
    if (!isConnected()) {
        return null;
    }
    return $_SESSION['user']['role'];
}

/**
 * Retourne l'id de l'utilisateur connecté
 */
function getUserId(){
    if(!isConnected()){
        return null;
    }
    return $_SESSION['user']['id'];
}

/**
 * Retourne le nom de l'utilisateur connecté
 */
function getUserName(){
    if(!isConnected()){
        return null;
    }
    return $_SESSION['user']['society'];
}

/**
 * Retourne l'email de l'utilisateur connecté
 */
function getUserEmail(){
    if(!isConnected()){
        return null;
    }
    return $_SESSION['user']['email'];
}

/**
 * Vérifie si l'utilisateur possède un rôle particulier
 */
function hasRole(string $role):bool{
    if (!isConnected()) {
        return false;
    }
    return getUserRole() == $role;
}


