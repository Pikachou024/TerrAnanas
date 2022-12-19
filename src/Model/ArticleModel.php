<?php

class ArticleModel extends AbstractModel
{
    function getAllArticles(){
        $sql = "SELECT      *
                FROM        article art
                INNER JOIN  famille fam ON fam.id_famille = art.id_famille
                INNER JOIN  unite uni ON uni.id_unite = art.id_unite
                INNER JOIN  statutArticle sta ON sta.id_statutArticle = art.id_statutArticle
                ORDER BY    article";

        return $this-> db -> getAllResults($sql);
    }

    function getOneArticle($id){
        $sql = "SELECT      *
                FROM        article art
                INNER JOIN  famille fam ON fam.id_famille = art.id_famille
                INNER JOIN  unite uni ON uni.id_unite = art.id_unite
                INNER JOIN  statutArticle sta ON sta.id_statutArticle = art.id_statutArticle
                WHERE   id_article = ?";

        return $this-> db -> getOneResult($sql,[$id]);
    }


    function addArticle($label,$poids,$unite,$prix,$origine,$famille,$statusArticle){
        $sql ="INSERT INTO article(article,poids,id_unite,prix,origine,id_famille,id_statutArticle)
               VALUES (?,?,?,?,?,?,?)";

        return $this-> db ->executeQuerry($sql,[$label,$poids,$unite,$prix,$origine,$famille,$statusArticle]);
    }

    function editArticle($label,$poids,$unite,$prix,$origine,$famille,$statutArticle,$id){
        $sql = "UPDATE      article
                SET         article = ? , poids = ? ,id_unite = ?, prix = ? , origine = ? , id_famille = ? , id_statutArticle = ?
                where       id_article = ?";

        return $this->db->executeQuerry($sql,[$label,$poids,$unite,$prix,$origine,$famille,$statutArticle,$id]);
    }

    function archiveArticle($id,$statusArticle){
        $sql = "UPDATE      article
                SET         id_statutArticle = ?
                where       id_article = ?";

        return $this->db->executeQuerry($sql,[$id,$statusArticle]);
    }

//
//    function deleteArticle($id){
//        $sql="DELETE FROM article
//              WHERE id_article=?";
//
//        return $this-> db->executeQuerry($sql,[$id]);
//    }


}