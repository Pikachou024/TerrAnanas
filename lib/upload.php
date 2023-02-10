<?php

function uploadImage($file) {
    if (!empty($file)) {
        $tmpName = $file['tmp_name'];
        $name = $file['name'];
        $size = $file['size'];
        $error = $file['error'];

        $tabExtension = explode('.', $name);
        $extension = strtolower(end($tabExtension));
        $extensions = ['jpg', 'png', 'jpeg'];
        $maxSize = 400000;

        if(in_array($extension, $extensions) && $size <= $maxSize){
            if($error==0){
                move_uploaded_file($tmpName, './images/upload/'.$name);
            }else{
                addFlashMessage("Une erreur est survenue lors de l'upload",'error');
            }
        }
        else{
            addFlashMessage('Fichier non autorisé : extension non accepté ou taille grande','error');
        }

    }

}
