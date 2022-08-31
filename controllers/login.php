<?php

$email = '';

if(!empty($_POST)){
    $email = strip_tags(trim($_POST['email']));
    $password = strip_tags(trim($_POST['password']));

    $user = checkUser($email,$password);

    if($user){

        registerUser($user['id_user'],$user['society'],$user['email'],$user['label_role']);

        if($user['label_role'] == 'client'){
            if($user['label_status']=="Validé"){
                header('location:article_client');
                exit;
            }
            elseif($user['label_status']=="En attente"){
                echo"Votre demande d'inscription est en cours de traitement";
            }
            else{
                echo("Votre demande a été refusé");
            }
        }
        elseif ($user['label_role']== 'admin'){

            header('location:articles');
            exit;
        }
    }


}

include "../templates/login.phtml";