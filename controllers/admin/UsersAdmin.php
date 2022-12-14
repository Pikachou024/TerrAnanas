<?php

class UsersAdmin extends AbstractController
{
    function users(){
        if(isset($_SESSION['flash'])){
            $params['flash']=$_SESSION['flash'];
            unset($_SESSION['flash']);
        }

        $userModel = new userModel();
        $statusModel = new StatusModel();
        $status = $statusModel->getAllStatus();

        $userStatus = (!empty($_POST['userStatus'])) ? strip_tags(trim($_POST['userStatus'])) : 1;
        $params['statusUser']=intval($userStatus);
        $params['nameStatus']= $statusModel->getNameStatus($userStatus);
        $users = $userModel ->getAllUsers($userStatus);

//if(!empty($_POST['userStatus'])){
//    $userStatus = $_POST['userStatus'];
//}
//else{
//    $userStatus = 1;
//}

//$userSearch = (!empty($_POST['userSearch'])) ? strip_tags(trim($_POST['userSearch'])) : 1;
        if(!empty($_POST['userSearch'])){
            $userSearch = $_POST['userSearch'];
            $_SESSION['userSearch'] = searchUser($userSearch,$users);
            $params['userSearch']=$userSearch;
        }
        else{
            unset($_SESSION['userSearch']);
        }

        $params['status']=$status;
        $params['users']=$users;
        $params['title']="Listes des clients";
        $this->render($this->file, $this->page, $this->base, $params);
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
        $status = $statusModel->getAllStatus();

        $society = $user['society'];
        $address = $user['address'];
        $postal = $user['postal'];
        $city = $user['city'];
        $contact = $user['contact'];
        $phone = $user['phone'];
        $email = $user['email'];

        if(!empty($_POST)) {

            $society = strip_tags(trim($_POST['society']));
            $address = strip_tags(trim($_POST['address']));
            $postal = strip_tags(trim($_POST['postal']));
            $city = strip_tags(trim($_POST['city']));
            $contact = strip_tags(trim($_POST['contact']));
            $phone = strip_tags(trim($_POST['phone']));
            $email = strip_tags(trim($_POST['email']));
            $status = strip_tags(trim($_POST['status']));

            if (!$society) {
                $error['society'] = "Veuillez remplir le champ";
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
                $userModel->editUser($society, $address, $city, $postal, $contact, $phone, $email, $status, $idUser);
                header('location: users_admin');
                exit;
            }
        }
        $params=[
            'society'=>$society,
            'address'=>$address,
            'postal'=>$postal,
            'city'=>$city,
            'contact'=>$contact,
            'phone'=>$phone,
            'email'=>$email,
            'status'=>$status,
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