const submitFranco = document.querySelector('#submit-franco');

submitFranco.addEventListener('submit', async function(event){
    console.log('toast')
    event.preventDefault();
    const response = await fetch(submitFranco.action+'?ajax=true', { method: 'POST', body: new FormData(submitFranco) });
    const data = await response.text();
    alert(data);
})