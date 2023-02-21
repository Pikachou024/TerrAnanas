<?php

class Connexion extends AbstractController
{
    function login(){
        $email = '';

        if(!empty($_POST)){
            $email = strip_tags(htmlspecialchars(trim($_POST['email'])));
            $password = strip_tags(htmlspecialchars(trim($_POST['password'])));

            /*
             * Vérification du user et son mdp
             */
            $user = checkUser($email,$password);
            if($user){
                if($user['id_role'] == 2){
                    if($user['id_statut']== 2){
                        registerUser($user['id_user'],$user['client'],$user['email'],$user['role']);
                        header('location:client');
                        exit;
                    }
                    elseif($user['id_statut'] == 1){
                        addFlashMessage("Votre demande d'inscription est en cours de traitement",'error');
                        header('location:login');
                    }
                    else{
                        addFlashMessage("Votre demande d'inscription a été réfusé, pour plus de renseignement n'hésitez pas à nous contacter.",'error');
                        header('location:login');
                    }
                    exit;
                }
                elseif ($user['id_role'] == 1){
                    registerUser($user['id_user'],$user['client'],$user['email'],$user['role']);
                    header('location:admin');
                    exit;
                }
            }
            else{
                addFlashMessage("L'email ou le mot de passe est incorrect",'error');
                header('location:login');
                exit;
            }
        }

        $params['email']=$email;
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
        $client = '';
        $address = '';
        $city = '';
        $postal = '';
        $contact = '';
        $phone = '';
        $email = '';

        $userModel = new UserModel();
        $users = $userModel->Users();
        $error=[];

        if (!empty($_POST)) {
            $client = strip_tags(htmlspecialchars(trim($_POST['client'])));
            $address = strip_tags(htmlspecialchars(trim($_POST['address'])));
            $city = strip_tags(htmlspecialchars(trim($_POST['city'])));
            $postal = strip_tags(htmlspecialchars(trim($_POST['postal'])));
            $contact = strip_tags(htmlspecialchars(trim($_POST['contact'])));
            $phone = strip_tags(htmlspecialchars(trim($_POST['phone'])));
            $email = strip_tags(htmlspecialchars(trim($_POST['email'])));
            $password = strip_tags(htmlspecialchars(trim($_POST['password'])));
            $confirmPassword = strip_tags(htmlspecialchars(trim($_POST['confirmPassword'])));


            if (!$client) {
                $error['client'] = "Veuillez remplir le champ";
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
                $userModel->addUser($client, $address, $city, $postal, $contact, $phone, $email, $hash, 1, 2);
                addFlashMessage("Votre demande d'inscription sera pris en compte par notre service.");

                header('location:login');
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
            'error'=>$error
        ];
            $params['title'] =  "TerrAnanas - Inscription";
            $this->render($this->file, $this->page, $this->base, $params);
    }

    // Méthode pour réinitialiser le mot de passe de l'utilisateur
    public function resetPassword($userId, $newPassword)
    {
        // Valider les données d'entrée (par exemple, vérifier que l'ID de l'utilisateur existe réellement dans la base de données)

        // Générer un jeton de réinitialisation de mot de passe
        $resetToken = generateResetToken();
        $expiryDate = time() + (60 * 60);

        // Envoyer un e-mail à l'utilisateur avec le jeton de réinitialisation de mot de passe
        sendResetPasswordEmail($userId, $resetToken);

        // Enregistrer le jeton de réinitialisation de mot de passe et la date d'expiration dans la base de données
        saveResetToken($userId, $resetToken, $expiryDate);
    }

    // Méthode pour valider le jeton de réinitialisation de mot de passe et mettre à jour le mot de passe de l'utilisateur
    public function validateResetToken($userId, $resetToken, $newPassword)
    {
        // Récupérer le jeton de réinitialisation de mot de passe et la date d'expiration de la base de données
        $storedResetToken = getResetToken($userId);
        $storedExpiryDate = getResetTokenExpiryDate($userId);

        // Vérifier que le jeton de réinitialisation de mot de passe est valide et n'a pas expiré
        if ($resetToken == $storedResetToken && $expiryDate > time()) {
            // Mettre à jour le mot de passe de l'utilisateur
            updatePassword($userId, $newPassword);

            // Supprimer le jeton de réinitialisation de mot de passe de la base de données
            deleteResetToken($userId);

            return true;
        } else {
            return false;
        }
    }
}