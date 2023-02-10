import { Navbar } from './modules/Navbar.js';
import { MessageFlash } from './modules/MessageFlash.js';
import { AdminArticles } from './modules/AdminArticles.js';
import { AdminUsers } from './modules/AdminUsers.js';
import { AdminCommandes } from './modules/AdminCommandes.js';


const navbar = new Navbar('adminNavbar');
const messageFlash = new MessageFlash();

if(window.location.pathname==='/TerrAnanas/articles_admin'){
    const articles = new AdminArticles();
}
else if(window.location.pathname==='/TerrAnanas/users_admin'){
    const users = new AdminUsers();
}
else if(window.location.pathname==='/TerrAnanas/commandes_admin'){
    const commandes = new AdminCommandes();
}
