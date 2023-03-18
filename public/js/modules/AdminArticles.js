export class AdminArticles
{
    constructor() {

        this.initSelector();
        this.init();
    }

    initSelector(){
        this.articleSearch = document.querySelector("#articleSearch");
        this.form = document.querySelector('#form-commande');
        this.checkbox = document.querySelector('#archive');

    }

    init() {
        this.articleSearch.addEventListener('keyup', this.search.bind(this));
        this.checkbox.addEventListener('change', this.search.bind(this))
    }

    search(event) {
        event.preventDefault();
        let formData = new FormData(this.form);
        let container = document.querySelector('.templateListe');
        // fetch('commandes_admin?ajax=true', {method: 'POST', body: formData})
        fetch('articles_admin?ajax=true', {method: 'POST', body: formData})
            .then(response => response.json())
            .then(data => {
                container.innerHTML='';
                container.innerHTML=data.view;
            })
            .catch(error => console.error(error));
    }

    getlisteArticle() {
        return this.listArticle;
    }
    setlisteArticle(value) {
        this.listArticle = document.querySelectorAll(value);
    }

}