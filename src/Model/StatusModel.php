<?php

class StatusModel extends AbstractModel
{
    function getAllStatus(){
        $sql ="SELECT *
               FROM statut";

        return $this->db->getAllResults($sql);
    }

    function getNameStatus($idStatut){
        $sql ="SELECT *
               FROM statut
               WHERE id_statut = ?";

        return $this->db->getOneResult($sql,[$idStatut]);
    }

    function getAllStatusArticle(){
        $sql ="SELECT *
               FROM statutArticle";

        return $this->db->getAllResults($sql);
    }

}