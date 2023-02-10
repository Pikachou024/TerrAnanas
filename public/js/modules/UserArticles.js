import {Quantity} from "./Quantity.js";

export class UserArticles {

    constructor() {
        this.initProperty();
        this.initSelector();
        this.init();
    }

    initProperty(){
        this.quantityClass = new Quantity();
    }
    // initProperty(){
    //     this.stockQuantite = {};
    // }

    initSelector(){
        this.buttonList = document.querySelector('.headerArticle-layout-list')
        this.buttonGrid = document.querySelector('.headerArticle-layout-grid')
        this.listArticle = document.querySelectorAll('.article-liste');
        this.pictureArticle = document.querySelectorAll('.article-liste-item.image');


        this.articleSearch = document.querySelector("#articleSearch");
        this.form = document.querySelector('#form-search');


        // this.inputQuantite = document.querySelectorAll(".quantite>input");
        this.inputField = document.querySelector('.headerArticle-search-form-input');
        this.glass = document.querySelector('.headerArticle-search-form-glass');
        this.headerArticle = document.querySelector(".headerArticle");
        this.navbar = document.querySelector(".headerNavbar");
        // this.buttonMore = document.querySelectorAll(".buttonMore");
        // this.buttonLess = document.querySelectorAll(".buttonLess");

        // this.formArticle = document.querySelector('#form-article');
    }

    init() {
        // this.inputQuantite.forEach(quantite => {
        //     quantite.addEventListener('change', event => {
        //         this.stockQuantite[event.currentTarget.id] = event.currentTarget.value;
        //     });
        // });
        // for (const more of this.buttonMore) {
        //     more.addEventListener('click',(event) => {
        //         this.id = event.currentTarget.dataset.id;
        //
        //         this.incrementQuantity(this.id)
        //     });
        // }
        // for (const less of this.buttonLess) {
        //     less.addEventListener('click',(event) => {
        //         this.id = event.currentTarget.dataset.id;
        //         this.decrementQuantity(this.id)
        //     });
        // }


        this.articleSearch.addEventListener('keyup', this.search.bind(this));


        this.buttonList.addEventListener('click', this.toggleListView.bind(this, true));
        this.buttonGrid.addEventListener('click', this.toggleListView.bind(this, false));
        this.glass.addEventListener('click', () => {
            this.glass.classList.toggle('visible');
            this.inputField.classList.toggle('visible');
        });

        window.addEventListener("scroll", (function() {
            if (this.navbar.classList.contains('hide')) {
                this.headerArticle.classList.add('changeTop');
            } else {
                this.headerArticle.classList.remove('changeTop');
            }
        }).bind(this));

        // this.formArticle.addEventListener('submit',this.addPanier.bind(this));
    }
    // articles_client

    search(event) {
        event.preventDefault();
        let formData = new FormData(this.form);
        let container = document.querySelector('.templateListeArticle');
        let isListView = false;

        if(this.buttonList.classList.contains('select')){
            isListView = true;
        }

        fetch(this.form.action+'?ajax=true', {method: 'POST', body: formData})
            .then(response => response.text())
            .then(data => {
                container.innerHTML = '';
                container.innerHTML = data;
                this.resetElements();
                this.toggleListArticle(this.getlisteArticle(), isListView);
                this.togglePicture(this.getpictureArticle(),isListView);
            })
            .catch(error => console.error(error));
    }


    // existId(objet, cle) {
    //     return objet.hasOwnProperty(cle);
    // }

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



    // incrementQuantity(id) {
    //     this.input = document.getElementById(id);
    //     this.input.value = parseInt(this.input.value) + 1;
    //     this.stockQuantite[id] = this.input.value;
    // }
    //
    // decrementQuantity(id) {
    //     this.input = document.getElementById(id);
    //     if (this.input.value > 0) {
    //         this.input.value = parseInt(this.input.value) - 1;
    //     }
    //     this.stockQuantite[id] = this.input.value;
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

    // getinputQuantite() {
    //     return this.inputQuantite;
    // }
    //
    // setinputQuantite(value) {
    //     this.inputQuantite = document.querySelectorAll(value);
    // }

    // getButtonMore() {
    //     return this.buttonMore;
    // }
    //
    // setButtonMore(value) {
    //     this.buttonMore = document.querySelectorAll(value);
    // }
    // getButtonLess() {
    //     return this.buttonLess;
    // }
    //
    // setButtonLess(value) {
    //     this.buttonLess = document.querySelectorAll(value);
    // }

    resetElements(){
        this.setlisteArticle('.article-liste');
        this.setpictureArticle('.article-liste-item.image');
        this.quantityClass.resetQuantity();
    }

        // this.setinputQuantite('.quantite>input');
        // this.setButtonMore(".buttonMore");
        // this.setButtonLess(".buttonLess");


        // for (const more of this.getButtonMore()) {
        //     more.addEventListener('click',(event) => {
        //         this.id = event.currentTarget.dataset.id;
        //
        //         this.incrementQuantity(this.id)
        //     });
        // }
        // for (const less of this.getButtonLess()) {
        //     less.addEventListener('click',(event) => {
        //         this.id = event.currentTarget.dataset.id;
        //         this.decrementQuantity(this.id)
        //     });
        // }
        // for (const quantite of super.getinputQuantite()) {
        //     if (this.existId(this.stockQuantite, quantite.id)) {
        //         quantite.value = this.stockQuantite[quantite.id]
        //     }
        // }

}

