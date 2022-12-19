<?php

class Database{

    static private ?PDO $pdo = null;

    function __construct(){
        if(self::$pdo == null){
            self::$pdo = $this -> getPdoConnection();
        }
    }

    /*
     * Connexion PDO à la base de données
     */
    function getPdoConnection(){

        $dsn = 'mysql:host='.DB_HOST.';dbname='.DB_NAME.';charset=utf8';
        $username = DB_USER;
        $password = DB_PASS;
        $option = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC];
        $pdo = new PDO($dsn,$username,$password,$option);
        return $pdo;
    }

//    Préparation et éxécution d'une requête SQL
    function executeQuerry(string $sql,array $params=[]){

        $pdoStatement = self::$pdo->prepare($sql);
        $pdoStatement->execute($params);
        return $pdoStatement;
    }
//    Récupération de plusieurs résultats
    function getAllResults(string $sql,array $params=[]){

        $pdoStatement=$this -> executeQuerry($sql,$params);
        return $pdoStatement-> fetchAll();
    }
//    Récupération d'un résultat
    function getOneResult(string $sql,array $params=[]){

        $pdoStatement=$this -> executeQuerry($sql,$params);
        return $pdoStatement->fetch();
    }



};