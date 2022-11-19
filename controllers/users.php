<?php

$userModel = new userModel();
$statusModel = new StatusModel();
$status = $statusModel->getAllStatus();

$userStatus = (!empty($_POST['userStatus'])) ? strip_tags(trim($_POST['userStatus'])) : 1;
$users = $userModel ->getAllUsers($userStatus);
//if(!empty($_POST['userStatus'])){
//    $userStatus = $_POST['userStatus'];
//}
//else{
//    $userStatus = 1;
//}

//$userSearch = (!empty($_POST['userSearch'])) ? strip_tags(trim($_POST['userSearch'])) : 1;
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