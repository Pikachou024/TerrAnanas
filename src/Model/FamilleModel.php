<?php

class FamilleModel extends AbstractModel
{
    function getAllFamille(){
        $sql ="SELECT *
               FROM famille";

        return $this -> db ->getAllResults($sql);
    }
}