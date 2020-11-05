self.addEventListener('install', evt => {
    console.log("installation evt", evt);
});

self.addEventListener('activate', evt => {
    console.log("activate evt", evt);
});


self.addEventListener('fetch', (evt) => {

    console.log('url interceptée', evt.request.url);
    if (!navigator.onLine) {
        const headers = { headers: { 'Content-Type': 'text/html;charset-uft-8' } };
        evt.respondWith(new Response("<h1>Pas de connection internet</h1><div>Veuillez vous reconneter </div>", headers));
    }
});
