

console.log('hello depuis main');
const articleList = document.getElementById("article");


function loadArticle() {
    if (navigator.onLine) {


        fetch('https://app.cmrp.net/reverso/list-actu.php')
            .then(response => {
                response.json()
                    .then(article => {
                        const allId = article.map(id => `<article id="json"  class="container pt-7 border  bg-dark text-white" ><h1><b>${id.title}</b></h1><image src=${id.urlImage}> <p>${id.decription}</p></article>`)
                            .join('');
                        if (localStorage.getItem("JsonArt") != allId) {
                            localStorage.setItem("JsonArt", allId);
                        }
                        articleList.innerHTML = allId;
                   
                    });
            })
            .catch(console.error);
    }
    else {
     articleList.innerHTML =  localStorage.getItem("JsonArt");
      
    }
    var data;
    //This returns null if the item is not in local storage.
    //Since JavaScript is truthy falsy, it will be evaluated as false.

   
}



console.log("test!!");
loadArticle();
if (navigator.serviceWorker) {
    navigator.serviceWorker.register('../sw.js')
        .catch(err => console.error);
}
let deferredPrompt; // Allows to show the install prompt
const installButton = document.getElementById("install_button");

window.addEventListener("beforeinstallprompt", e => {
    console.log("beforeinstallprompt fired");
    // Prevent Chrome 76 and earlier from automatically showing a prompt
    e.preventDefault();
    // Stash the event so it can be triggered later.
    deferredPrompt = e;
    // Show the install button
    installButton.hidden = false;
    installButton.addEventListener("click", installApp);
});

function installApp() {
    // Show the prompt
    deferredPrompt.prompt();
    installButton.disabled = true;

    // Wait for the user to respond to the prompt
    deferredPrompt.userChoice.then(choiceResult => {
        if (choiceResult.outcome === "accepted") {
            console.log("PWA setup accepted");
            installButton.hidden = true;
        } else {
            console.log("PWA setup rejected");
        }
        installButton.disabled = false;
        deferredPrompt = null;
    });
}
window.addEventListener("appinstalled", evt => {
    console.log("appinstalled fired", evt);
});

function registerNotification() {
    Notification.requestPermission(permission => {
        if (permission === "granted") {
            registerBackgroundSync();
        } else console.error("Permission was not granted.");
    });
}
function registerBackgroundSync() {
    if (!navigator.serviceWorker) {
        return console.error("Service Worker not supported");
    }

    navigator.serviceWorker.ready
        .then(registration => registration.sync.register("syncAttendees"))
        .then(() => console.log("Registered background sync"))
        .catch(err => console.error("Error registering background sync", err));
    
}