const formulario = document.getElementById("formulario");
const input = document.querySelector(".entrada");
const elegido = document.getElementById("elegido");
var map;
var marcador;
var contador = 0;
var latitud = document.getElementById('latitud');
var longitud = document.getElementById('longitud');
var direccion = document.getElementById('direccion');
window.onload = initMap();

function initMap() {
    map = new google.maps.Map(document.getElementById('map'), {
        center: {
            lat: -17.795768,
            lng: -63.167202
        },
        zoom: 14
    });

    map.addListener("click", (e) => {
        placeMarkerAndPanTo(e.latLng, map);
    });

    function placeMarkerAndPanTo(latLng, map) {
        if (contador > 0) {
            marcador.setMap(null);
        }
        marcador = new google.maps.Marker({
            position: latLng,
            map: map,
        });
        contador++;
        map.panTo(latLng);
        this.latitud.value = latLng.lat().toFixed(6);
        this.longitud.value = latLng.lng().toFixed(6);


        decodeDirection(latLng);
    }

    function decodeDirection(latLng) {
        const geocoder = new google.maps.Geocoder();

        geocoder.geocode({
            location: latLng
        }, (results, status) => {
            if (status === "OK") {
                if (results[0]) {
                    const direccion = results[0].formatted_address;
                    this.direccion.value = direccion; // Aquí tienes la dirección como una cadena de texto
                } else {
                    this.direccion.value = 'Direccion desconocida'
                }
            } else {
                console.log("La solicitud de geocodificación inversa falló debido a: " + status);
            }
        });
    }
}


function validate() {
    if (contador == 0) {
        console.log('selecciona una ubicacion papi');
    }
}