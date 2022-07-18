<?php

if(!isset($_SESSION['panier']) || empty($_SESSION['panier'])){
    $message = "Le panier est vide";

}
else{
    $articles=$_SESSION['panier'];
    dump($articles);
}

include ('../templates/panier.phtml');