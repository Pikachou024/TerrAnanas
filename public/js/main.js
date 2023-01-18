import { CustomAlert } from './modules/CustomAlert.js';
import { ArticleSearch } from './modules/ArticleSearch.js';
import { AdminArticle } from './modules/AdminArticle.js';

const customAlert = new CustomAlert();

//script pour role client


//script pour role admin
if(window.location.pathname==='/TerrAnanas/articles_admin'){
    const adminSearch = new AdminArticle();
}
else{
    const articleSearch = new ArticleSearch();
}
console.log(window.location.pathname);