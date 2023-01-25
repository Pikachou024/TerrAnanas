export class MessageFlash
{
    constructor() {
        this.initSelector();
        this.init();
    }

    initSelector(){
        this.flashError = document.querySelector('.flash-error');
        this.flashSuccess = document.querySelector('.flash-success');
    }

    init(){
        setTimeout(() => {
            if(this.flashError){
                this.flashError.animate([
                    // keyframes
                    { opacity: 1, transform: 'translateY(0px)' },
                    { opacity: 0, transform: 'translateY(-100px)' }
                ], {
                    // timing options
                    duration: 1000,
                    fill: 'forwards'
                });
            }
            if(this.flashSuccess){
                this.flashSuccess.animate([
                    // keyframes
                    { opacity: 1, transform: 'translateY(0px)' },
                    { opacity: 0, transform: 'translateY(-100px)' }
                ], {
                    // timing options
                    duration: 1000,
                    fill: 'forwards'
                });
            }
        }, 4000);
    }
}
