const menuBtn = document.getElementById('menuresp');
const menu = document.querySelector('.headerNavbar-function-list');
const burger = document.getElementById('burger');
const cross = document.getElementById('cross');
let dropDown = document.querySelector('.headerNavbar-info-list-item-dropdown');
let dropdownContent = document.querySelector('.headerNavbar-info-list-item-dropdownContent');

menuBtn.addEventListener('click', () => {
    if (menu.classList.contains('active')) {
        menu.classList.remove('active');
        burger.classList.remove('hide');
        cross.classList.add('hide');

    } else {
        menu.classList.add('active');
        dropdownContent.classList.remove('active');
        burger.classList.add('hide');
        cross.classList.remove('hide');
    }
});

dropDown.addEventListener('click', function(){
    if (dropdownContent.classList.contains('active')) {
        dropdownContent.classList.remove('active');
    }else {
        dropdownContent.classList.add('active');
        menu.classList.remove('active');

        if(burger.classList.contains('hide')){
            burger.classList.remove('hide');
            cross.classList.add('hide');
        }
    }
});

document.addEventListener('click',function(event){
    if (event.target !== menuBtn && event.target !== menu && event.target !== burger && event.target !== cross && event.target !== dropDown && event.target !== dropdownContent) {
        burger.classList.remove('hide');
        cross.classList.add('hide');
        menu.classList.remove('active');
        dropdownContent.classList.remove('active');
    }
})
