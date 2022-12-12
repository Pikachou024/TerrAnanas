<?php

class Commande extends AbstractController
{
    function articles(){
        $params=[];
        $articleModel = new ArticleModel();
        $articles = $articleModel->getAllArticles();

        if(!empty($_GET['articleSearch'])){
            $articleSearch = $_GET['articleSearch'];
            $params["articleSearch"]=$articleSearch;
            $_SESSION['articleSearch'] = searchArticle($articleSearch,$articles);
        }
        else {
            unset($_SESSION['articleSearch']);
        }

        if(!empty($_POST)){

            $idArticle =array_map('strip_tags',$_POST['id_article']);
            $famille =$_POST['label_famille'];
            $unite =$_POST['label_unite'];
            $label =$_POST['label_article'];
            $origine =$_POST['origine'];
            $poids =$_POST['poids'];
            $prix = $_POST["prix"];
            $quantite = $_POST['quantite'];

            for($i=0 ; $i<(count($articles)) ; $i++){
                addArticle($idArticle[$i],$label[$i],$origine[$i],$poids[$i],$prix[$i],$quantite[$i],$famille[$i],$unite[$i]);
            }
            header("location:articles_client");
        }
        $params["articles"]=$articles;
        $params['title']="TerrAnanas - Passer une commande";
        $this->render($this->file, $this->page, $this->base, $params);
    }

    function panier(){
//        unset($_SESSION['panier']);

        $params=[];
        if(empty($_SESSION['panier'])){
            $params['message'] = "Votre panier ne contient actuellement aucun article.";
        }
        else{
            $params['articles']=$_SESSION['panier'];
        }

        $date = new DateTimeImmutable();
        $dateLivraison = dateFr($date->format('D d M Y'));
        $dateLivraison1 = addDayDate(1);
        $dateLivraison2 = addDayDate(2);
        $params['date']=$date;
        $params['dateLivraison1']=$dateLivraison1;
        $params['dateLivraison2']=$dateLivraison2;
        $params['title']="TerrAnanas - Votre panier";

        $this->render($this->file, $this->page, $this->base, $params);
    }

    function validationCommande(){
        $commandeModel = new CommandeModel();
        $francoModel = new FrancoModel();
        $franco = $francoModel->getFranco(1);

        /**
         * On vérifie qu'un utilisateur est bien connecté pour valider le panier
         * sinon on le redirige vers login
         * TODO verifie si l'utilisateur connecté a bien le bon role
         */
        $idUser = getUserId();
        if(!$idUser){
            header('location: login');
        }

        /**
         * On vérifie que le panier n'est pas vide
         * sinon on redirige le client vers panier
         */
        if(empty($_SESSION['panier'])){
            header('location: panier');
            exit;
        }

        /**
         * On redirige sur la page "panier" si le montant du panier n'atteint pas le franco
         * TODO afficher un message pour prevenir que le montant n'atteint pas le franco
         */
        if(montantTotal($_SESSION['panier']) > $franco){
            $_SESSION['franco']="Le montant du panier doit être supérieur à ".$franco;
            header('location:panier');
            exit;
        }

        /**
         * Validation de la commande
         */
        if(!empty($_POST)){
            $dateLivraison = strip_tags(trim($_POST['dateLivraison']));
            $idArticle = $_POST['id_article'];
            $quantite = $_POST['quantite' ];

            for($i=0 ; $i<(count($_SESSION['panier'])) ; $i++) {
                modifierQTeArticle($idArticle[$i], $quantite[$i]);
            }
            $montant = montantTotal($_SESSION['panier'])*100;

            /**
             * Parametre status :
             * 1) En attente
             * 2) Validée
             * 3) Refusée
             */
            $idStatus = 1;

            /**
             * Ajout en BDD dans 2 tables : commande et detailsCommande
             *
             */
            $commandeModel -> addCommande($idUser,$montant,$dateLivraison,$idStatus);
            $idCommande = $commandeModel->lastCommandeId($idUser);
            for($i=0 ; $i < count($_SESSION['panier'])  ; $i++ ){
                $commandeModel->addDetailsCommande($idCommande["max(id_commande)"],$_SESSION['panier'][$i]['id_article'],(float)($_SESSION['panier'][$i]['prix'])*100,$_SESSION['panier'][$i]['quantite']);
            }

            //    TODO s'il n'y a pas d'érreur, on vide le panier'
            unset($_SESSION['panier']);

        }
        header('location: articles_client');
        exit;
    }

}