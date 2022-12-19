<?php

class MessageModel extends AbstractModel
{
    function getAllMessages(){
        $sql="SELECT * 
              FROM message msg
              INNER JOIN user usr ON usr.id_user = msg.user";

        return $this->db->getAllResults($sql);
    }

    function getOneMessage($idMessage){
        $sql="SELECT * 
              FROM message msg
              INNER JOIN user usr ON usr.id_user = msg.user
              where id_message = ?";

        return $this->db->getOneResult($sql,[$idMessage]);
    }

    function sendMessage($email,$subject,$text,$statut,$idUser)
    {
        $sql = " INSERT INTO message(email,subject,text,date,id_statut,user)
                 VALUES (?,?,?,now(),?,?)";

        return $this->db->executeQuerry($sql,[$email,$subject,$text,$statut,$idUser]);
    }

    function deleteMessage($idMessage,$statut){
        $sql = "UPDATE message 
                SET id_statut=?
                WHERE id_message = ?";

        return $this->db->executeQuerry($sql,[$statut,$idMessage]);
    }
}