export class CustomAlert
{
    constructor() {
        if (document.querySelector('.flash-message>div')){
            const flashMessageDiv = document.querySelector('.flash-message>div');
            const flashMessage = flashMessageDiv.innerHTML;
            if(flashMessage){
                this.open(flashMessage);
            }

        }
    }
    open(message){
        this.alertBox = document.querySelector('.flash-message');
        if (!this.alertBox){
            this.alertBox = document.createElement("div");
            this.alertBox.classList.add("flash-message");
        }
        this.alertBox.classList.add('customFlashMessage');
        this.alertBox.innerHTML = `<p>${message}</p> <button>OK</button>`;
        this.headerArticle = document.querySelector('.headerArticle');
        // document.querySelector('.headerTitle').appendChild(this.alertBox);
        this.headerArticle.insertAdjacentElement("afterend", this.alertBox);
        let okButton = this.alertBox.querySelector("button");
        okButton.addEventListener("click", this.close.bind(this));
    }

    close() {
        document.querySelector('.flash-message').remove()
    }
}