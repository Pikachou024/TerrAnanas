<?php

class UserModel extends AbstractModel
{
    function Users(){
        $sql="SELECT *
              FROM      user usr
              INNER JOIN statut sta on sta.id_statut = usr.id_statut
              INNER JOIN role rol on rol.id_role = usr.id_role
              ORDER BY  client";

        return $this-> db -> getAllResults($sql);
    }

//    Afficher tous les clients
    function getAllUsers($idstatut){
        $sql="SELECT *
              FROM      user usr
              INNER JOIN statut sta on sta.id_statut = usr.id_statut
              INNER JOIN role rol on rol.id_role = usr.id_role
              WHERE sta.id_statut = ?
              ORDER BY  client";

        return $this-> db -> getAllResults($sql,[$idstatut]);
    }

//    Afficher un client
    function getOneUser($id){
        $sql = "SELECT * 
                FROM    user usr
                INNER JOIN statut sta on sta.id_statut = usr.id_statut
                INNER JOIN role rol on rol.id_role = usr.id_role
                WHERE id_user = ?";

        return $this -> db ->getOneResult($sql,[$id]);
    }

//    Ajouter un client
    function addUser($client,$address,$city,$postal,$contact,$phone,$email,$hash,$statut,$role){
        $sql ="INSERT INTO user(client,address,city,postal,contact,phone,email,hash,id_statut,id_role)
               VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $this -> db ->executeQuerry($sql,[$client,$address,$city,$postal,$contact,$phone,$email,$hash,$statut,$role]);

    }

    function editUser($client,$address,$city,$postal,$contact,$phone,$email,$statut,$id){
        $sql= " UPDATE      user
                SET         client=? , address=? , city=? , postal=? , contact=? , phone=? , email=? , id_statut= ?
                WHERE       id_user=?";

        return $this -> db ->executeQuerry($sql,[$client,$address,$city,$postal,$contact,$phone,$email,$statut,$id]);
    }

    function deleteUser($id){
        $sql="DELETE FROM user
              WHERE id_user=?";

        return $this-> db->executeQuerry($sql,[$id]);
    }

    function getUserByEmail($email){
        $sql = "SELECT * 
                FROM user usr
                INNER JOIN statut sta on sta.id_statut = usr.id_statut
                INNER JOIN role rol on rol.id_role = usr.id_role
                WHERE email=?";

        return $this-> db -> getOneResult($sql,[$email]);
    }

    function searchUser($user){
        $sql = "SELECT * 
                FROM    user usr
                INNER JOIN statut sta on sta.id_statut = usr.id_statut
                INNER JOIN role rol on rol.id_role = usr.id_role
                WHERE client = ?";

        return $this->db-> getAllResults($sql,[$user]);
    }

}