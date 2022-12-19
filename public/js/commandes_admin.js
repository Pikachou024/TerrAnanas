let searchDate = document.querySelector("#reservationDate");
let status = document.querySelector("#selectStatut")
let form = document.querySelector('#form-commande');

status.addEventListener('change',submit);
searchDate.addEventListener('change',submit);

function submit(event) {
    event.preventDefault();
    let formData = new FormData(form);
    let container = document.querySelector('.container.view');
    fetch('commandes_admin?ajax=true', {method: 'POST', body: formData})
        .then(response => response.json())
        .then(data => {
            console.log(data);
            container.innerHTML='';
            container.innerHTML=data;
        })
        .catch(error => console.error(error));

}