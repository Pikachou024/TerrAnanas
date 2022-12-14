<?php

class ArticleModel extends AbstractModel
{
    function getAllArticles(){
        $sql = "SELECT      *
                FROM        article art
                INNER JOIN  famille fam ON fam.id_famille = art.id_famille
                INNER JOIN  unite uni ON uni.id_unite = art.id_unite
                ORDER BY    label_article";

        return $this-> db -> getAllResults($sql);
    }

    function getOneArticle($id){
        $sql = "SELECT      *
                FROM        article art
                INNER JOIN  famille fam ON fam.id_famille = art.id_famille
                INNER JOIN  unite uni ON uni.id_unite = art.id_unite
                WHERE   id_article = ?";

        return $this-> db -> getOneResult($sql,[$id]);
    }

    function addArticle($label,$poids,$unite,$prix,$origine,$famille,$etat){
        $sql ="INSERT INTO article(label_article,poids,id_unite,prix,origine,id_famille,etat)
               VALUES (?,?,?,?,?,?,?)";

        return $this-> db ->executeQuerry($sql,[$label,$poids,$unite,$prix,$origine,$famille,$etat]);
    }

    function editArticle($label,$poids,$unite,$prix,$origine,$famille,$etat,$id){
        $sql = "UPDATE      article
                SET         label_article = ? , poids = ? ,id_unite = ?, prix = ? , origine = ? , id_famille = ? , etat = ?
                where       id_article = ?";

        return $this->db->executeQuerry($sql,[$label,$poids,$unite,$prix,$origine,$famille,$etat,$id]);
    }

    function deleteArticle($id){
        $sql = "DELETE FROM article
                WHERE id_article = ?";

        return $this->db->executeQuerry($sql,[$id]);
    }
}