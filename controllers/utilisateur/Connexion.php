<?php

class Connexion extends AbstractController
{
    function login(){
        $email = '';
        $params['email']=$email;
        if(!empty($_POST)){
            $email = strip_tags(trim($_POST['email']));
            $password = strip_tags(trim($_POST['password']));

            /*
             * Vérification du user et son mdp
             */
            $user = checkUser($email,$password);

            if($user){
                registerUser($user['id_user'],$user['society'],$user['email'],$user['label_role']);
                if($user['id_role'] == 2){
                    if($user['id_status']==2){
                        header('location:client');
                    }
                    elseif($user['id_status']==1){
                        /*
                         * TODO message a faire
                         */
//                        echo"Votre demande d'inscription est en cours de traitement";
                        header('location:login');
                    }
                    else{
//                        echo("Votre demande a été refusé");
                        header('location:contact');
                    }
                    exit;
                }
                elseif ($user['id_role'] == 1){
                    header('location:admin');
                    exit;
                }
            }
        }
        $params['title'] =  "TerrAnanas - Espace Pro";
        $this->render($this->file, $this->page, $this->base, $params);
    }

    function logout(){
        disconnect();
        // On le redirige vers l'accueil
        header('Location:home');
        exit;
    }

    function signup()
    {
        $society = '';
        $address = '';
        $city = '';
        $postal = '';
        $contact = '';
        $phone = '';
        $email = '';


//        if(isset($_SESSION['confirmation'])){
//            unset($_SESSION['confirmation']);
//        }
        $userModel = new UserModel();
        //Indice en fonction de bdd status à faire
        for ($i = 1; $i <= 3; $i++) {
            $allUsers = $userModel->getAllUsers($i);
            if($allUsers){
                foreach ($allUsers as $index => $user) {
                    $users[] = $user;
                }
            }
        }

        $error=[];

        if (!empty($_POST)) {
            $society = strip_tags(trim($_POST['society']));
            $address = strip_tags(trim($_POST['address']));
            $city = strip_tags(trim($_POST['city']));
            $postal = strip_tags(trim($_POST['postal']));
            $contact = strip_tags(trim($_POST['contact']));
            $phone = strip_tags(trim($_POST['phone']));
            $email = strip_tags(trim($_POST['email']));
            $password = strip_tags(trim($_POST['password']));
            $confirmPassword = strip_tags(trim($_POST['confirmPassword']));

            if (!$society) {
                $error['society'] = "Veuillez remplir le champ";
            }
            if (!$address) {
                $error['address'] = "Veuillez remplir le champ";
            }
            if (!$city) {
                $error['city'] = "Veuillez remplir le champ";
            }
            if (!$postal) {
                $error['postal'] = "Veuillez remplir le champ";
            }
            if (!$email) {
                $error['email'] = "Veuillez remplir le champ";
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error['email'] = 'Email invalide';
            }
            elseif (checkEmail($email, $users) === true) {
                $error['email'] = "L'email est déjà utilisé";
            }
            if (!$password) {
                $error['password'] = "Veuillez remplir le champ";
            } elseif (strlen($password) < 8) {
                $error['password'] = "Le mot de passe doit avoir 8 caractères minimum";
            } elseif ($password != $confirmPassword) {
                $error['confirmPassword'] = "Veuillez rentrer le même mot de pass";
            }
            if (empty($error)) {
                $hash = password_hash($password, PASSWORD_DEFAULT);
                $userModel->addUser($society, $address, $city, $postal, $contact, $phone, $email, $hash, 1, 2);
                /*
                 * TODO message de confirmation à faire
                 */
//                $_SESSION['confirmation']="Votre demande d'inscription sera étudié par nos services";
                header('location:inscription');
                exit;
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
            'error'=>$error
        ];
            $params['title'] =  "TerrAnanas - Inscription";
            $this->render($this->file, $this->page, $this->base, $params);
    }
}