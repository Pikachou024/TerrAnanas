let searchDate = document.querySelector("#reservationDate");
let status = document.querySelector("#selectStatus")
let form = document.querySelector('form');

status.addEventListener('change',submit);
searchDate.addEventListener('input',submit);

function submit(){
    const formData = new FormData(form);
    console.log(formData);

}

console.log("ok")