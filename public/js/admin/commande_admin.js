const toast = document.querySelectorAll(".toast");
const formCommande = document.querySelector("#form-commande");
formCommande.addEventListener('submit', async function(event){
    event.preventDefault();
    const response = await fetch(formCommande.action+'?ajax=true', { method: 'POST', body: new FormData(formCommande) });
    const datas = await response.json();

    for(let i = 0 ; i < datas.length ; i++){
        console.log(toast.length , datas.length)
    }

})

