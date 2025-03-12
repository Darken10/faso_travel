console.log("tes")
document.addEventListener('DOMContentLoaded', function () {
    if (sessionStorage.getItem('get-location')) {
        sessionStorage.removeItem('get-location');
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
                function (position) {
                    let lat = position.coords.latitude;
                    let lng = position.coords.longitude;

                    document.getElementById('latField').value = lat;
                    document.getElementById('lngField').value = lng;

                    // Mettre à jour Livewire si utilisé
                    if (typeof Livewire !== 'undefined') {
                        Livewire.emit('updateLocation', { lat, lng });
                    }
                },
                function (error) {
                    console.error("Erreur de géolocalisation :", error);
                }
            );
        } else {
            console.error("Géolocalisation non supportée par ce navigateur.");
        }
    }
});
