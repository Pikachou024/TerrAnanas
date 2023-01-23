import { CustomAlert } from './modules/CustomAlert.js';
import { ArticleSearch } from './modules/ArticleSearch.js';
import { AdminArticles } from './modules/AdminArticle.js';
import { Navbar } from './modules/Navbar.js';


// const navbar = new Navbar()
const customAlert = new CustomAlert();

//script pour role client


//script pour role admin
if(window.location.pathname==='/TerrAnanas/articles_admin'){
    const adminSearch = new AdminArticles();
}
else{
    const articleSearch = new ArticleSearch();
}
console.log(window.location.pathname);