console.log('hello depuis main');
const articleList = document.getElementById("article");

function loadArticle() {
    fetch('https://app.cmrp.net/reverso/list-actu.php')
        .then(response => {
            response.json()
                .then(article => {
                    const allId = article.map(id => `<article id="json"  class="container pt-7 border  bg-dark text-white" ><h1><b>${id.title}</b></h1><image src=${id.urlImage}> <p>${id.decription}</p></article>`)
                        .join('');

                    articleList.innerHTML = allId;
                });
        })
        .catch(console.error);
}

loadArticle()
if (navigator.serviceWorker) {
    navigator.serviceWorker.register('../sw.js')
        .catch(err => console.error);
}