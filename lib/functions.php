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