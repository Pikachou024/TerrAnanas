// http://localhost/TerrAnanas/public/Json/saisons.json

let inputSearch = document.querySelector('#search');
let buttonMonth = document.querySelectorAll('.month');
let buttonReset = document.querySelector('.buttonReset')


for (const element of buttonMonth) {
    element.addEventListener('click',function (event){
        let dataMonth = Number(event.currentTarget.dataset.month);
        search(event,dataMonth,true)
    })
}

inputSearch.addEventListener('keyup',function (event) {
    let dataInput = inputSearch.value
    console.log(dataInput)
    search(event,dataInput,false);
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
                if(result.length === 1){
                    console.log("1")
                }
                boolean = false;
            }
            displayResults(result,boolean);
            let buttonResult = document.querySelectorAll('.result-button');
            if(buttonResult){
                for (const element of buttonResult) {
                    element.addEventListener('click',function (event){
                        let labelMonth = event.currentTarget.value;
                        let listMonth = getMonthsByLabel(data,labelMonth);
                        // console.log(listMonth);
                        addBorder(listMonth);
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
    return "Label non trouvé";
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

