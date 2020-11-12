const CACHE_NAME = "V2";
const STATIC_CACHE_URLS = [
    "./php/index.php",
    "./javascript/main.js",
    "./css/style.css",
    "./manifest.json"

];

self.addEventListener("install", event => {
    console.log("Service Worker installing.");
    event.waitUntil(
        caches.open(CACHE_NAME).then(cache => cache.addAll(STATIC_CACHE_URLS))
    );
});

self.addEventListener('activate', evt => {
    console.log("activate evt", evt);
    evt.waitUntil(
        caches
            .keys()
            .then(keys => keys.filter(key => key !== CACHE_NAME))
            .then(keys =>
                Promise.all(
                    keys.map(key => {
                        console.log(`Deleting cache ${key}`);
                        return caches.delete(key);
                    })
                )
            )
    );
  
});

self.addEventListener('fetch', (event) => {
  

    if (event.request.url.includes("list-actu.php")) {
        // r�ponse aux requ�tes API, strat�gie Cache Update Refresh
        event.respondWith(caches.match(event.request));
        event.waitUntil(update(event.request).then(refresh));
        console.log("Cela fonctionne");
    } else {
      event.respondWith(
        caches
            .match(event.request) // On v�rifie si la requ�te a d�j� �t� mise en cache
            .then(cached => cached || fetch(event.request)) // sinon on requ�te le r�seau
       
    );
       
        // r�ponse aux requ�tes de fichiers statiques, strat�gie Cache-First
    }
    
    console.log('url intercept�e', event.request.url);


}) 

/*self.addEventListener("sync", function (event) {
    console.log("sync event", event);
    if (event.tag === "syncAttendees") {
        event.waitUntil(syncAttendees()); // on lance la requ�te de synchronisation
    }
});*/

function cache(request, response) {
    if (response.type === "error" || response.type === "opaque") {
        return Promise.resolve(); // do not put in cache network errors
    }

    return caches
        .open(CACHE_NAME)
        .then(cache => cache.put(request, response.clone()));
}

function update(request) {
    return fetch(request.url).then(
        response =>
            cache(request, response) // on peut mettre en cache la r�ponse
                .then(() => response) // r�sout la promesse avec l'objet Response
    );
}

function refresh(response) {
    return response
        .json() // lit et parse la r�ponse JSON
        .then(jsonResponse => {
            self.clients.matchAll().then(clients => {
                clients.forEach(client => {
                    // signaler et envoyer au client les nouvelles donn�es
                    client.postMessage(
                        JSON.stringify({
                            type: response.url,
                            data: jsonResponse.data
                        })
                    );
                });
            });
            console.log(jsonResponse.data);

            return jsonResponse.data; // r�sout la promesse avec les nouvelles donn�es
        });
}