<?php

$idUser=$_GET['id'];
$error=[];

$userModel = new UserModel();
$user = $userModel ->getOneUser($idUser);

$society = $user['society'];
$address = $user['address'];
$postal = $user['postal'];
$city = $user['city'];
$contact = $user['contact'];
$phone = $user['phone'];
$email = $user['email'];

if(!empty($_POST)){

    $society = strip_tags(trim($_POST['society']));
    $address = strip_tags(trim($_POST['address']));
    $postal = strip_tags(trim($_POST['postal']));
    $city = strip_tags(trim($_POST['city']));
    $contact = strip_tags(trim($_POST['contact']));
    $phone = strip_tags(trim($_POST['phone']));
    $email = strip_tags(trim($_POST['email']));

    if(!$society){
        $error['society']="Veuillez remplir le champ";
    }
    if(!$address){
        $error['address']="Veuillez remplir le champ";
    }
    if(!$postal){
        $error['postal']="Veuillez remplir le champ";
    }
    if(!$city){
        $error['city']="Veuillez remplir le champ";
    }
    if(!$email){
        $error['email']="Veuillez remplir le champ";
    }

    if(empty($error)){
        $userModel ->editUser($society,$address,$city,$postal,$contact,$phone,$email,$idUser);
        header('location: users');
        exit;
    }

}

include '../templates/edit_user.phtml';