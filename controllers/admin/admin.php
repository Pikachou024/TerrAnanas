<?php

class Admin extends AbstractController
{
    function index(){

        $role = getUserRole();

        if($role != "admin") {
            http_response_code(403);
            header("location:page_403");
            exit;
        }

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

        $commandeValidee = $commandeModel->getCommandeByDate(date('Y-m-d'),2);
        if(count($commandeDuJour)>5){
            $commandeValidee = array_slice($commandeDuJour,0,5);
        }

//        /*
//         * Partie Inscription
//         * affiche les utilisateurs en attentent de validation
//         */
        $userModel = new userModel();
        $users = $userModel ->getAllUsers(1);

        $params=[
            'dateDuJour'=>$dateDuJour,
            'commandeDuJour'=>$commandeDuJour,
            'commandeValidee'=>$commandeValidee,
            "usersInt"=>count($users),
            'title' => "TerrAnanas - Gérer vos commandes en quelques click"
        ];
        $this->render($this->file, $this->page, $this->base, $params);
    }

    function parametre(){
        $role = getUserRole();

        if($role != "admin") {
            http_response_code(403);
            header("location:page_403");
            exit;
        }
        $data=[];
        $error=[];
        $id = getUserId();
        $userModel = new UserModel();
        $user = $userModel->getOneUser($id);
        $francoModel = new FrancoModel();
        $franco = $francoModel->getFranco(1);

        $client = $user['client'];
        $address = $user['address'];
        $postal = $user['postal'];
        $city = $user['city'];
        $contact = $user['contact'];
        $phone = $user['phone'];
        $email = $user['email'];

        if(!empty($_POST)){

            $client = strip_tags(trim($_POST['client']));
            $address = strip_tags(trim($_POST['address']));
            $postal = strip_tags(trim($_POST['postal']));
            $city = strip_tags(trim($_POST['city']));
            $contact = strip_tags(trim($_POST['contact']));
            $phone = strip_tags(trim($_POST['phone']));
            $email = strip_tags(trim($_POST['email']));
            $statut = $user['id_statut'];

            if(!$client){
                $error['client']="Veuillez remplir le champ";
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
                $userModel->editUser($client,$address,$city,$postal,$contact,$phone,$email,$statut,$id);
//                header('location: parametre_admin');
                $data['message']="Profil Modifié";
                echo json_encode($data);
                exit;
            }

        }
        $params = [
            'client' => $client,
            'address' => $address,
            'city' => $city,
            'postal' => $postal,
            'contact' => $contact,
            'phone' => $phone,
            'email' => $email,
            'franco'=> $franco['franco'],
            'error'=>$error,
            'title'=>"Paramètre"
        ];
        $this->render($this->file, $this->page, $this->base, $params);
    }

    function franco()
    {
        $role = getUserRole();
        $data=[];
        if($role != "admin") {
            http_response_code(403);
            header("location:page_403");
            exit;
        }
        $francoModel = new FrancoModel();

        if(!empty($_POST)){
            $franco = strip_tags(trim($_POST['franco']));
            if (is_numeric($franco) && intval($franco) == $franco) {
                $francoModel->editFranco($franco,1);
                $data['message'] = "Le montant minimum de la commande est passée à" .$franco ." €";
                $data['montant'] = $franco;

            } else {
                $data['message'] = "Veuillez rentrer un montant";
            }
            echo json_encode($data);
        }

    }
}