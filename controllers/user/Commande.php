<?php

class Commande extends AbstractController
{

        function articles(){

            $role = getUserRole();
            if(!$role) {
                http_response_code(403);
                echo("accès refusé");
                exit;
            }

            $params=[];
            $articleModel = new ArticleModel();
            $articles = $articleModel->getAllArticles();
            $statusModel = new StatusModel();
            $statutArticle = $statusModel->getAllStatusArticle();

            if(!empty($_POST['articleSearch'])){
                $articleSearch = $_POST['articleSearch'];
                $params["articleSearch"]=$articleSearch;
                $_SESSION['articleSearch'] = searchArticle($articleSearch,$articles);

            }
            else {
                unset($_SESSION['articleSearch']);
            }

            $params["articles"]=$articles;
            $params['title']="TerrAnanas - Passer une commande";

            if(!empty($_GET['ajax'])){
                $this->render($this->file, 'liste_articles_client', '', $params);
//                echo json_encode($_SESSION['articleSearch']);

            }else{
                $this->render($this->file, $this->page, $this->base, $params);
            }

        }

    function addPanier(){

        $role = getUserRole();
        if(!$role) {
            http_response_code(403);
            echo("accès refusé");
            exit;
        }

        if(!empty($_POST)){

            $idArticle = array_map(function($value) {
                $value = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
                $value = strip_tags($value);
                return $value;
            }, $_POST['id_article']);

            $famille = array_map(function($value) {
                $value = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
                $value = strip_tags($value);
                return $value;
            }, $_POST['famille']);

            $unite = array_map(function($value) {
                $value = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
                $value = strip_tags($value);
                return $value;
            }, $_POST['unite']);

            $article = array_map(function($value) {
                $value = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
                $value = strip_tags($value);
                return $value;
            }, $_POST['article']);

            $origine = array_map(function($value) {
                $value = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
                $value = strip_tags($value);
                return $value;
            }, $_POST['origine']);

            $poids = array_map(function($value) {
                $value = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
                $value = strip_tags($value);
                return $value;
            }, $_POST['poids']);

            $prix = array_map(function($value) {
                $value = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
                $value = strip_tags($value);
                return $value;
            }, $_POST['prix']);

            $quantite = array_map(function($value) {
                if (!is_numeric($value)) {
                    addFlashMessage("Erreur : Veuillez rentrer un nombre",'error');
                    header("location:articles_client");
                    exit;
                }
                $value = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
                $value = strip_tags($value);
                return $value;
            }, $_POST['quantite']);

            for($i=0 ; $i<(count($article)) ; $i++){
                addArticle($idArticle[$i],$article[$i],$origine[$i],$poids[$i],$prix[$i],$quantite[$i],$famille[$i],$unite[$i]);
            }
            if(!empty($_SESSION['panier'])){
                addFlashMessage("Vos articles ont bien été ajouté dans votre panier");

//                echo json_encode(['message'=>"Vos articles ont bien été ajouté dans votre panier"]);
            }

        }
        header("location:articles_client");

    }

    function panier(){

        $role = getUserRole();
        if(!$role) {
            http_response_code(403);
            header("location:page_403");
            exit;
        }

        $params=[];
        $francoModel = new FrancoModel();
        $franco = $francoModel->getFranco(1);
        $franco = $franco['franco'];

        $params['franco'] = $franco;

        if(empty($_SESSION['panier'])){
            $params['message'] = "Votre panier ne contient actuellement aucun article.";
            $params['montantPanier']=0;
        }
        else{
            $params['articles']=$_SESSION['panier'];
            $params['montantPanier'] = montantTotal($_SESSION['panier']);
        }

        $date = new DateTimeImmutable();
//        $dateLivraison = dateFr($date->format('D d M Y'));
        $dateLivraison1 = addDayDate(2);
        $dateLivraison2 = addDayDate(3);
        $params['date']=$date;
        $params['dateLivraison1']=$dateLivraison1;
        $params['dateLivraison2']=$dateLivraison2;
        $params['title']="TerrAnanas - Votre panier";
        $this->render($this->file, $this->page, $this->base, $params);
    }

    function validationCommande(){

        $role = getUserRole();
        if(!$role) {
            http_response_code(403);
            header("location:page_403");
            exit;
        }

        $commandeModel = new CommandeModel();
        $francoModel = new FrancoModel();
        $franco = $francoModel->getFranco(1);
        $franco = $franco['franco'];

        /**
         * On récupère l'id de l'utilisateur connecté
         */
        $idUser = getUserId();

        /**
         * On vérifie que le panier n'est pas vide
         * sinon on redirige le client vers panier
         */
        if(empty($_SESSION['panier'])){
            header('location: panier');
            exit;
        }



        /**
         * Validation de la commande
         */
        if(!empty($_POST)){
            $dateLivraison = strip_tags(trim($_POST['dateLivraison']));

            $idArticle = array_map(function($value) {
                $value = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
                $value = strip_tags($value);
                return $value;
            }, $_POST['id_article']);

            $quantite = array_map(function($value) {
                if (!is_numeric($value)) {
                    addFlashMessage("Erreur : Veuillez rentrer un nombre",'error');
                    header("location:panier");
                    exit;
                }
                $value = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
                $value = strip_tags($value);
                return $value;
            }, $_POST['quantite']);

            for($i=0 ; $i<(count($_SESSION['panier'])) ; $i++) {
                modifierQTeArticle($idArticle[$i], $quantite[$i]);
            }


            /**
             * On redirige sur la page "panier" si le montant du panier n'atteint pas le franco
             */
            if(montantTotal($_SESSION['panier']) < $franco){
                addFlashMessage("Le montant du panier doit être supérieur à ".$franco."€",'error');
                header('location:panier');
                exit;
            }

            $montant = montantTotal($_SESSION['panier'])*100;

            /**
             * Parametre statut :
             * 1) En attente
             * 2) Validée
             * 3) Refusée
             */
            $idStatus = 1;

            /**
             * J'initialise un id pour ma table commande
             * Je vérifie que l'id est unique sinon je change l'id en ajoutant +1
             */
            $idCommande=1;
            $arrayId =  $commandeModel -> getAllIdCommande();
            $id_commandes = array_column($arrayId, "id_commande");
            while (in_array($idCommande, $id_commandes)) {
                $idCommande++;
            }

            /**
             * Ajout en BDD dans 2 tables : commande et detailsCommande
             */
            $commandeModel -> addCommande($idCommande,$idUser,$montant,$dateLivraison,$idStatus);
            for($i=0 ; $i < count($_SESSION['panier'])  ; $i++ ){
                $commandeModel->addDetailsCommande(
                    $idCommande,$_SESSION['panier'][$i]['id_article'],($_SESSION['panier'][$i]['prix'])*100,$_SESSION['panier'][$i]['quantite']
                );
            }
            addFlashMessage("Votre commande sera pris en charge par notre service");
            unset($_SESSION['panier']);

        }
        header('location: articles_client');
        exit;
    }

}