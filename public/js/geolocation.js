document.addEventListener("DOMContentLoaded", function () {
    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
                function (position) {
                    let latitude = position.coords.latitude;
                    let longitude = position.coords.longitude;

                    // Remplir automatiquement les champs
                    document.getElementById("lat").value = latitude;
                    document.getElementById("lng").value = longitude;

                    // Optionnel : Afficher une alerte
                    console.log("Position mise à jour :", latitude, longitude);

                    // Obtenir l'adresse approximative via une API (OpenStreetMap)
                    fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${latitude}&lon=${longitude}`)
                        .then(response => response.json())
                        .then(data => {
                            if (data.display_name) {
                                document.getElementById("adresse").value = data.display_name;
                            }
                        })
                        .catch(error => console.error("Erreur lors de la récupération de l'adresse :", error));
                },
                function (error) {
                    console.error("Erreur de géolocalisation :", error.message);
                }
            );
        } else {
            console.error("La géolocalisation n'est pas supportée par ce navigateur.");
        }
    }

    // Exécuter automatiquement au chargement de la page
    getLocation();

    // Rafraîchir la position manuellement si besoin
    document.getElementById("refreshLocation").addEventListener("click", getLocation);
});
