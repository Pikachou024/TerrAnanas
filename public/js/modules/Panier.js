import {Quantity} from "./Quantity.js";

export class Panier
{
    constructor() {
        this.quantityClass = new Quantity();
        console.log(this.quantityClass.stockQuantite);
    }
}