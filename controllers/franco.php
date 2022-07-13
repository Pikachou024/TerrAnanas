<?php

if(!empty($_POST)){

    $_SESSION['franco']=$_POST['franco'];

    header('location: articles');
    exit;
}

