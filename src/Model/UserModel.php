<?php

class UserModel extends AbstractModel
{
//    Afficher tous les clients
    function getAllUsers(){
        $sql="SELECT *
              FROM      user
              ORDER BY  society";

        return $this-> db -> getAllResults($sql);
    }

//    Afficher un client
    function getOneUser($id){
        $sql = "SELECT * 
                FROM    user
                WHERE id_user = ?";

        return $this -> db ->getOneResult($sql,[$id]);
    }

//    Ajouter un client
    function addUser($society,$address,$city,$postal,$contact,$phone,$email,$hash){
        $sql ="INSERT INTO user(society,address,city,postal,contact,phone,email,hash)
               VALUES (?, ?, ?, ?, ?, ?, ?,?)";

        $this -> db ->executeQuerry($sql,[$society,$address,$city,$postal,$contact,$phone,$email,$hash]);

    }

    function editUser($society,$address,$city,$postal,$contact,$phone,$email,$id){
        $sql= " UPDATE      user
                SET         society=? , address=? , city=? , postal=? , contact=? , phone=? , email=?
                WHERE       id_user=?";

        return $this -> db ->executeQuerry($sql,[$society,$address,$city,$postal,$contact,$phone,$email,$id]);
    }

    function deleteUser($id){
        $sql="DELETE FROM user
              WHERE id_user=?";

        return $this->db->executeQuerry($sql,[$id]);
    }


}