let main = document.querySelector('main');
let body = document.querySelector('body');
const details = document.querySelectorAll(".show-detail")

body.addEventListener('click',function(){
    console.log("ok")
    if(document.querySelector('.detailCommande') != null){
        console.log(this)
        this.removeChild(document.querySelector('.detailCommande'));
    }
})
for(let detail of details){
    let object;
    detail.addEventListener("click",function(event){
        event.preventDefault();
        object = readValue(event.currentTarget.parentNode.childNodes)
        createWindow(object);

        main.classList.add('opacityy');
    });
}

function readValue(NodeList){

    let object = new Object();
    for(let node of NodeList){
        if(node.tagName == "DIV" && node.textContent !== ""){

            object[node.dataset.value] = node.textContent;
        }
    }
    return object;
}

function createWindow(object){

    let window = document.createElement('div');
    window.setAttribute('class', 'detailCommande') ;

    for(let o in object){
        console.log(o , object[o])
        let p =document.createElement('div');
        p.innerHTML= o + ':' + object[o] ;
        window.appendChild(p);
    }
    body.appendChild(window)
}