<?php

class MessageAdmin extends AbstractController
{
    function messages(){
        $role = getUserRole();

        if($role != "admin") {
            http_response_code(403);
            header("location:page_403");
            exit;
        }

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
        if($role != "admin") {
            http_response_code(403);
            header("location:page_403");
            exit;
        }

        $idMessage = intval($_GET['id']);
        $messageModel = new MessageModel();
        $message = $messageModel->getOneMessage($idMessage);
        if(!empty($_POST)) {
            $reponse=htmlspecialchars(trim($_POST['reponse']));
            sendMail(getUserEmail(),$message['email'],"Réponse concernant votre message",$reponse,true);
        }
        $params["message"]=$message;
        $params["title"]="Admin - Message";
        $this->render($this->file, $this->page, $this->base, $params);
    }

    function deleteMessage(){
        $role = getUserRole();
        if($role != "admin") {
            http_response_code(403);
            header("location:page_403");
            exit;
        }

        $idmessage = intval($_GET['id']);
        $messageModel = new MessageModel();
        $messageModel->deleteMessage($idmessage);

        header('location:messages');
    }
}