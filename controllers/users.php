<?php

$userModel = new userModel();
$users = $userModel ->getAllUsers();

if(!empty($_POST['userSearch'])){
    $userSearch = $_POST['userSearch'];
    $_SESSION['userSearch'] = searchUser($userSearch,$users);
}
else{
    unset($_SESSION['userSearch']);
}
$title="Liste clients";
$template="users";

include "../templates/base_admin.phtml";