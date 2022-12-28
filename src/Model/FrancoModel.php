<?php

class FrancoModel extends AbstractModel
{
    function getFranco()
    {
        $sql = "SELECT franco
                FROM franco";

        return $this->db->getAllResults($sql);
    }

    function editFranco($franco,$id){
        $sql= " UPDATE      franco
                SET         franco = ?
                WHERE       id_franco=?";

        return $this -> db ->executeQuerry($sql,[$franco,$id]);
    }
}