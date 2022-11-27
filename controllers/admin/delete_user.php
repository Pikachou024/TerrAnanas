<?php

$roleUser=getUserRole();

if($roleUser != "admin") {
    http_response_code(403);
    echo("Désolé la page n'existe pas");
    exit;
}

$idUser = $_GET['id'];

/*      Ecrire le code si l'id n'est pas trouvé
        à faire                                     */

$userModel = new UserModel();
$userModel -> deleteUser($idUser);

header('location: users_admin');
exit;