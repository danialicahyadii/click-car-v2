<script src="https://maps.googleapis.com/maps/api/js?key={{ env('API_G_MAPS') }}&libraries=places&callback=initMap" async defer></script>

<script>
    let map; // Variabel untuk menyimpan objek peta
    let directionsService;
    let directionsRenderer;

    // Fungsi inisialisasi peta
    function initMap() {
        // Buat objek peta
        map = new google.maps.Map(document.getElementById("map"), {
            center: { lat: -34.397, lng: 150.644 },
            zoom: 8,
        });

        // Inisialisasi DirectionsService dan DirectionsRenderer
        directionsService = new google.maps.DirectionsService();
        directionsRenderer = new google.maps.DirectionsRenderer({ map: map });

        // Inisialisasi Autocomplete untuk lokasi asal
        const originInput = document.getElementById("origin-input");
        const originAutocomplete = new google.maps.places.Autocomplete(originInput);
        originAutocomplete.bindTo("bounds", map);

        // Inisialisasi Autocomplete untuk lokasi tujuan
        const destinationInput = document.getElementById("destination-input");
        const destinationAutocomplete = new google.maps.places.Autocomplete(destinationInput);
        destinationAutocomplete.bindTo("bounds", map);

        // Tangani perubahan input di dalam elemen input lokasi asal
        originInput.addEventListener("input", function () {
            if (originInput.value.length >= 3 && destinationInput.value.length >= 3) {
                calculateAndDisplayRoute();
            }
        });

        // Tangani perubahan input di dalam elemen input lokasi tujuan
        destinationInput.addEventListener("input", function () {
            const destinationPlace = destinationAutocomplete.getPlace();

            if (destinationPlace && destinationPlace.geometry && destinationPlace.formatted_address && destinationPlace.formatted_address.length >= 3) {
                calculateAndDisplayRoute();
            }
        });
    }

    // Fungsi untuk menghitung dan menampilkan rute antara lokasi asal dan lokasi tujuan
    function calculateAndDisplayRoute() {
        const origin = document.getElementById("origin-input").value;
        const destination = document.getElementById("destination-input").value;

        // Periksa apakah lokasi asal dan tujuan memiliki panjang karakter yang memadai
        if (origin.length > 3 || destination.length > 3) {
            return; // Jika panjang karakter kurang dari 3, jangan lakukan pencarian
        }

        directionsService.route(
            {
                origin: origin,
                destination: destination,
                travelMode: google.maps.TravelMode.DRIVING,
            },
            function (response, status) {
                if (status === "OK") {
                    directionsRenderer.setDirections(response);
                } else {
                    // Tampilkan pesan kesalahan jika rute tidak ditemukan
                    alert("Rute tidak ditemukan: " + status);
                }
            }
        );
    }
</script>
