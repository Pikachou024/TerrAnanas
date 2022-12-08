<?php

class Admin extends AbstractController
{
    function accueil(){
        $dateDuJour = dateFr(date('D d M Y'));
        /*
         * Partie commande du jour
         * affiche maximum 5 commandes du jour
         */
        $commandeModel = new CommandeModel();
        $commandeDuJour = $commandeModel->getCommandeByDate(date('Y-m-d'),1);
        if(count($commandeDuJour)>5){
            $commandeDuJour = array_slice($commandeDuJour,0,5);
        }
        /*
         * Partie Inscription
         * affiche les utilisateurs en attentent de validation
         */
        $userModel = new userModel();
        $users = $userModel ->getAllUsers(1);
        $params=[
            'dateDuJour'=>$dateDuJour,
            'users'=>$users,
            'commandeDuJour'=>$commandeDuJour,
            'title' => "TerrAnanas - Gérer vos commandes en quelques click"
        ];
        $this->render($this->file, $this->page, $this->base, $params);
    }

    function parametre(){
        $role = getUserRole();

        if($role != "client") {
            http_response_code(403);
            echo("Désolé la page n'existe pas");
            exit;
        }

        $error=[];
        $id = getUserId();
        $userModel = new UserModel();
        $user = $userModel->getOneUser($id);

        $society = $user['society'];
        $address = $user['address'];
        $postal = $user['postal'];
        $city = $user['city'];
        $contact = $user['contact'];
        $phone = $user['phone'];
        $email = $user['email'];

        if(!empty($_POST)){

            $society = strip_tags(trim($_POST['society']));
            $address = strip_tags(trim($_POST['address']));
            $postal = strip_tags(trim($_POST['postal']));
            $city = strip_tags(trim($_POST['city']));
            $contact = strip_tags(trim($_POST['contact']));
            $phone = strip_tags(trim($_POST['phone']));
            $email = strip_tags(trim($_POST['email']));
            $status = $user['id_status'];

            if(!$society){
                $error['society']="Veuillez remplir le champ";
            }
            if(!$address){
                $error['address']="Veuillez remplir le champ";
            }
            if(!$postal){
                $error['postal']="Veuillez remplir le champ";
            }
            if(!$city){
                $error['city']="Veuillez remplir le champ";
            }
            if(!$email){
                $error['email']="Veuillez remplir le champ";
            }
            if(empty($error)){
                $userModel->editUser($society,$address,$city,$postal,$contact,$phone,$email,$status,$id);
                header('location: parametre_admin');

            }
        }
        $params = [
            'society' => $society,
            'address' => $address,
            'city' => $city,
            'postal' => $postal,
            'contact' => $contact,
            'phone' => $phone,
            'email' => $email,
            'error'=>$error,
            'title'=>"Paramètre"
        ];
        $this->render($this->file, $this->page, $this->base, $params);
    }
}