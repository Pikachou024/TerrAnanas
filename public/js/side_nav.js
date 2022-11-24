const menuBurger = document.querySelector(".menu-burger");

menuBurger.addEventListener('click',function(){
    document.querySelector(".haut-navigation-liste").classList.remove('hide');
    document.querySelector(".accueil").classList.add('hide');


})