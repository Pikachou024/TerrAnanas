let formFranco = document.querySelector(".franco");
let formProfil = document.querySelector('.profil');
let inputFranco = document.querySelector('#franco');


formFranco.addEventListener('submit',function (event){
    event.preventDefault();
    let formData = new FormData(formFranco);
    fetch('edit_franco',{method: 'POST', body: formData})
        .then(response=>response.json())
        .then(data=>{
            alert(data.message)
            inputFranco.value = data.montant;
        })
})

formProfil.addEventListener('submit', function(event){
    event.preventDefault();
    let formData = new FormData(formProfil);

    fetch('parametre_admin',{method: 'POST', body: formData})
        .then(response=>response.json())
        .then(data=>{
            alert(data.message);
        })
})