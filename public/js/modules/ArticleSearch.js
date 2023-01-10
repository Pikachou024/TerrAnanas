export class ArticleSearch {
    constructor() {
        this.articlesearch = document.querySelector("#articleSearch");
        this.inputQuantite = document.querySelectorAll(".quantite");
        this.form = document.querySelector('#form-search');
        this.stockQuantite = {};
        this.buttonGrid = document.querySelector('.headerArticle-layout-grid');
        this.buttonList = document.querySelector('.headerArticle-layout-list');
        this.init();
    }

    init() {
        for (const quantite of this.inputQuantite) {
            quantite.addEventListener('change', (event) => {
                this.stockQuantite[event.currentTarget.id] = event.currentTarget.value;
            });
        }
        this.articlesearch.addEventListener('keyup', this.search.bind(this));
        this.buttonList.addEventListener('click', () => {
            let listArticle = document.querySelectorAll('.liste-article');
            this.buttonList.classList.add('select');
            this.buttonGrid.classList.remove('select');
            this.toggleListClass(listArticle, true);
        });

        this.buttonGrid.addEventListener('click', () => {
            let listArticle = document.querySelectorAll('.liste-article');
            this.buttonList.classList.remove('select');
            this.buttonGrid.classList.add('select');
            this.toggleListClass(listArticle, false);
        });
    }

    search(event) {
        event.preventDefault();
        let listArticle = document.querySelectorAll('.liste-article');
        let formData = new FormData(this.form);
        let container = document.querySelector('.templateListeArticle');
        let isListView = false;
        for (const element of listArticle) {
            if (element.classList.contains("list")) {
                isListView = true;
                break;
            }
        }
        fetch('articles_client?ajax=true', {method: 'POST', body: formData})
            .then(response => response.text())
            .then(data => {
                container.innerHTML = '';
                container.innerHTML = data;
                let newListArticle = document.querySelectorAll('.liste-article');
                this.toggleListClass(newListArticle, isListView);
                this.inputQuantite = document.querySelectorAll('.quantite');
                for (const quantite of this.inputQuantite) {
                    if (this.existId(this.stockQuantite, quantite.id)) {
                        quantite.value = this.stockQuantite[quantite.id]
                    }
                }
            })
            .catch(error => console.error(error));
    }

    existId(objet, cle) {
        return objet.hasOwnProperty(cle);
    }
}