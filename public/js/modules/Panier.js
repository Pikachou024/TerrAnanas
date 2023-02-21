import {Quantity} from "./Quantity.js";

export class Panier
{
    constructor() {
        this.quantityClass = new Quantity();
        this.quantityClass.initSelector();
        this.initSelector();
        this.init();
    }

    initSelector(){
        this.panier = document.querySelector('#form-panier');
    }

    init(){
        for (const less of this.quantityClass.getButtonLess()) {
            less.addEventListener('click', this.editMontant.bind(this))
        }

        for (const more of this.quantityClass.getButtonMore()) {
            more.addEventListener('click', this.editMontant.bind(this))
        }
    }

    editMontant(event){
        event.preventDefault();
        let formData = new FormData(this.panier);
        let container = document.querySelector('.montantPanier');
        fetch('montant_panier?ajax=true', {method: 'POST', body: formData})
            .then(response => response.json())
            .then(data => {
                container.innerHTML = '';
                container.innerHTML = data.toFixed(2) +' €';
            })
            .catch(error => console.error(error));
    }
}