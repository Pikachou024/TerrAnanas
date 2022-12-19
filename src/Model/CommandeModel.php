<?php

class CommandeModel extends AbstractModel
{
    function addCommande($idUser,$montant,$dateLivraison,$statutCommande){
        $sql = " INSERT INTO commande(id_user,montant,date_commande,date_livraison,id_statut)
                VALUES (?,?,NOW(),?,?)";

        return $this ->db->executeQuerry($sql,[$idUser,$montant,$dateLivraison,$statutCommande]);
    }

    function addDetailsCommande($idCommande,$idArticle,$prix,$quantite){
        $sql = " INSERT INTO detailscommande(id_commande,id_article,prix,quantite)
                VALUES (?,?,?,?)";

        return $this -> db-> executeQuerry($sql,[$idCommande,$idArticle,$prix,$quantite]);
    }

    function archiveCommande($idCommande,$statutCommande){
        $sql = "UPDATE      commande
                SET         id_statut = ?
                where       id_commande = ?";

        return $this->db->executeQuerry($sql,[$idCommande]);
    }

    function lastCommandeId($idUser){
        $sql = "SELECT max(id_commande) 
                FROM commande
                WHERE id_user = ?";

        return $this -> db -> getOneResult($sql,[$idUser]);
    }

    function getAllCommandes($statut): bool|array
    {
        $sql = "SELECT * 
                FROM commande cmd
                INNER JOIN user us ON us.id_user = cmd.id_user 
                INNER JOIN statut sta ON sta.id_statut = cmd.id_statut
                WHERE cmd.id_statut = ? 
                ORDER BY date_commande ASC ";

        return $this -> db -> getAllResults($sql,[$statut]);
    }

    function getOneCommande($id): bool|array
    {
        $sql = "SELECT * 
                FROM commande cmd
                INNER JOIN user us ON us.id_user = cmd.id_user 
                INNER JOIN statut sta ON sta.id_statut = cmd.id_statut
                WHERE cmd.id_commande = ? 
                ORDER BY date_commande ASC ";

        return $this -> db -> getOneResult($sql,[$id]);
    }

    function getOneCommandeDetails($idCommande){
        $sql="SELECT dcmd.*,cmd.*,art.id_article,art.article,art.poids,art.origine,unt.unite 
              FROM detailscommande dcmd
              INNER JOIN commande cmd ON cmd.id_commande = dcmd.id_commande
              INNER JOIN article art ON art.id_article = dcmd.id_article
              INNER JOIN unite unt ON unt.id_unite = art.id_unite
              WHERE dcmd.id_commande = ?
              ORDER BY  article";

        return $this->db->getAllResults($sql,[$idCommande]);
    }

    function getClientByIdCommande($idCommande){
        $sql = "SELECT client,address,city,postal,contact,phone,email
                FROM commande cmd
                INNER JOIN user us ON us.id_user = cmd.id_user
                WHERE cmd.id_commande = ?
                ORDER BY client ASC";

        return $this->db->getOneResult($sql,[$idCommande]);
    }

    function getCommandeByClient($idUser,$idstatut): bool|array
    {
        $sql = "SELECT * 
                FROM commande cmd
                INNER JOIN user us ON us.id_user = cmd.id_user 
                INNER JOIN statut sta ON sta.id_statut = cmd.id_statut
                WHERE cmd.id_user = ? 
                AND sta.id_statut = ?
                ORDER BY date_commande ASC ";

        return $this->db->getAllResults($sql,[$idUser,$idstatut]);
    }

    function getCommandeByLivraison($idUser,$idstatut,$livraisonDuJour): bool|array
    {
        $sql = "SELECT *
                FROM commande cmd
                INNER JOIN user us ON us.id_user = cmd.id_user
                INNER JOIN statut sta ON sta.id_statut = cmd.id_statut
                WHERE cmd.id_user = ?
                AND sta.id_statut = ?
                AND date_livraison = ?
                ORDER BY date_commande ASC ";

        return $this->db->getAllResults($sql,[$idUser,$idstatut,$livraisonDuJour]);
    }

    function getCommandeByDate($date,$statut): bool|array
    {
        $sql="SELECT * 
              FROM commande cmd
              INNER JOIN user us ON us.id_user = cmd.id_user 
              INNER JOIN statut sta ON sta.id_statut = cmd.id_statut
              WHERE date_commande = ?
              AND cmd.id_statut = ?
              ORDER BY date_livraison ASC";

        return $this->db->getAllResults($sql,[$date,$statut]);
    }

    function editCommandeDetail($idCommande,$idArticle,$prix,$quantite){
        $sql = "UPDATE detailscommande 
                SET prix = ? , quantite = ?
                WHERE id_article = ?
                AND id_commande = ?";

        return $this->db->executeQuerry($sql,[$prix,$quantite,$idArticle,$idCommande]);
    }

    function validCommande($statut,$idCommande){
        $sql = "UPDATE commande 
                SET id_statut=?
                WHERE id_commande = ?";

        return $this->db->executeQuerry($sql,[$statut,$idCommande]);
    }

    function editMontantCommande(int $montantCommande, int $idCommande){
        $sql = "UPDATE commande 
                SET montant=?
                WHERE id_commande = ?";

        return $this->db->executeQuerry($sql,[$montantCommande,$idCommande]);
    }

}