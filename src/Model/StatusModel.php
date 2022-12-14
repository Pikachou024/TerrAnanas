<?php

class StatusModel extends AbstractModel
{
    function getAllStatus(){
        $sql ="SELECT *
               FROM status";

        return $this->db->getAllResults($sql);
    }

    function getNameStatus($idStatus){
        $sql ="SELECT *
               FROM status
               WHERE id_status = ?";

        return $this->db->getOneResult($sql,[$idStatus]);
    }

}