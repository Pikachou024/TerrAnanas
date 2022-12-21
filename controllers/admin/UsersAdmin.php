<?php

class UsersAdmin extends AbstractController
{
    function users(){
        if(isset($_SESSION['flash'])){
            $params['flash']=$_SESSION['flash'];
            unset($_SESSION['flash']);
        }

        $userModel = new UserModel();
        $status = new StatusModel();
        $statut = $status->getAllstatus();

        $userstatut = (!empty($_POST['userstatut'])) ? strip_tags(trim($_POST['userstatut'])) : 1;
        $params['statutUser']=intval($userstatut);
        $params['namestatut']= $status->getNamestatus($userstatut);
        $users = $userModel ->getAllUsers($userstatut);

        if(!empty($_POST['userSearch'])){
            $userSearch = $_POST['userSearch'];
            $_SESSION['userSearch'] = searchUser($userSearch,$users);
            $params['userSearch']=$userSearch;
        }
        else{
            unset($_SESSION['userSearch']);
        }

        $params['statut']=$statut;
        $params['users']=$users;
        $params['title']="Listes des clients";

        if(!empty($_GET['ajax'])){
            $this->render($this->file, 'liste_users_admin', '', $params);
        }else{
            $this->render($this->file, $this->page, $this->base, $params);
        }
//        $this->render($this->file, $this->page, $this->base, $params);
    }

    function editUser(){

        $role=getUserRole();

        //if($role != "admin") {
        //    http_response_code(403);
        //    echo("Désolé la page n'existe pas");
        //    exit;
        //}

        $idUser=$_GET['id'];
        $error=[];

        $userModel = new UserModel();
        $user = $userModel ->getOneUser($idUser);

        $statusModel = new StatusModel();
        $statut = $statusModel->getAllStatus();

        $client = $user['client'];
        $address = $user['address'];
        $postal = $user['postal'];
        $city = $user['city'];
        $contact = $user['contact'];
        $phone = $user['phone'];
        $email = $user['email'];

        if(!empty($_POST)) {

            $client = strip_tags(trim($_POST['client']));
            $address = strip_tags(trim($_POST['address']));
            $postal = strip_tags(trim($_POST['postal']));
            $city = strip_tags(trim($_POST['city']));
            $contact = strip_tags(trim($_POST['contact']));
            $phone = strip_tags(trim($_POST['phone']));
            $email = strip_tags(trim($_POST['email']));
            $statut = strip_tags(trim($_POST['statut']));

            if (!$client) {
                $error['client'] = "Veuillez remplir le champ";
            }
            if (!$address) {
                $error['address'] = "Veuillez remplir le champ";
            }
            if (!$postal) {
                $error['postal'] = "Veuillez remplir le champ";
            }
            if (!$city) {
                $error['city'] = "Veuillez remplir le champ";
            }
            if (!$email) {
                $error['email'] = "Veuillez remplir le champ";
            }

            if(empty($error)) {
                $userModel->editUser($client, $address, $city, $postal, $contact, $phone, $email, $statut, $idUser);
                header('location: users_admin');
                exit;
            }
        }
        $params=[
            'client'=>$client,
            'address'=>$address,
            'postal'=>$postal,
            'city'=>$city,
            'contact'=>$contact,
            'phone'=>$phone,
            'email'=>$email,
            'statut'=>$statut,
            'user'=>$user,
            'error'=>$error,
            'title'=>"Modification - client"
            ];

        $this->render($this->file, $this->page, $this->base, $params);
    }

    function deleteUser(){

        $role=getUserRole();

//        if($role != "admin") {
//            http_response_code(403);
//            echo("Désolé la page n'existe pas");
//            exit;
//        }

        $idUser = $_GET['id'];

        /*      Ecrire le code si l'id n'est pas trouvé
                à faire                                     */
        if(!$idUser){
            $_SESSION['flash']="Client introuvable";
            header('location:users_admin');
            exit;
        }

        $userModel = new UserModel();
        $userModel -> deleteUser($idUser);

        header('location: users_admin');
        exit;
    }
}