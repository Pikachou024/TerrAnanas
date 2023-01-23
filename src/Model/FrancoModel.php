<?php

class FrancoModel extends AbstractModel
{
    function getFranco($id)
    {
        $sql = "SELECT franco
                FROM franco
                WHERE id_franco = ?";

        return $this->db->getOneResult($sql,[$id]);
    }

    function editFranco($franco,$id){
        $sql= " UPDATE      franco
                SET         franco = ?
                WHERE       id_franco=?";

        return $this -> db ->executeQuerry($sql,[$franco,$id]);
    }
}