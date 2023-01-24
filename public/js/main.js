// import { CustomAlert } from './modules/CustomAlert.js';
import { UserArticles } from './modules/UserArticles.js';
import { Navbar } from './modules/Navbar.js';

// const customAlert = new CustomAlert();
const navbar = new Navbar('headerNavbar')

if(window.location.pathname==='/TerrAnanas/articles_client'){
    const articles = new UserArticles();
}
