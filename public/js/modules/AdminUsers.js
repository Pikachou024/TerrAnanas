export class AdminUsers
{
    constructor() {
        this.initSelector();
        this.init()
    }

    initSelector(){
        this.searchUser = document.querySelector("#userSearch");
        this.searchStatut = document.querySelector("#userStatut");
        this.form = document.querySelector('#form-commande');
    }

    init(){
        this.searchUser.addEventListener('keyup',this.submit.bind(this));
        this.searchStatut.addEventListener('change',this.submit.bind(this))
    }

    submit(event) {
        event.preventDefault();
        this.formData = new FormData(form);
        this.container = document.querySelector('.templateListe');

        fetch('users_admin?ajax=true', {method: 'POST', body: this.formData})
            .then(response => response.text())
            .then(data => {
                this.container.innerHTML='';
                this.container.innerHTML=data;
            })
            .catch(error => console.error(error));
    }
}