<?php

class StatusModel extends AbstractModel
{
    function getAllStatus(){
        $sql ="SELECT *
               FROM status";

        return $this->db->getAllResults($sql);
    }

}