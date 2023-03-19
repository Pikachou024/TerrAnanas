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

    initSelector(){
        this.buttonList = document.querySelector('.headerArticle-layout-list')
        this.buttonGrid = document.querySelector('.headerArticle-layout-grid')
        this.listArticle = document.querySelectorAll('.article-liste');
        this.pictureArticle = document.querySelectorAll('.article-liste-item.image');

        this.articleSearch = document.querySelector("#articleSearch");
        this.form = document.querySelector('#form-search');

        this.inputField = document.querySelector('.headerArticle-search-form-input');
        this.glass = document.querySelector('.headerArticle-search-form-glass');
        this.headerArticle = document.querySelector(".headerArticle");
        this.navbar = document.querySelector(".headerNavbar");

    }

    init() {

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

    }

    search(event) {
        event.preventDefault();
        let formData = new FormData(this.form);
        let container = document.querySelector('.templateListeArticle');
        let isListView = false;

        if(this.buttonList.classList.contains('select')){
            isListView = true;
        }

        fetch(this.form.action+'?ajax=true', {method: 'POST', body: formData})
            .then(response => response.json())
            .then(data => {
                // console.log(data)
                container.innerHTML = '';
                container.innerHTML = data.view;
                this.resetElements();
                this.toggleListArticle(this.getlisteArticle(), isListView);
                this.togglePicture(this.getpictureArticle(),isListView);
            })
            .catch(error => console.error(error));
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

    resetElements(){
        this.setlisteArticle('.article-liste');
        this.setpictureArticle('.article-liste-item.image');
        this.quantityClass.resetQuantity();
    }

}

