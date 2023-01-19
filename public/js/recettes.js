const titles = document.querySelectorAll('.recette-article-title');
const items = document.querySelectorAll('.recette-article-item');

for (let i = 0; i < titles.length; i++) {
    titles[i].addEventListener('click', function(event){

        const currentItem = this.nextElementSibling;
        if (currentItem.classList.contains('hidden')) {
            for (let j = 0; j < items.length; j++) {
                items[j].classList.add('hidden');
            }
            currentItem.classList.remove('hidden');
            scrollToElement(event.currentTarget);
        }else{
            currentItem.classList.add('hidden');
        }
    });
}
function scrollToElement(element) {
    element.scrollIntoView({ behavior: 'smooth' });
}