const toggleButton = document.querySelector('.infos-toggle');
const clientInfos = document.querySelector('.infos-client');
const open = document.querySelector('.fa-eye');
const close = document.querySelector('.fa-eye-slash');

toggleButton.addEventListener('click', function() {
    if(clientInfos.classList.contains('hidden')) {
        clientInfos.classList.remove('hidden');
        close.classList.remove('hidden');
        open.classList.add('hidden');
    } else {
        clientInfos.classList.add('hidden');
        open.classList.remove('hidden');
        close.classList.add('hidden');
    }
});