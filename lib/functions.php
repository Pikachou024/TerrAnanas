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

}
