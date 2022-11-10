const toast = document.querySelectorAll(".toast");
const formCommande = document.querySelector("#form-commande");
formCommande.addEventListener('submit', async function(event){
    event.preventDefault();
    const response = await fetch(formCommande.action+'?ajax=true', { method: 'POST', body: new FormData(formCommande) });
    const datas = await response.text();

    console.log(datas)
})

