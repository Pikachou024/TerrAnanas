<?php

class StatusUserModel extends AbstractModel
{
    function getAllStatusUser(){
        $sql ="SELECT *
               FROM statusUser";

        return $this->db->getAllResults($sql);
    }
}