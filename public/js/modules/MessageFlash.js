export class MessageFlash
{
    constructor() {
        this.initSelector();
        this.init();
    }

    // initSelector(){
    //     this.flashError = document.querySelector('.flash-error');
    //     this.flashSuccess = document.querySelector('.flash-success');
    // }
    //
    // init(){
    //     setTimeout(() => {
    //         if(this.flashError){
    //             this.flashError.animate([
    //                 // keyframes
    //                 { opacity: 1, transform: 'translateY(0px)' },
    //                 { opacity: 0, transform: 'translateY(-100px)' }
    //             ], {
    //                 // timing options
    //                 duration: 1000,
    //                 fill: 'forwards'
    //             });
    //         }
    //         if(this.flashSuccess){
    //             this.flashSuccess.animate([
    //                 // keyframes
    //                 { opacity: 1, transform: 'translateY(0px)' },
    //                 { opacity: 0, transform: 'translateY(-100px)' }
    //             ], {
    //                 // timing options
    //                 duration: 1000,
    //                 fill: 'forwards'
    //             });
    //         }
    //     }, 4000);
    // }

    initSelector(){
        this.flashError = document.querySelectorAll('.flash-error');
        this.flashSuccess = document.querySelectorAll('.flash-success');
    }

    init(){
        setTimeout(() => {
            this.flashError.forEach((error) => {
                error.animate([
                    // keyframes
                    { opacity: 1, transform: 'translateY(0px)' },
                    { opacity: 0, transform: 'translateY(-100px)' }
                ], {
                    // timing options
                    duration: 1000,
                    fill: 'forwards'
                });
            });
            this.flashSuccess.forEach((success) => {
                success.animate([
                    // keyframes
                    { opacity: 1, transform: 'translateY(0px)' },
                    { opacity: 0, transform: 'translateY(-100px)' }
                ], {
                    // timing options
                    duration: 1000,
                    fill: 'forwards'
                });
            });
        }, 3000);
    }
}
