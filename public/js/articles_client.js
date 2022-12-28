/*
    Selection de ma barre de recherche et des quantitées rentré
 */
let articlesearch = document.querySelector("#articleSearch");
let inputQuantite = document.querySelectorAll(".quantite");
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
    let formData = new FormData(form);
    // container est la zone qui affiche la liste d'articles
    let container = document.querySelector('.view');
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
            inputQuantite = document.querySelectorAll('.quantite');
            for (const quantite of inputQuantite) {
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
