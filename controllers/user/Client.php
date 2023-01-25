<?php

class Client extends AbstractController
{
    function index(){

        $role = getUserRole();
        if(!$role) {
            http_response_code(403);
            echo("accès refusé");
            exit;
        }


        $dateDuJour = dateFr(date('D d M Y'));
        $idUser = intval(getUserId());
        $commandeModel = new CommandeModel();
        $commandeEnAttente = $commandeModel->getCommandeByClient($idUser,1);
        $commandeValidee = $commandeModel->getCommandeByClient($idUser,2);
        if(count($commandeEnAttente)>5){
            $commandeEnAttente = array_slice($commandeEnAttente,0,5);
        }
        $livraisonDuJour = $commandeModel->getCommandeByLivraison($idUser,1,date('Y-m-d'));
        $params=[
            'dateDuJour'=>$dateDuJour,
            'idUser'=>$idUser,
            'commandeEnAttente'=>$commandeEnAttente,
            'commandeValidee'=>$commandeValidee,
            'livraisonDuJour'=>$livraisonDuJour,
            'title' => "TerrAnanas - Gérer vos commandes en quelques click"
            ];
        $this->render($this->file, $this->page, $this->base, $params);
    }

    function parametre(){
//        $params=[];
        $roleUser = getUserRole();

        if($roleUser != "client") {
            http_response_code(403);
            echo("Désolé la page n'existe pas");
            exit;
        }

        $error=[];
        $id=getUserId();
        $userModel = new UserModel();
        $user = $userModel->getOneUser($id);

        $name = $user['client'];
        $address = $user['address'];
        $postal = $user['postal'];
        $city = $user['city'];
        $contact = $user['contact'];
        $phone = $user['phone'];
        $email = $user['email'];

        if(!empty($_POST)){

            $name = strip_tags(trim($_POST['client']));
            $address = strip_tags(trim($_POST['address']));
            $postal = strip_tags(trim($_POST['postal']));
            $city = strip_tags(trim($_POST['city']));
            $contact = strip_tags(trim($_POST['contact']));
            $phone = strip_tags(trim($_POST['phone']));
            $email = strip_tags(trim($_POST['email']));
            $status = $user['id_status'];

            if(!$name){
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
                $userModel->editUser($name,$address,$city,$postal,$contact,$phone,$email,$status,$id);
                header('location: parametre_client');
                exit;
            }
        }
        $params = [
            'client' => $name,
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