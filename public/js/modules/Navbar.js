export class Navbar
{
    constructor(target) {
        this.initProperty();
        this.initSelector(target);
        this.init();
    }

    initSelector(target){
        this.menuBtn = document.getElementById('menuresp');
        this.menu = document.querySelector(`.${target}-function-list`);
        this.burger = document.getElementById('burger');
        this.cross = document.getElementById('cross');
        this.dropDown = document.querySelector('.fa-caret-down');
        this.dropdownContent = document.querySelector(`.${target}-info-list-item-dropdownContent`);
        this.navbar = document.querySelector('.headerNavbar');
    }

    initProperty(){
        this.previousScroll = 0;
    }
    init(){
        this.menuBtn.addEventListener('click', (function ()  {
            if (this.menu.classList.contains('active')) {
                this.menu.classList.remove('active');
                this.burger.classList.remove('hide');
                this.cross.classList.add('hide');

            } else {
                this.menu.classList.add('active');
                if(this.dropDown) {
                    this.dropdownContent.classList.remove('active');
                }
                this.burger.classList.add('hide');
                this.cross.classList.remove('hide');
            }
        }).bind(this));

        if(this.dropDown){
            this.dropDown.addEventListener('click', (function(){

                if (this.dropdownContent.classList.contains('active')) {
                    this.dropdownContent.classList.remove('active');
                }else {
                    this.dropdownContent.classList.add('active');
                    this.menu.classList.remove('active');

                    if(this.burger.classList.contains('hide')){
                        this.burger.classList.remove('hide');
                        this.cross.classList.add('hide');
                    }
                }
            }).bind(this));
        }

        document.addEventListener('click',(function(event){
            if (event.target !== this.menuBtn && event.target !== this.menu && event.target !== this.burger && event.target !== this.cross && event.target !== this.dropDown && event.target !== this.dropdownContent) {
                this.burger.classList.remove('hide');
                this.cross.classList.add('hide');
                this.menu.classList.remove('active');
                if(this.dropDown) {
                    this.dropdownContent.classList.remove('active');
                }
            }
        }).bind(this));

        if(this.navbar){
            window.addEventListener('scroll', (function() {
                const currentScroll = window.pageYOffset;
                if (currentScroll > previousScroll) {
                    this.navbar.classList.add('hide');
                } else {
                    this.navbar.classList.remove('hide');
                }
                this.previousScroll = currentScroll;
            }).bind(this));
        }

    }


}