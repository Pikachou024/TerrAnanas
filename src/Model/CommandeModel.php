<?php

class CommandeModel extends AbstractModel
{
    function addCommande($idUser,$montant,$dateLivraison,$statutCommande){
        $sql = " INSERT INTO commande(id_user,montant,date_commande,date_livraison,id_status)
                VALUES (?,?,NOW(),?,?)";

        return $this ->db->executeQuerry($sql,[$idUser,$montant,$dateLivraison,$statutCommande]);
    }

    function addDetailsCommande($idCommande,$idArticle,$prix,$quantite){
        $sql = " INSERT INTO detailscommande(id_commande,id_article,prix,quantite)
                VALUES (?,?,?,?)";

        return $this -> db-> executeQuerry($sql,[$idCommande,$idArticle,$prix,$quantite]);
    }

    function modifCommande($dateLivraison,$idClient,$idArticle,$quantité,$montant,$statutCommande){
//        TODO
    }

    function deleteCommande($dateCommande,$idClient){
//        TODO
    }

    function lastCommandeId($idUser){
        $sql = "SELECT max(id_commande) 
                FROM commande
                WHERE id_user = ?";

        return $this -> db -> getOneResult($sql,[$idUser]);
    }

    function getAllCommandes(){
        $sql = "SELECT * 
                FROM commande cmd
                INNER JOIN user us ON us.id_user = cmd.id_user 
                INNER JOIN status sta ON sta.id_status = cmd.id_status
                ORDER BY date_commande DESC ";

        return $this -> db -> getAllResults($sql);
    }

    function getOneCommandeDetails($idCommande){
        $sql="SELECT dcmd.*,cmd.*,art.id_article,art.label_article,art.poids,art.origine,unt.label_unite 
              FROM detailscommande dcmd
              INNER JOIN commande cmd ON cmd.id_commande = dcmd.id_commande
              INNER JOIN article art ON art.id_article = dcmd.id_article
              INNER JOIN unite unt ON unt.id_unite = art.id_unite
              WHERE dcmd.id_commande = ?";

        return $this->db->getAllResults($sql,[$idCommande]);
    }

    function addDiscount($remise,$montantRemise,$idCommande){
        $sql="UPDATE commande
                SET remise = ? , montant_remise = ?
                WHERE id_commande=?";

        return $this->db->executeQuerry($sql,[$remise,$montantRemise,$idCommande]);
    }

    function getClientByIdCommande($idCommande){
        $sql = "SELECT society,address,city,postal,contact,phone,email
                FROM commande cmd
                INNER JOIN user us ON us.id_user = cmd.id_user
                WHERE cmd.id_commande = ?";

        return $this->db->getOneResult($sql,[$idCommande]);
    }

    function getCommandeByDate($date){
    $sql="SELECT * 
          FROM commande cmd
          INNER JOIN user us ON us.id_user = cmd.id_user 
          INNER JOIN status sta ON sta.id_status = cmd.id_status
          WHERE date_commande = ?
          ORDER BY date_livraison ASC";

    return $this->db->getAllResults($sql,[$date]);
    }

}