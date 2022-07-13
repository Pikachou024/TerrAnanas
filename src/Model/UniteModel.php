<?php

class UniteModel extends AbstractModel
{
    function getAllUnite(){
        $sql ="SELECT *
               FROM unite";

        return $this->db->getAllResults($sql);
    }
}