<?php

$email = '';

if(!empty($_POST)){
    $email = strip_tags(trim($_POST['email']));
    $password = strip_tags(trim($_POST['password']));

    $user = checkUser($email,$password);
    var_dump($user);

    if($user){

        registerUser($user['id_user'],$user['society'],$user['email']);

//        if($user['role'] == 'client'){
//            header('location: home');
//            exit;
//        }
//        elseif ($user['role']== 'admin'){

            header('location: articles');
            exit;
//        }
    }


}

include "../templates/login.phtml";