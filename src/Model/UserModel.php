<?php

class UserModel extends AbstractModel
{
//    Afficher tous les clients
    function getAllUsers(){
        $sql="SELECT *
              FROM      user usr
              INNER JOIN statusUser susr on susr.id_statusUser = usr.id_statusUser
              ORDER BY  society";

        return $this-> db -> getAllResults($sql);
    }

//    Afficher un client
    function getOneUser($id){
        $sql = "SELECT * 
                FROM    user usr
                INNER JOIN statusUser susr on susr.id_statusUser = usr.id_statusUser;
                WHERE id_user = ?";

        return $this -> db ->getOneResult($sql,[$id]);
    }

//    Ajouter un client
    function addUser($society,$address,$city,$postal,$contact,$phone,$email,$hash,$status){
        $sql ="INSERT INTO user(society,address,city,postal,contact,phone,email,hash,id_statusUser)
               VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $this -> db ->executeQuerry($sql,[$society,$address,$city,$postal,$contact,$phone,$email,$hash,$status]);

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

        return $this->db->executeQuerry($sql,[$id]);
    }

    function getUserByEmail($email){
        $sql = "SELECT * 
                FROM user 
                WHERE email=?";

        return $this->db -> getOneResult($sql,[$email]);
    }

}