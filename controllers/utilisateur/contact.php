<?php

class Contact extends AbstractController
{
    function contact(){
        $idUser = getUserId();
        if($idUser){
            $email = getUserEmail();
            $params['idUser']=$idUser;
            $params['email']=$email;
        }

        $messageModel = new MessageModel();
        $errors=[];

        if(!empty($_POST)){
            $email = strip_tags(trim($_POST['email']));
            $subject = strip_tags(trim($_POST['subject']));
            $text = strip_tags(trim($_POST['text']));
            if($subject == null){
                $errors['subject'] = "Veuillez choisir un sujet";
            }

            if(empty($errors)){
                $messageModel->sendMessage($email,$subject,$text,1,$idUser);
            }
        }

        $params['title']="TerrAnanas - contact";
        $this->render($this->file,$this->page,$this->base,$params);
    }

}