<?php
/*
 * Paramètre pour la connexion à la BDD
 */
const DB_NAME='terrananas';
const DB_HOST='localhost';
//const DB_USER='root';
//const DB_PASS='';
const DB_USER='admin_terrananas';
const DB_PASS='PASSWORD';



// Chemin URL
const PATH_ROOT= "http://localhost/TerrAnanas/";
//const PATH_ROOT= "http://lam-david.fr/TerrAnanas/";
const PATH_ROOT2= "/TerrAnanas/" ;
const PATH_PUBLIC = "public";
const PATH_TEMPLATES = PATH_ROOT2."templates";

const PATH_ADMIN = "admin";
const PATH_CLIENT = "client";
const PATH_UTILISATEUR = "utilisateur";


/*
 * Email
 */

const MAILER_DSN = 'smtp://f0bb83f2a6b9e5:59a6675b21c71d@smtp.mailtrap.io:2525?encryption=tls&auth_mode=login';