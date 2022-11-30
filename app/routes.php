<?php

$routes=[
    /*
     * Utilisateur sans être inscrit ( l'admin et les utilisateurs inscrits pourront parcourir ses pages)
     */
    ["home"=>"home.php",'path'=>"utilisateur"],
    ["qui_sommes_nous"=>"qui_sommes_nous.php","path"=>"utilisateur"],
    ["nos_valeurs"=>"nos_valeurs.php","path"=>"utilisateur"],
    ["contact"=>"contact.php","path"=>"utilisateur"],
    ["login" => "login.php","path"=>"utilisateur"],
    ["inscription"=>"inscription.php","path"=>"utilisateur"],
    ["logout"=>"logout.php","path"=>"utilisateur"],

    /*
     * Clients (utilisateur inscrits et validés par l'admin)
     */
    ["articles_client"=>"articles_client.php","path"=>"client"],
    ["commande_client"=>"commande_client.php","path"=>"client"],
    ["client"=>"client.php","path"=>"client"],
    ["commande"=> "commande.php","path"=>"client"],
    ["panier" => "panier.php","path"=>"client"],
    ["parametre_client"=>"parametre_client.php","path"=>"client"],

    /*
     * Admin
     */
    ["articles_admin" => "articles_admin.php","path"=>"admin"],
    ["users_admin" => "users_admin.php","path"=>"admin"],
    ["admin"=>"admin.php","path"=>"admin"],
    ["add_article" => "add_article.php","path"=>"admin"],
    ["edit_article"=>"edit_article.php","path"=>"admin"],
    ["delete_article"=>"delete_article.php","path"=>"admin"],
    ["edit_user" => "edit_user.php","path"=>"admin"],
    ["delete_user" =>"delete_user.php","path"=>"admin"],
    ["commande_admin"=>"commande_admin.php","path"=>"admin"],
    ["commande_details"=>"commande_details.php","path"=>"admin"],
    ["delete_discount"=>"delete_discount.php","path"=>"admin"],
    ["edit_commande"=>"edit_commande.php","path"=>"admin"],
    ["add_remise"=>"add_remise.php","path"=>"admin"],
    ["nos_fruits"=>"nos_fruits.php","path"=>"admin"],
    ["validation_commande"=>"validation_commande.php","path"=>"admin"],
    ["parametre_admin"=>"parametre_admin.php","path"=>"admin"]
];
return $routes ;