// http://localhost/TerrAnanas/public/Json/saisons.json

let inputSearch = document.querySelector('#search');
let buttonMonth = document.querySelectorAll('.month');
let buttonReset = document.querySelector('.filtre-reset');
// let buttonToggle = document.querySelector('.filtre-toggle');
// let open = document.querySelector('.fa-eye');
// let close = document.querySelector('.fa-eye-slash');

// buttonToggle.addEventListener('click',toogleListMonth)

for (const element of buttonMonth) {
    element.addEventListener('click',function (event){
        let resultList = document.querySelector('#result');
        let dataMonth = Number(event.currentTarget.dataset.month);
        search(event,dataMonth,true)
        removeBorder();
        element.classList.add('border');
        scrollToElement(resultList);
    })
}

inputSearch.addEventListener('keyup',function (event) {
    let dataInput = inputSearch.value
    search(event,dataInput,false);
    removeBorder();
})

buttonReset.addEventListener('click',function (){
    const resultDiv = document.querySelector('#result');
    resultDiv.innerHTML='';
    removeBorder();
})



function search(event,elementSearch,bool){
    event.preventDefault()
    let boolean , result;

    fetch('http://localhost/TerrAnanas/public/Json/saisons.json')
        .then(response => response.json())
        .then(data => {
            // data contient les données du fichier JSON
            if(bool){
                result = getResultsByMonth(data,elementSearch);
                boolean = true;
            }else{
                result = getResultsBySearch(data,elementSearch);
                boolean = false;
            }
            displayResults(result,boolean);
            let buttonResult = document.querySelectorAll('.result-button');
            if(buttonResult){
                for (const element of buttonResult) {
                    element.addEventListener('click',function (event){
                        let labelMonth = event.currentTarget.value;
                        let listMonth = getMonthsByLabel(data,labelMonth);
                        addBorder(listMonth);
                        // toogleListMonth();
                    })
                }
            }

        })
        .catch(error => console.error(error));
}

function getResultsBySearch(data,fruit){
    let resultat = [];
    if(fruit){
        for (let i = 0; i < data.length; i++) {
            let isMatch = true;
            for (let j = 0; j < fruit.length; j++) {
                if (data[i].label.fr[j].toLowerCase() !== fruit[j]) {
                    isMatch = false;
                    break;
                }
            }
            if (isMatch) {
                resultat.push(data[i].label.fr);
            }
        }
    }
    else {
        removeBorder();
    }

    return resultat;
}

function getResultsByMonth(data,month) {
    // var fruits = data; //data est le tableau des fruits et légumes
    let resultat = [];
    for (let i = 0; i < data.length; i++) {
        if (data[i].months.includes(month)) {
            resultat.push(data[i].label.fr);
        }
    }
    return resultat;
}

function getMonthsByLabel(data, label) {
    for (let i = 0; i < data.length; i++) {
        if (data[i].label.fr.toLowerCase() === label.toLowerCase()) {
            return data[i].months;
        }
    }

}

function addBorder(listMonth){
    for (let i = 0; i < buttonMonth.length; i++){
        let dataMonth = Number(buttonMonth[i].dataset.month);
        if(listMonth.includes(dataMonth)){
            buttonMonth[i].classList.add('border')
        }
        else{
            buttonMonth[i].classList.remove('border')
        }
    }
}
function removeBorder(){
    for (let i = 0; i < buttonMonth.length; i++){
        buttonMonth[i].classList.remove('border')
    }
}
function displayResults(results,bool) {
    // Récupérer la balise <div> où les résultats seront affichés
    const resultDiv = document.querySelector('#result');

    resultDiv.innerHTML='';
    // Boucle sur les résultats et créer des éléments <div> pour chaque résultat

        results.forEach(function(result) {
            if(bool) {
                const resultElem = document.createElement('div');
                resultElem.innerHTML = `<p>${result}</p>`;
                resultDiv.appendChild(resultElem);
            }
            else{
                const resultElem = document.createElement('button');
                resultElem.innerHTML = `<p>${result}</p>`;
                resultElem.value = result;
                resultElem.setAttribute("class", "result-button");
                resultDiv.appendChild(resultElem);
            }
        });
}

// function toogleListMonth(){
//     let listMonth = document.querySelector('.listeMonth');
//     if(!open.classList.contains('hiding')){
//         open.classList.add('hiding');
//         close.classList.remove('hiding');
//         // listMonth.classList.add('show');
//         scrollToElement(listMonth);
//
//     }
//     else{
//         open.classList.remove('hiding');
//         close.classList.add('hiding');
//         // listMonth.classList.remove('show');
//     }
// }

function scrollToElement(element) {
    element.scrollIntoView({ behavior: 'smooth',block: 'center' });
}