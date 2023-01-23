export class AdminCommandes
{
    constructor() {
        this.initSelector();
        this.init();
    }

    initSelector(){
        this.searchDate = document.querySelector("#reservationDate");
        this.status = document.querySelector("#selectStatut");
        this.form = document.querySelector('#form-commande');
        this.resetButton = document.querySelector('.buttonReset');
    }

    init(){
        this.status.addEventListener('change',this.submit.bind(this));
        this.searchDate.addEventListener('change',this.submit.bind(this));
        this.resetButton.addEventListener('click', this.resetDate.bind(this));
    }

    resetDate(event) {
        this.searchDate.value = '';
        this.submit(event);
    }

    submit(event) {
        event.preventDefault();
        this.formData = new FormData(this.form);
        this.container = document.querySelector('.templateListe');
        fetch('commandes_admin?ajax=true', {method: 'POST', body: this.formData})
            .then(response => response.text())
            .then(data => {
                this.container.innerHTML = '';
                this.container.innerHTML = data;
            })
            .catch(error => console.error(error));
    }
}





