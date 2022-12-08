let listMonth = document.querySelectorAll(".calendrier-list a");
let listResultMonth = document.querySelectorAll(".resultat");

for(let month of listMonth ){
    month.addEventListener('click',function (event) {
        let dataMonth = event.currentTarget.dataset.index ;
        show(dataMonth);
    })
}

function show(data){
    hide()
    for(let result of listResultMonth ){
        if (result.dataset.month == data){
            result.classList.remove("hide")
            break;
        }
    }
}

function hide(){
    for(let result of listResultMonth ){
        result.classList.add("hide");
    }
}

