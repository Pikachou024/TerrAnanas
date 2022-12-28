<?php

$routes=[
    /*
     * Utilisateur sans être inscrit ( l'admin et les utilisateurs inscrits pourront parcourir ses pages)
     */
    "home"=>[
        "controller"=>"Home",
        "action"=>"index",
        'path'=>"utilisateur",
        "base_template"=>"base"
    ],
    "saisons"=>[
        "controller"=>"Saisons",
        "action"=>"saisons",
        'path'=>"utilisateur",
        "base_template"=>"base"
    ],
    "contact"=>[
        "controller"=>"Contact",
        "action"=>"contact",
        'path'=>"utilisateur",
        "base_template"=>"base"
    ],

    "signup"=>[
        "controller"=>"Connexion",
        "action"=>"signup",
        'path'=>"utilisateur",
        "base_template"=>"base"
    ],
    "login"=>[
        "controller"=>"Connexion",
        "action"=>"login",
        'path'=>"utilisateur",
        "base_template"=>"base"
    ],


    "logout"=>[
        "controller"=>"Connexion",
        "action"=>"logout",
        'path'=>"utilisateur",
        "base_template"=>"base"
    ],

    /*
     * Clients (utilisateur inscrits et validés par l'admin)
     */
    "client"=>[
        "controller"=>"Client",
        "action"=>"index",
        'path'=>"client",
        "base_template"=>"base_client"
    ],


    "articles_client"=>[
        "controller"=>"Commande",
        "action"=>"articles",
        'path'=>"client",
        "base_template"=>"base_client"
    ],
    "add_panier"=>[
        "controller"=>"Commande",
        "action"=>"addPanier",
        'path'=>"client",
        "base_template"=>""
    ],
    "panier"=>[
        "controller"=>"Commande",
        "action"=>"panier",
        'path'=>"client",
        "base_template"=>"base_client"
    ],
    "validation_commande"=>[
        "controller"=>"Commande",
        "action"=>"validationCommande",
        'path'=>"client",
        "base_template"=>"base_client"
    ],

    "historique_commandes"=>[
        "controller"=>"Historique",
        "action"=>"commandes",
        'path'=>"client",
        "base_template"=>"base_client"
    ],
    "one_commande"=>[
        "controller"=>"Historique",
        "action"=>"getOneCommande",
        'path'=>"client",
        "base_template"=>"base_client"
    ],
    "parametre_client"=>[
        "controller"=>"Client",
        "action"=>"parametre",
        'path'=>"client",
        "base_template"=>"base_client"
    ],

    /*
     * Admin
     */
    "admin"=>[
        "controller"=>"Admin",
        "action"=>"index",
        'path'=>"admin",
        "base_template"=>"base_admin"
    ],
    "parametre_admin" =>[
        "controller"=>"Admin",
        "action"=>"parametre",
        'path'=>"admin",
        "base_template"=>"base_admin"
    ],
    "articles_admin" =>[
        "controller"=>"ArticleAdmin",
        "action"=>"index",
        'path'=>"admin",
        "base_template"=>"base_admin"
    ],

    "add_article" =>[
        "controller"=>"ArticleAdmin",
        "action"=>"addArticle",
        'path'=>"admin",
        "base_template"=>"base_admin"
    ],

    "edit_article" =>[
        "controller"=>"ArticleAdmin",
        "action"=>"editArticle",
        'path'=>"admin",
        "base_template"=>"base_admin"
    ],
    "delete_article" =>[
        "controller"=>"ArticleAdmin",
        "action"=>"deleteArticle",
        'path'=>"admin",
        "base_template"=>"base_admin"
    ],
    "users_admin" =>[
        "controller"=>"UsersAdmin",
        "action"=>"users",
        'path'=>"admin",
        "base_template"=>"base_admin"
    ],
    "edit_user" =>[
        "controller"=>"UsersAdmin",
        "action"=>"editUser",
        'path'=>"admin",
        "base_template"=>"base_admin"
    ],
    "delete_user" =>[
        "controller"=>"UserAdmin",
        "action"=>"deleteUser",
        'path'=>"admin",
        "base_template"=>"base_admin"
    ],
    "commandes_admin" =>[
        "controller"=>"CommandesAdmin",
        "action"=>"commandes",
        'path'=>"admin",
        "base_template"=>"base_admin"
    ],
    "commande_details" =>[
        "controller"=>"CommandesAdmin",
        "action"=>"commandeDetails",
        'path'=>"admin",
        "base_template"=>"base_admin"
    ],
    "edit_commande" =>[
        "controller"=>"CommandeAdmin",
        "action"=>"editCommande",
        'path'=>"admin",
        "base_template"=>"base_admin"
    ],
    "delete_commande" =>[
        "controller"=>"CommandesAdmin",
        "action"=>"deleteCommande",
        'path'=>"admin",
        "base_template"=>"base_admin"
    ],
    "messages"=>[
        "controller"=>"MessageAdmin",
        "action"=>"messages",
        'path'=>"admin",
        "base_template"=>"base_admin"
    ],
    "message_details"=>[
        "controller"=>"MessageAdmin",
        "action"=>"messageDetails",
        'path'=>"admin",
        "base_template"=>"base_admin"
    ],
    "delete_message"=>[
        "controller"=>"MessageAdmin",
        "action"=>"deleteMessage",
        'path'=>"admin",
        "base_template"=>"base_admin"
    ]
];
return $routes ;


