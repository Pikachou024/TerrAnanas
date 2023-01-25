export class Quantity
{
    constructor() {
        this.initProperty();
        this.initSelector();
        this.init();
    }

    initProperty(){
        this.stockQuantite = {};
    }

    initSelector(){
        this.buttonMore = document.querySelectorAll(".buttonMore");
        this.buttonLess = document.querySelectorAll(".buttonLess");
    }

    init(){
        for (const more of this.buttonMore) {
            more.addEventListener('click',(event) => {
                this.id = event.currentTarget.dataset.id;

                this.incrementQuantity(this.id)
            });
        }
        for (const less of this.buttonLess) {
            less.addEventListener('click',(event) => {
                this.id = event.currentTarget.dataset.id;
                this.decrementQuantity(this.id)
            });
        }
    }
    existId(objet, cle) {
        return objet.hasOwnProperty(cle);
    }
    incrementQuantity(id) {
        this.input = document.getElementById(id);
        this.input.value = parseInt(this.input.value) + 1;
        this.stockQuantite[id] = this.input.value;
    }

    decrementQuantity(id) {
        this.input = document.getElementById(id);
        if (this.input.value > 0) {
            this.input.value = parseInt(this.input.value) - 1;
        }
        this.stockQuantite[id] = this.input.value;
    }

    getinputQuantite() {
        return this.inputQuantite;
    }

    setinputQuantite(value) {
        this.inputQuantite = document.querySelectorAll(value);
    }

    getButtonMore() {
        return this.buttonMore;
    }

    setButtonMore(value) {
        this.buttonMore = document.querySelectorAll(value);
    }
    getButtonLess() {
        return this.buttonLess;
    }

    setButtonLess(value) {
        this.buttonLess = document.querySelectorAll(value);
    }

    resetQuantity(){
        this.setinputQuantite('.quantite>input');
        this.setButtonMore(".buttonMore");
        this.setButtonLess(".buttonLess");


        for (const more of this.getButtonMore()) {
            more.addEventListener('click',(event) => {
                this.id = event.currentTarget.dataset.id;

                this.incrementQuantity(this.id)
            });
        }
        for (const less of this.getButtonLess()) {
            less.addEventListener('click',(event) => {
                this.id = event.currentTarget.dataset.id;
                this.decrementQuantity(this.id)
            });
        }
        for (const quantite of this.getinputQuantite()) {
            if (this.existId(this.stockQuantite, quantite.id)) {
                quantite.value = this.stockQuantite[quantite.id]
            }
        }
    }

}