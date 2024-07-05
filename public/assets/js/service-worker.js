const CACHE_NAME = 'Absensi';
const urlsToCache = [
  '/',
  '/assets/css/style.css',
  '/assets/vendor/swiperjs-6.6.2/swiper-bundle.min.css',
  '/assets/img/favicon32.png',
  '/assets/img/favicon16.png',
  '/assets/vendor/bootstrap-5/js/bootstrap.bundle.min.js',
  // Tambahkan semua URL yang ingin kamu cache di sini
];

self.addEventListener('install', event => {
  event.waitUntil(
    caches.open(CACHE_NAME)
      .then(cache => {
        return cache.addAll(urlsToCache);
      })
  );
});

self.addEventListener('fetch', event => {
  event.respondWith(
    caches.match(event.request)
      .then(response => {
        if (response) {
          return response;
        }
        return fetch(event.request);
      })
  );
});