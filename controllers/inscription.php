<?php

$society ='';
$address ='';
$city ='';
$postal ='';
$contact ='';
$phone ='';
$email ='';

$userModel = new UserModel();
$users = $userModel ->getAllUsers();

$error=[];

if(!empty($_POST)){

    $society = strip_tags(trim($_POST['society']));
    $address = strip_tags(trim($_POST['address']));
    $city = strip_tags(trim($_POST['city']));
    $postal = strip_tags(trim($_POST['postal']));
    $contact = strip_tags(trim($_POST['contact']));
    $phone = strip_tags(trim($_POST['phone']));
    $email = strip_tags(trim($_POST['email']));
    $password = strip_tags(trim($_POST['password']));
    $confirmPassword = strip_tags(trim($_POST['confirmPassword']));

    if(!$society){
        $error['society']="Veuillez remplir le champ";
    }
    if(!$address){
        $error['address'] = "Veuillez remplir le champ";
    }
    if(!$city){
        $error['city'] = "Veuillez remplir le champ";
    }
    if(!$postal){
        $error['postal'] = "Veuillez remplir le champ";
    }
    if(!$email){
        $error['email'] = "Veuillez remplir le champ";
    }
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error['email'] = 'Email invalide';
    }
    elseif (checkEmail($email,$users)===true){
        $error['email']= "L'email est déjà utilisé";

    }
    if(!$password){
        $error['password']="Veuillez remplir le champ";
    }
    elseif (strlen($password) < 8){
        $error['password']="Le mot de passe doit avoir 8 caractères minimum";
    }
    elseif ($password != $confirmPassword){
        $error['confirmPassword']="Veuillez rentrer le même mot de pass";
    }
    if(empty($error)){

        $hash = password_hash($password, PASSWORD_DEFAULT);

        $userModel->addUser($society,$address,$city,$postal,$contact,$phone,$email,$hash);

    }

}

include "../templates/inscription.phtml";