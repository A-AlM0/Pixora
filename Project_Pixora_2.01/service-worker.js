const CACHE_NAME = "pixora-cache-v1";
const DYNAMIC_PAGES = [
  "main.php",
  "explore.php",
  "account.php",
  "post.php",
  "profile.php",
  "aboutUs.php",
  "likedPage.php"
];

const STATIC_ASSETS = [
  "css/style.css",
  "css/bootstrap.min.css",
  "js/bootstrap.bundle.min.js",
  "js/boxes_anim.js",
  "images/1.jpg",
  "images/2.jpg",
  "images/abth.png",
  "images/acc.jpg",
  "images/pixora_logo.png",
  "images/pixora_logo_only.png",
  "aboutUs.php",
  "Offline.html"
];

// Install event - cache static assets
self.addEventListener("install", (event) => {
  console.log("Service Worker: Installing...");
  event.waitUntil(
    caches.open(CACHE_NAME).then((cache) => {
      return cache.addAll(STATIC_ASSETS).then(() => {
        console.log("Service Worker: All static assets cached.");
      });
    })
  );
  self.skipWaiting();
});

// Activate event - clean up old caches
self.addEventListener("activate", (event) => {
  console.log("Service Worker: Activating...");
  event.waitUntil(
    caches.keys().then((cacheNames) => {
      return Promise.all(
        cacheNames.map((cache) => {
          if (cache !== CACHE_NAME) {
            console.log("Service Worker: Deleting old cache:", cache);
            return caches.delete(cache);
          }
        })
      );
    })
  );
  self.clients.claim();
});

// Fetch event - network-first for dynamic pages, cache-first for static assets
self.addEventListener("fetch", (event) => {
  const { request } = event;

  // Ignore non-GET requests
  if (request.method !== "GET") {
    return;
  }

  const requestUrl = new URL(request.url);

  // Network-first strategy for dynamic pages
  if (DYNAMIC_PAGES.some((page) => requestUrl.pathname.endsWith(page))) {
    event.respondWith(
      fetch(request)
        .then((networkResponse) => {
          // Clone the response immediately before consuming it
          const responseToCache = networkResponse.clone();

          // Update cache with the latest version
          caches.open(CACHE_NAME).then((cache) => {
            cache.put(request, responseToCache);
          });

          return networkResponse;
        })
        .catch(() => {
          // If network fails, try to serve from cache
          return caches.match(request).then((cachedResponse) => {
            if (cachedResponse) {
              return cachedResponse;
            } else {
              // If not in cache, serve offline fallback
              return caches.match("Offline.html");
            }
          });
        })
    );
    return;
  }

  // Cache-first strategy for static assets
  event.respondWith(
    caches.match(request).then((cachedResponse) => {
      return (
        cachedResponse ||
        fetch(request).then((networkResponse) => {
          // Clone the response immediately before consuming it
          const responseToCache = networkResponse.clone();

          // Cache the fetched static asset
          if (
            networkResponse &&
            networkResponse.status === 200 &&
            (request.destination === "style" ||
              request.destination === "script" ||
              request.destination === "image")
          ) {
            caches.open(CACHE_NAME).then((cache) => {
              cache.put(request, responseToCache);
            });
          }
          return networkResponse;
        })
      );
    })
  );
});
