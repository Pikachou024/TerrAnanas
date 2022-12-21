let searchUser = document.querySelector("#userSearch");
let searchStatut = document.querySelector("#userStatut");
let form = document.querySelector('#form-commande');

searchUser.addEventListener('keyup',submit);
searchStatut.addEventListener('change',submit)

function submit(event) {
    event.preventDefault();
    let formData = new FormData(form);
    let container = document.querySelector('.view');

    fetch('users_admin?ajax=true', {method: 'POST', body: formData})
        .then(response => response.text())
        .then(data => {
            container.innerHTML='';
            container.innerHTML=data;
        })
        .catch(error => console.error(error));
}