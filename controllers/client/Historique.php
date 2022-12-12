<?php

class Historique extends AbstractController
{

    function commandes(){

        $idUser = getUserId();

        $statusModel = new StatusModel();
        $status = $statusModel->getAllStatus();
        $statusCommande = (!empty($_POST['status'])) ? strip_tags(trim($_POST['status'])) : 1;
        $commandeModel = new CommandeModel();
        $commandes = $commandeModel -> getCommandeByClient($idUser,$statusCommande);

        if(!empty($_POST['searchDate'])){
            $date = strip_tags(trim($_POST['searchDate']));
            $params['date']=$date;
            $dateTime = DateTime::createFromFormat('d/m/Y', $date);
            $newFormatDate = $dateTime->format('Y-m-d');
            $_SESSION['commandeByDate']= $commandeModel->getCommandeByDate($newFormatDate,$statusCommande);
        }
        else{
            unset($_SESSION['commandeByDate']);
        }

        $params['status']=$status;
        $params['commandes']=$commandes;
        $params['title']="TerrAnanas - Mes commandes";
        $this->render($this->file,$this->page,$this->base,$params);
    }

    function getOneCommande(){
        $idCommande = intval($_GET['id']);

        $statusModel = new StatusModel();
        $status = $statusModel->getAllStatus();

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
            $statusCommande = strip_tags(trim($_POST['status']));
            for($i=0 ; $i<(count($idArticle)) ; $i++){
                $commandeModel->editCommandeDetail($idCommande,$idArticle[$i],($prix[$i]*100),$quantite[$i]);
            }
            $newPriceArticles = $commandeModel -> getOneCommandeDetails($idCommande);
            $commandeModel->editMontantCommande(montantTotal($newPriceArticles),$idCommande);
            $commandeModel->validCommande($statusCommande,$idCommande);
            header('location:commandes_admin');
        }
        $params=[
            "idCommande"=>$idCommande,
            "commande"=>$commande,
            "status"=>$status,
            "articlesCommande"=>$articlesCommande,
            "dateCommande"=>$dateCommande,
            "dateLivraison"=>$dateLivraison,
            "montantCommande"=>$montantCommande,
            "client"=>$client,
            "title"=>"Admin - commande"
        ];
        $this->render($this->file, $this->page, $this->base, $params);
    }
}