<?php

$idUser = $_GET['id'];

/*      Ecrire le code si l'id n'est pas trouvé
        à faire                                     */

$userModel = new UserModel();
$userModel -> deleteUser($idUser);

header('location: users');
exit;