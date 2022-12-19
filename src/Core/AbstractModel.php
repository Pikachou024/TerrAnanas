<?php


//Création d'une classe abstract parente
abstract class AbstractModel{

    protected Database $db;

    function __construct(){
        $this -> db = new Database();
    }
}