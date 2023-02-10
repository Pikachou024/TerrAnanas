<?php

$routes=[

    "home"=>[
        "controller"=>"Home",
        "action"=>"index",
        'path'=>"user",
        "base_template"=>"base"
    ],
    "saisons"=>[
        "controller"=>"Saisons",
        "action"=>"index",
        'path'=>"user",
        "base_template"=>"base"
    ],
    "recettes"=>[
        "controller"=>"Recettes",
        "action"=>"index",
        'path'=>"user",
        "base_template"=>"base"
    ],
    "contact"=>[
        "controller"=>"Contact",
        "action"=>"contact",
        'path'=>"user",
        "base_template"=>"base"
    ],
    "signup"=>[
        "controller"=>"Connexion",
        "action"=>"signup",
        'path'=>"user",
        "base_template"=>"base"
    ],
    "login"=>[
        "controller"=>"Connexion",
        "action"=>"login",
        'path'=>"user",
        "base_template"=>"base"
    ],

    "logout"=>[
        "controller"=>"Connexion",
        "action"=>"logout",
        'path'=>"user",
        "base_template"=>"base"
    ],
    "client"=>[
        "controller"=>"Client",
        "action"=>"index",
        'path'=>"user",
        "base_template"=>"base"
    ],

    "articles_client"=>[
        "controller"=>"Commande",
        "action"=>"articles",
        'path'=>"user",
        "base_template"=>"base"
    ],
    "add_panier"=>[
        "controller"=>"Commande",
        "action"=>"addPanier",
        'path'=>"user",
        "base_template"=>""
    ],
    "panier"=>[
        "controller"=>"Commande",
        "action"=>"panier",
        'path'=>"user",
        "base_template"=>"base"
    ],
    "validation_commande"=>[
        "controller"=>"Commande",
        "action"=>"validationCommande",
        'path'=>"user",
        "base_template"=>"base"
    ],

    "empty_basket"=>[
        "controller"=>"Commande",
        "action"=>"emptyBasket",
        'path'=>"user",
        "base_template"=>""
    ],
    "historique_commandes"=>[
        "controller"=>"Historique",
        "action"=>"commandes",
        'path'=>"user",
        "base_template"=>"base"
    ],
    "commande_details"=>[
        "controller"=>"Historique",
        "action"=>"getOneCommande",
        'path'=>"user",
        "base_template"=>"base"
    ],
    "parametre_client"=>[
        "controller"=>"client",
        "action"=>"parametre",
        'path'=>"user",
        "base_template"=>"base"
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
    "commande_details_admin" =>[
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
    ],
    "edit_franco"=>[
        "controller"=>"Admin",
        "action"=>"franco",
        'path'=>"admin",
        "base_template"=>"base_admin"
    ],

    /*
     * Error redirection page
     */
    "page_404"=>[
        "controller"=>"ErrorPage",
        "action"=>"page404",
        'path'=>"error",
        "base_template"=>"base_error"
    ],
    "page_403"=>[
        "controller"=>"ErrorPage",
        "action"=>"page403",
        'path'=>"error",
        "base_template"=>"base_error"
    ]
];
return $routes ;


