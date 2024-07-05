<x-karyawan-layout>
    <!-- Main page content -->
    <div class="row h-100">
        <div class="col-auto align-self-center">
            <a href="/absen" class="btn btn-link back-btn text-color-theme">
                <i class="bi bi-arrow-left size-20"></i>
            </a>
        </div>
        <div class="col text-center align-self-center">
            <h3 class="mb-0">Buat Absens</h3>
        </div>
    </div>

    <div class="row h-100 text-center mt-4">
        <div>
            @csrf
            <div class="card card-light shadow-sm mb-4">
                <div class="card-body">
                    <div class="row justify-content-center">
                        <h6 class="mb-3">Isi Absen</h6>
                        <div class="col-12 col-md-6 mb-4">
                            <div class="card shadow-sm">
                                {{-- maps start --}}
                                <div class="card-body">
                                    <div id="map" class="h-190 w-100 rounded mb-3" style="height: 400px;"></div>
                                </div>
                                {{-- maps end --}}
                            </div>
                        </div>
                        <div class="col-12 col-md-6 mb-4 text-center">
                            <div id="my_camera"></div>
                            <input type="button" class="btn btn-primary mt-2" value="Take Snapshot" onClick="takeSnapshot()">
                            <input type="button" id="retry-button" class="btn btn-secondary mt-2" value="Ulangi" onClick="retrySnapshot()" style="display: none;">
                        </div>
                    </div>
                </div>
            </div>
            {{-- Output start --}}
            <form method="POST" action="/absen/store" class="card card-light shadow-sm d-none" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="row justify-content-center">
                        <h6 class="mb-3">Data Absen</h6>
                        <div class="col-12 col-md-6 mb-4" id="output-card" style="display: none;">
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <h6 class="text-primary">Submit Absensi</h6>
                                    <p class="text-opac">{{ $nama }}</p>
                                    <p class="text-opac" id="distance-info"></p>
                                    <p class="text-opac">Jam : <span id="time"></span></p>
                                    <p class="text-opac">Latitude: <span id="latitude-output"></span></p>
                                    <p class="text-opac">Longitude: <span id="longitude-output"></span></p>
                                    <input type="hidden" id="waktu_masuk" name="waktu_masuk">
                                    <input type="hidden" id="bukti" name="bukti" class="image-tag">
                                    <input type="hidden" id="latitude" name="latitude">
                                    <input type="hidden" id="longitude" name="longitude">
                                    <input type="hidden" id="jarak" name="jarak">
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 mb-4">
                            <div id="results">Your captured image will appear here...</div>
                        </div>
                    </div>
                    <button id="submit-button" type="submit" class="btn btn-default btn-lg w-100" disabled>Absen</button>
                </div>
            </form>

        </div>
    </div>

    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.26/webcam.min.js"></script>

    <script language="JavaScript">
        function showToast(type, title, message) {
            iziToast[type]({
                title: title,
                message: message,
                position: 'bottomRight'
            });
        }

        $(document).ready(function() {
            // Initialize Webcam
            Webcam.set({
                width: 400,
                height: 300,
                image_format: 'jpeg',
                jpeg_quality: 90
            });

            Webcam.attach('#my_camera');

            $("#my_camera").css({
                "width": "100%",
                "margin": "auto"
            });

            $("video").addClass("img-fluid");
        });

        function takeSnapshot() {
            Webcam.snap(function(data_uri) {
                // Tampilkan preview gambar
                let img = document.createElement('img');
                img.src = data_uri;
                img.className = 'img-fluid';
                let results = document.getElementById('results');
                results.innerHTML = '';
                results.appendChild(img);

                // Simpan data URI ke hidden input field
                document.querySelector('.image-tag').value = data_uri;

                // Tampilkan output card untuk submit
                document.getElementById('output-card').style.display = 'block';
                document.getElementById('retry-button').style.display = 'inline-block';
                $("form").removeClass("d-none");

                // Set waktu saat ini
                let now = new Date();
                document.getElementById('time').innerText = now.toLocaleTimeString();
                document.getElementById('waktu_masuk').value = now.toISOString().split('.')[0].replace('T', ' ');

                // Aktifkan tombol submit
                document.getElementById('submit-button').disabled = false;
            });
        }

        function retrySnapshot() {
            document.getElementById('results').innerHTML = '';
            document.getElementById('results').setAttribute('hidden', true);
            document.getElementById('output-card').style.display = 'none';
            document.getElementById('retry-button').style.display = 'none';
            Webcam.attach('#my_camera');
            $("form").addClass("d-none");
        }
    </script>
    <script>
        // Initialize Map
        let map = L.map('map').setView([0, 0], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        let marker = L.marker([0, 0]).addTo(map);

        // let allowedLocation = L.latLng(-1.616122, 103.592451); // Ganti dengan koordinat lokasi yang diizinkan
        let allowedLocation = L.latLng(-1.6160256,103.5922094);
        let maxDistance = 100; // dalam meter, misal 50 meter

        // Add a marker and circle for the allowed location
        let allowedMarker = L.marker(allowedLocation).addTo(map)
            .bindPopup('Lokasi yang diizinkan').openPopup();
        L.circle(allowedLocation, { radius: maxDistance }).addTo(map);

        function onLocationFound(e) {
            let radius = e.accuracy / 2;
            marker.setLatLng(e.latlng)
                .bindPopup("You are within " + radius + " meters from this point").openPopup();

            L.circle(e.latlng, radius).addTo(map);

            // Update hidden input fields and output card
            document.getElementById('latitude').value = e.latlng.lat;
            document.getElementById('longitude').value = e.latlng.lng;
            document.getElementById('latitude-output').innerText = e.latlng.lat;
            document.getElementById('longitude-output').innerText = e.latlng.lng;

            // Check distance from allowed location
            let userLocation = e.latlng;
            let distance = userLocation.distanceTo(allowedLocation);

            if (distance <= maxDistance) {
                document.getElementById('submit-button').removeAttribute('disabled');
                document.getElementById('distance-info').innerHTML = '<span class="text-success">Jarak: ' + distance.toFixed(2) + ' meter dari lokasi yang diizinkan</span>';
                document.getElementById('jarak').value = e.latlng.lng;
            } else {
                document.getElementById('submit-button').setAttribute('disabled', 'disabled');
                document.getElementById('distance-info').innerHTML = '<span class="text-danger">Jarak Lebih dari ' + (maxDistance/1000) + ' KM dari lokasi yang diizinkan</span>';
                // alert('Anda harus berada di lokasi yang dii  zinkan untuk melakukan absen.');
                showToast('error', 'Error', 'Anda harus berada di lokasi yang diizinkan untuk melakukan absen.');
            }
        }

        function onLocationError(e) {
            alert(e.message);
        }

        // Try HTML5 geolocation
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                let initialLocation = L.latLng(position.coords.latitude, position.coords.longitude);
                map.setView(initialLocation, 16); // Set peta pada lokasi pengguna
                marker.setLatLng(initialLocation); // Tandai lokasi pengguna dengan marker

                // Trigger location found event
                onLocationFound({
                    latlng: initialLocation,
                    accuracy: 0 // Menetapkan akurasi 0 karena data lokasi sudah pasti
                });
            }, function() {
                onLocationError({ message: "Geolocation failed." });
            });
        } else {
            // Browser tidak mendukung geolocation
            onLocationError({ message: "Geolocation is not supported by this browser." });
        }

        map.on('locationerror', onLocationError);
    </script>
    <!-- Main page content ends -->
</x-karyawan-layout>
