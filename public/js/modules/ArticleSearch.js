
export class ArticleSearch {

    constructor() {
        this.initProperty();
        this.initSelector();
        this.init();
    }

    initProperty(){
        this.stockQuantite = {};
    }

    initSelector(){
        this.buttonList = document.querySelector('.headerArticle-layout-list')
        this.buttonGrid = document.querySelector('.headerArticle-layout-grid')
        this.listArticle = document.querySelectorAll('.liste-article');
        this.pictureArticle = document.querySelectorAll('.liste-article-item.image');
        this.articleSearch = document.querySelector("#articleSearch");
        this.inputQuantite = document.querySelectorAll(".quantite>input");
        this.form = document.querySelector('#form-search');
        // this.formArticle = document.querySelector('#form-article');
    }

    init() {
        this.inputQuantite.forEach(quantite => {
            quantite.addEventListener('change', event => {
                this.stockQuantite[event.currentTarget.id] = event.currentTarget.value;
            });
        });

        this.articleSearch.addEventListener('keyup', this.search.bind(this));
        this.buttonList.addEventListener('click', this.toggleListView.bind(this, true));
        this.buttonGrid.addEventListener('click', this.toggleListView.bind(this, false));
        // this.formArticle.addEventListener('submit',this.addPanier.bind(this));
    }

    search(event) {
        event.preventDefault();
        // let listArticle = document.querySelectorAll('.liste-article');
        let formData = new FormData(this.form);
        let container = document.querySelector('.templateListeArticle');
        let isListView = false;
        for (const element of this.getlisteArticle()) {
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
                this.setlisteArticle('.liste-article')
                this.toggleListArticle(this.getlisteArticle(), isListView);
                this.setpictureArticle('.liste-article-item.image');
                this.togglePicture(this.getpictureArticle(),isListView);
                this.setinputQuantite('.quantite>input')
                for (const quantite of this.getinputQuantite()) {
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




    toggleListView(isListView) {
        this.buttonList.classList.toggle('select', isListView);
        this.buttonGrid.classList.toggle('select', !isListView);
        this.toggleListArticle(this.getlisteArticle(), isListView);
        this.togglePicture(this.getpictureArticle(),isListView);
    }

    toggleListArticle(elements, isAdd) {
        elements.forEach(element => {
            if (isAdd) {
                element.classList.add("list");
            } else {
                element.classList.remove("list");
            }
        });
    }

    togglePicture(elements,isAdd) {
        elements.forEach(element => {
            if (isAdd) {
                element.classList.add("hide");
            } else {
                element.classList.remove("hide");
            }
        });
    }



    // addPanier(event){
    //     event.preventDefault();
    //     let formData = new FormData(this.formArticle);
    //     fetch(this.formArticle.action,{method: 'POST', body: formData})
    //         .then(response=>response.json())
    //         .then(data=>{
    //             let flashMessage = document.querySelector('.flash-message')
    //             flashMessage.classList.add('customFlashMessage')
    //             flashMessage.innerHTML=`<p>${data.message}</p> <button>OK</button>`;
    //
    //         });
    // }

    getlisteArticle() {
        return this.listArticle;
    }
    setlisteArticle(value) {
        this.listArticle = document.querySelectorAll(value);
    }

    getpictureArticle() {
        return this.pictureArticle;
    }

    setpictureArticle(value) {
        this.pictureArticle = document.querySelectorAll(value);
    }

    getinputQuantite() {
        return this.inputQuantite;
    }

    setinputQuantite(value) {
        this.inputQuantite = document.querySelectorAll(value);
    }
}

