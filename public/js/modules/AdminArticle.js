export class AdminArticle
{
    constructor() {

        this.initSelector();
        this.init();
    }

    initSelector(){
        this.articleSearch = document.querySelector("#articleSearch");
        this.form = document.querySelector('#form-commande');

    }

    init() {
        this.articleSearch.addEventListener('keyup', this.search.bind(this));

    }

    search(event) {
        event.preventDefault();
        let formData = new FormData(this.form);
        let container = document.querySelector('.templateListeArticle');
        // fetch('commandes_admin?ajax=true', {method: 'POST', body: formData})
        fetch('articles_admin?ajax=true', {method: 'POST', body: formData})
            .then(response => response.text())
            .then(data => {
                console.log(data);
                container.innerHTML='';
                container.innerHTML=data;

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