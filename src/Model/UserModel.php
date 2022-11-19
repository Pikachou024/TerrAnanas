<?php

class UserModel extends AbstractModel
{
//    Afficher tous les clients
    function getAllUsers($idStatus){
        $sql="SELECT *
              FROM      user usr
              INNER JOIN status sta on sta.id_status = usr.id_status
              INNER JOIN role rol on rol.id_role = usr.id_role
              WHERE sta.id_status = ?
              ORDER BY  society";

        return $this-> db -> getAllResults($sql,[$idStatus]);
    }

//    Afficher un client
    function getOneUser($id){
        $sql = "SELECT * 
                FROM    user usr
                INNER JOIN status sta on sta.id_status = usr.id_status
                INNER JOIN role rol on rol.id_role = usr.id_role
                WHERE id_user = ?";

        return $this -> db ->getOneResult($sql,[$id]);
    }

//    Ajouter un client
    function addUser($society,$address,$city,$postal,$contact,$phone,$email,$hash,$status,$role){
        $sql ="INSERT INTO user(society,address,city,postal,contact,phone,email,hash,id_status,id_role)
               VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $this -> db ->executeQuerry($sql,[$society,$address,$city,$postal,$contact,$phone,$email,$hash,$status,$role]);

    }

    function editUser($society,$address,$city,$postal,$contact,$phone,$email,$status,$id){
        $sql= " UPDATE      user
                SET         society=? , address=? , city=? , postal=? , contact=? , phone=? , email=? , id_status= ?
                WHERE       id_user=?";

        return $this -> db ->executeQuerry($sql,[$society,$address,$city,$postal,$contact,$phone,$email,$status,$id]);
    }

    function deleteUser($id){
        $sql="DELETE FROM user
              WHERE id_user=?";

        return $this-> db->executeQuerry($sql,[$id]);
    }

    function getUserByEmail($email){
        $sql = "SELECT * 
                FROM user usr
                INNER JOIN status sta on sta.id_status = usr.id_status
                INNER JOIN role rol on rol.id_role = usr.id_role
                WHERE email=?";

        return $this-> db -> getOneResult($sql,[$email]);
    }

    function searchUser($user){
        $sql = "SELECT * 
                FROM    user usr
                INNER JOIN status sta on sta.id_status = usr.id_status
                INNER JOIN role rol on rol.id_role = usr.id_role
                WHERE society = ?";

        return $this->db-> getAllResults($sql,[$user]);
    }

}