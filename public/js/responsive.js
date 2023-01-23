const menuBtn = document.getElementById('menuresp');
const menu = document.querySelector('.headerNavbar-function-list');
const burger = document.getElementById('burger');
const cross = document.getElementById('cross');
let dropDown = document.querySelector('.fa-caret-down');
let dropdownContent = document.querySelector('.headerNavbar-info-list-item-dropdownContent');

let flashSuccess = document.querySelector(".flash-success");
if (flashSuccess) {
    setTimeout(function() {
        flashSuccess.style.opacity = "0";
        flashSuccess.parentNode.removeChild(flashSuccess);

    }, 3000);
}
let flashError = document.querySelector(".flash-error");
if (flashError) {
    setTimeout(function() {

        flashError.style.opacity = "0";
        }, 3000);
    flashError.parentNode.removeChild(flashError);
}
menuBtn.addEventListener('click', () => {
    if (menu.classList.contains('active')) {
        menu.classList.remove('active');
        burger.classList.remove('hide');
        cross.classList.add('hide');

    } else {
        menu.classList.add('active');
        if(dropDown) {
            dropdownContent.classList.remove('active');
        }
        burger.classList.add('hide');
        cross.classList.remove('hide');
    }
});

if(dropDown){
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
}


document.addEventListener('click',function(event){
    if (event.target !== menuBtn && event.target !== menu && event.target !== burger && event.target !== cross && event.target !== dropDown && event.target !== dropdownContent) {
        burger.classList.remove('hide');
        cross.classList.add('hide');
        menu.classList.remove('active');
        if(dropDown) {
            dropdownContent.classList.remove('active');
        }
    }
})


const navbar = document.querySelector('.headerNavbar');
let previousScroll = 0;
if(navbar){
    window.addEventListener('scroll', () => {
        const currentScroll = window.pageYOffset;
        if (currentScroll > previousScroll) {
            navbar.classList.add('hide');
        } else {
            navbar.classList.remove('hide');
        }
        previousScroll = currentScroll;
    });
}
