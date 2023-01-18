/*
    Selection de ma barre de recherche et des quantitées rentré
 */
let articlesearch = document.querySelector("#articleSearch");
let inputQuantite = document.querySelectorAll(".quantite>input");
let form = document.querySelector('#form-search');

/*
    Déclaration d'un objet me permettant de stocker tous les quantitées rentrés avec l'id de l'article
 */
let stockQuantite={};

for( const quantite of inputQuantite){
    quantite.addEventListener('change',function (event){
        stockQuantite[event.currentTarget.id]=event.currentTarget.value;
    });

}
articlesearch.addEventListener('keyup',search);

/*
    function pour la recherche d'un article.
 */
function search(event) {

    event.preventDefault();
    let listArticle = document.querySelectorAll('.liste-article');
    let formData = new FormData(form);

    // container est la zone qui affiche la liste d'articles
    let container = document.querySelector('.templateListeArticle');

    let isListView = false;
    for (const element of listArticle) {
        if (element.classList.contains("list")) {
            isListView = true;
            break;
        }
    }
    // Methode en ajax
    fetch('articles_client?ajax=true', {method: 'POST', body: formData})
        .then(response => response.text())
        .then(data => {
            /*
                Je supprime la zone pour afficher ma liste d'article à jour.
                Je change la quantitée si l'utilisateur a rentré une quantité et fais une recherche.
             */
            container.innerHTML = '';
            container.innerHTML = data;
            let newListArticle = document.querySelectorAll('.liste-article');
            toggleListArticle(newListArticle, isListView);
            let newInputQuantite = document.querySelectorAll('.quantite>input');
            for (const quantite of newInputQuantite) {
                if (existId(stockQuantite, quantite.id)) {
                    quantite.value = stockQuantite[quantite.id]
                }
            }
        })
        .catch(error => console.error(error));
}

function existId(objet, cle) {
    return objet.hasOwnProperty(cle);
}

let buttonGrid = document.querySelector('.headerArticle-layout-grid')
let buttonList = document.querySelector('.headerArticle-layout-list')

function toggleListArticle(elements, isAdd) {
    for (const element of elements) {
        if (isAdd) {
            element.classList.add("list");

        } else {
            element.classList.remove("list");
        }
    }
}

function togglePicture(elements,isAdd) {
    for (const element of elements) {
        if (isAdd) {
            element.classList.add("hide");

        } else {
            element.classList.remove("hide");
        }
    }
}

buttonList.addEventListener('click', function() {
    let listArticle = document.querySelectorAll('.liste-article');
    let pictureArticle = document.querySelectorAll('.liste-article-input.image');
    buttonList.classList.add('select');
    buttonGrid.classList.remove('select');
    toggleListArticle(listArticle, true);
    togglePicture(pictureArticle,true)
});

buttonGrid.addEventListener('click', function() {
    let listArticle = document.querySelectorAll('.liste-article');
    let pictureArticle = document.querySelectorAll('.liste-article-input.image');
    buttonList.classList.remove('select');
    buttonGrid.classList.add('select');
    toggleListArticle(listArticle, false);
    togglePicture(pictureArticle,false)
});
