<?php

class MessageAdmin extends AbstractController
{
    function messages(){
        $role = getUserRole();

//        if($role != "admin") {
//            http_response_code(403);
//            echo("Désolé la page n'existe pas");
//            exit;
//        }

        $messageModel = new MessageModel();
        $messages = $messageModel->getAllMessages();

        $params=[
            'messages'=>$messages,
            'title'=>"Admin - Messages"
        ];
        $this->render($this->file, $this->page, $this->base, $params);
    }

    function messageDetails(){
        $role = getUserRole();
//        if($role != "admin") {
//            http_response_code(403);
//            echo("Désolé la page n'existe pas");
//            exit;
//        }

        $idMessage = intval($_GET['id']);
        $messageModel = new MessageModel();
        $message = $messageModel->getOneMessage($idMessage);

        if(!empty($_POST)) {

        }
        $params["message"]=$message;
        $params["title"]="Admin - Message";
        $this->render($this->file, $this->page, $this->base, $params);
    }

    function deleteMessage(){
        $role = getUserRole();
//        if($role != "admin") {
//            http_response_code(403);
//            echo("Désolé la page n'existe pas");
//            exit;
//        }

        $idmessage = intval($_GET['id']);
        $messageModel = new MessageModel();
        $messageModel->deleteMessage($idmessage);

        header('location:messages');
    }
}