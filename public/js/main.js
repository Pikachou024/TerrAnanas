import { MessageFlash } from './modules/MessageFlash.js';
import { Navbar } from './modules/Navbar.js';
import { UserArticles } from './modules/UserArticles.js';
import { Panier } from './modules/Panier.js';
import {Commande} from "./modules/Commande.js";

const navbar = new Navbar('headerNavbar')
const messageFlash = new MessageFlash();

if(window.location.pathname==='/TerrAnanas/articles_client'){
    const articles = new UserArticles();
}
else if(window.location.pathname==='/TerrAnanas/panier'){
    const panier = new Panier();
}
else if(window.location.pathname==='/TerrAnanas/historique_commandes'){
    const commande = new Commande();
}