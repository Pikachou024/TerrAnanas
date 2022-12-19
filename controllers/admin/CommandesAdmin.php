<?php

class CommandesAdmin extends AbstractController
{
    function commandes(){
        $role = getUserRole();
//        if($role != "admin") {
//            http_response_code(403);
//            echo("Désolé la page n'existe pas");
//            exit;
//        }

        $statusModel = new statusModel();
        $statut = $statusModel->getAllstatus();

        $statutCommande = (!empty($_POST['statut'])) ? strip_tags(trim($_POST['statut'])) : 1;
        $params['statutCommande']=intval($statutCommande);
        $params['namestatut']= $statusModel->getNamestatus($statutCommande);

        $commandeModel = new CommandeModel();
        $commandes = $commandeModel -> getAllCommandes($statutCommande);

        if(!empty($_POST['searchDate'])){
            $date = strip_tags(trim($_POST['searchDate']));
            $commandes=$commandeModel->getCommandeByDate($date,$statutCommande);
            $params['date']=$date;
        }
        else{
            unset($_SESSION['commandeByDate']);
        }

        $params['view']=viewCommandes($commandes);
        $params['statut']=$statut;
        $params['commandes']=$commandes;
        $params['title']="Listes des commandes";

        if(!empty($_GET['ajax'])){
            echo json_encode($params['view']);
        }
        else{
            $this->render($this->file, $this->page, $this->base, $params);
        }
    }

    function commandeDetails(){
        $role = getUserRole();
//        if($role != "admin") {
//            http_response_code(403);
//            echo("Désolé la page n'existe pas");
//            exit;
//        }

        $idCommande = intval($_GET['id']);

        $statutModel = new statusModel();
        $statut = $statutModel->getAllStatus();

        $commandeModel = new CommandeModel();
        $commande = $commandeModel->getOneCommande($idCommande);
        $articlesCommande = $commandeModel -> getOneCommandeDetails($idCommande);

        $dateCommande = dateFr(date('D d M Y', strtotime($commande['date_commande'])));
        $dateLivraison = dateFr(date('D d M Y', strtotime($commande['date_livraison'])));

        $montantCommande = $articlesCommande[0]['montant'];

        $client = $commandeModel->getClientByIdCommande($idCommande);
        if(!empty($_POST)) {
            $idArticle =$_POST['id_article'];
            $prix = $_POST["prix"];
            $quantite = $_POST['quantite'];
            $statutCommande = strip_tags(trim($_POST['statut']));
            for($i=0 ; $i<(count($idArticle)) ; $i++){
                $commandeModel->editCommandeDetail($idCommande,$idArticle[$i],($prix[$i]*100),$quantite[$i]);
            }
            $newPriceArticles = $commandeModel -> getOneCommandeDetails($idCommande);
            $commandeModel->editMontantCommande(montantTotal($newPriceArticles),$idCommande);
            $commandeModel->validCommande($statutCommande,$idCommande);
            header('location:commandes_admin');
        }
        $params=[
            "idCommande"=>$idCommande,
            "commande"=>$commande,
            "statut"=>$statut,
            "articlesCommande"=>$articlesCommande,
            "dateCommande"=>$dateCommande,
            "dateLivraison"=>$dateLivraison,
            "montantCommande"=>$montantCommande,
            "client"=>$client,
            "title"=>"Admin - commande"
        ];

        $this->render($this->file, $this->page, $this->base, $params);
    }

    function deleteCommande(){
        $role = getUserRole();
//        if($role != "admin") {
//            http_response_code(403);
//            echo("Désolé la page n'existe pas");
//            exit;
//        }

        $idCommande = intval($_GET['id']);
        $commandeModel = new CommandeModel();
        $commandeModel->validCommande(4,$idCommande);

        header('location:commandes_admin');
    }
}