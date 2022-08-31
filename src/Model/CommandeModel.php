<?php

class CommandeModel extends AbstractModel
{
    function addCommande($idUser,$montant,$dateLivraison,$statutCommande){
        $sql = " INSERT INTO commande(id_user,montant,date_commande,date_livraison,id_status)
                VALUES (?,?,NOW(),?,?)";

        return $this ->db->executeQuerry($sql,[$idUser,$montant,$dateLivraison,$statutCommande]);
    }

    function addDetailCommande($idCommande,$idArticle,$quantite){
        $sql = " INSERT INTO detailcommande(id_commande,id_article,quantite)
                VALUES (?,?,?)";

        return $this -> db-> executeQuerry($sql,[$idCommande,$idArticle,$quantite]);
    }

    function modifCommande($dateLivraison,$idClient,$idArticle,$quantité,$montant,$statutCommande){
//        TODO
    }

    function deleteCommande($dateCommande,$idClient){
//        TODO
    }

    function getCommandeId($idUser,$montant,$dateCommande){
//        $sql = "SELECT id_commande
//               FROM commande
//               WHERE id_user = ?
//               AND  montant = ?
//               AND  date_commande = ?";
//
//        return $this -> db ->executeQuerry($sql,[$idUser,$montant,$dateCommande]);
    }
    function lastCommandeId($idUser){
        $sql = "SELECT max(id_commande) 
                FROM commande
                WHERE id_user = ?";

        return $this -> db -> getOneResult($sql,[$idUser]);
    }

    function getAllCommandeByDate(){
//        TODO
    }

    function getAllCommandeByClient(){
//        TODO
    }

    function getOneCommandeByDate(){
//        TODO
    }

    function getOneCommandeByClient(){
//        TODO
    }

    function changeStatut($idCommande,$status){
//        TODO
    }


}