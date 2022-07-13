<?php

class ArticleModel extends AbstractModel
{
    function getAllArticles(){
        $sql = "SELECT      *
                FROM        article art
                INNER JOIN  famille fam ON fam.id_famille = art.id_famille
                INNER JOIN  unite uni ON uni.id_unite = art.id_unite
                INNER JOIN  statusArticle sart ON sart.id_statusArticle = art.id_statusArticle; 
                ORDER BY    label";

        return $this-> db -> getAllResults($sql);
    }

    function getOneArticle($id){
        $sql = "SELECT      *
                FROM        article
                INNER JOIN  famille fam ON fam.id_famille = art.id_famille
                INNER JOIN  unite uni ON uni.id_unite = art.id_unite
                INNER JOIN  statusArticle sart ON sart.id_statusArticle = art.id_statusArticle
                WHERE   id_article = ?";

        return $this-> db -> getOneResult($sql,[$id]);
    }

    function addArticle($label,$quantite,$unite,$prix,$origine,$famille,$status){
        $sql ="INSERT INTO article(label_article,quantite,unite,prix,origine,id_famille,id_status)
               VALUES (?,?,?,?,?)";

        return $this-> db ->executeQuerry($sql,[$label,$quantite,$unite,$prix,$origine,$famille,$status]);
    }

    function editArticle($label,$quantite,$prix,$origine,$famille,$id){
        $sql = "UPDATE      article
                SET         label = ? , quantite = ? , prix = ? , origine = ? , famille = ? 
                where       id_article = ?;";

        return $this->db->executeQuerry($sql,[$label,$quantite,$prix,$origine,$famille,$id]);
    }

    function deleteArticle($id){
        $sql = "DELETE FROM article
                WHERE id_article = ?";

        return $this->db->executeQuerry($sql,[$id]);
}
}