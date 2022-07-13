<?php

class UniteModel extends AbstractModel
{

    function GetAllUnite(){
        $sql ="SELECT*
                FROM unite";

        return $this->db->getAllResults($sql);
    }
}