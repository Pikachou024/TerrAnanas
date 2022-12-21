let searchArticle = document.querySelector("#articleSearch");
let form = document.querySelector('#form-commande');

searchArticle.addEventListener('keyup',submit);

function submit(event) {
    event.preventDefault();
    let formData = new FormData(form);
    let container = document.querySelector('.view');
    // fetch('commandes_admin?ajax=true', {method: 'POST', body: formData})
    fetch('articles_client?ajax=true', {method: 'POST', body: formData})
        .then(response => response.text())
        .then(data => {
            container.innerHTML='';
            container.innerHTML=data;
        })
        .catch(error => console.error(error));
}