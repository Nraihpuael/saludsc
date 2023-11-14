<x-app-layout>

    <nav class="flex mb-3" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li class="inline-flex items-center">
                <a href="{{ route('dashboard') }}"
                    class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                    <svg aria-hidden="true" class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z">
                        </path>
                    </svg>
                    Home
                </a>
            </li>
            <li>
                <div class="flex items-center">
                    <svg aria-hidden="true" class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <a href="{{ route('mapas.index') }}"
                        class="ml-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ml-2 dark:text-gray-400 dark:hover:text-white">Mapas
                        de Calor</a>
                </div>
            </li>
            <li aria-current="page">
                <div class="flex items-center">
                    <svg aria-hidden="true" class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 dark:text-gray-400">Visualizando</span>
                </div>
            </li>
        </ol>
    </nav>
    <div class="mt-2">
        <h1 class="text-xl mb-2 font-semibold text-gray-900 sm:text-2xl dark:text-white">
            Mapa de Calor
        </h1>
        <div class="items-center justify-between block sm:flex pb-4">


            <div class="flex items-center mb-4 sm:mb-0">

                <form class="sm:pr-3" action="#" method="GET">
                    <label for="search-input" class="sr-only">Search</label>
                    <div class="relative w-48 mt-1 sm:w-64 xl:w-96">
                        <input type="text" name="email" id="search-input"
                            class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Buscar" />
                    </div>
                </form>
                <div class="flex items-center w-full sm:justify-end">
                    <div class="flex pl-2 space-x-1">
                        <a id="search-button2" onclick="buscarUbi()"
                            class="inline-flex items-center justify-center w-1/2 px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 sm:w-auto dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                            data-drawer-target="drawer-create-product-default"
                            data-drawer-show="drawer-create-product-default"
                            aria-controls="drawer-create-product-default" data-drawer-placement="right">
                            Buscar
                        </a>
                    </div>
                </div>
            </div>

            <div class="flex items-center ml-auto space-x-2 sm:space-x-3">
                <button type="button" data-refresh onclick="window.location.href = '{{ route('mapas.index') }}'"
                    class="inline-flex items-center justify-center w-1/2 px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 sm:w-auto dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Volver
                </button>

            </div>
        </div>
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <div class="w-full">
                <div id="map" style="width: 100%; height: 500px"></div>
            </div>
        </div>
    </div>

    <x-views>
        Vistas: {{ getPageViews('mapas_ver') }}
    </x-views>

    @push('scripts')
        <script>
            let map, heatmap, coordinates;

            window.onload = function() {
                initMap();
            }

            function buscarUbi() {
                const input = document.getElementById("search-input");
                searchLocation(input.value);
            }

            function initMap() {
                var lati = {!! $mapa->latitud !!}
                var lngi = {!! $mapa->longitud !!}

                coordinates = {!! json_encode($puntos) !!};
                console.log('PUNTOS');
                console.log(coordinates);

                map = new google.maps.Map(document.getElementById("map"), {
                    zoom: 13,
                    center: {
                        lat: lati,
                        lng: lngi
                    },
                    mapTypeId: "satellite",
                });

                heatmap = new google.maps.visualization.HeatmapLayer({
                    data: getPoints(),
                    map: map,
                });

                heatmap.set("radius", heatmap.get("radius") ? null : 20);
            }

            function getPoints() {
                var points = [];
                for (var i = 0; i < coordinates.length; i++) {
                    var latLng = new google.maps.LatLng(coordinates[i].latitud, coordinates[i].longitud);
                    points.push(latLng);
                }
                console.log('PUNTOS DESDE FUNCION');
                console.log(points);
                return points;
            }

            function searchLocation(location) {
                if (location.trim() === "") {
                    return;
                }

                const geocoder = new google.maps.Geocoder();
                geocoder.geocode({
                    address: location
                }, (results, status) => {
                    if (status === "OK" && results.length > 0) {
                        // Limpiar marcadores existentes y dibujos
                        heatmap.setMap(null);
                        clearDrawings();

                        // Mostrar el nuevo lugar en el mapa
                        map.setCenter(results[0].geometry.location);
                        heatmap = new google.maps.visualization.HeatmapLayer({
                            data: [results[0].geometry.location],
                            map: map,
                        });
                        heatmap.set("radius", heatmap.get("radius") ? null : 20);

                        // Dibujar el área buscada con líneas segmentadas
                        const bounds = results[0].geometry.viewport;
                        const rectangle = new google.maps.Rectangle({
                            bounds: bounds,
                            strokeColor: "#000000",
                            strokeOpacity: 0.8,
                            strokeWeight: 2,
                            fillColor: "#000000",
                            fillOpacity: 0,
                            map: map,
                            clickable: false,
                            strokeDashArray: "10 5" // Líneas segmentadas
                        });
                        drawings.push(rectangle);

                        // Cargar los puntos nuevamente
                        points = getPoints();
                        heatmap.setData(points);

                    } else {
                        alert("No se pudo encontrar la ubicación.");
                    }
                });
            }

            function clearDrawings() {
                for (let i = 0; i < drawings.length; i++) {
                    drawings[i].setMap(null);
                }
                drawings = [];
            }

            let drawings = [];



            // // Para abajo es prueba de las mpodificaciones
            // var map = new google.maps.Map(document.getElementById('map'), {
            //     zoom: 10,
            //     center: {
            //         lat: 37.7749,
            //         lng: -122.4194
            //     }, // Centra el mapa en una ubicación específica
            // });

            // var center = {
            //     lat: 37.7749,
            //     lng: -122.4194
            // }; // Coordenadas del centro del círculo
            // var radius = 500; // Radio del círculo en metros

            // // Define una serie de colores para el degradado

            // var circle = new google.maps.Circle({
            //     strokeColor: '#F5DC09', // Color del borde del círculo
            //     strokeOpacity: 0.8, // Opacidad del borde
            //     strokeWeight: 6, // Grosor del borde
            //     fillColor: '#F22209', // Color de relleno del círculo (puede ser cualquier color)
            //     fillOpacity: 0.56, // Opacidad del relleno
            //     center: center, // Centro del círculo
            //     radius: radius, // Radio del círculo en metros
            // });

            // circle.setMap(map); // Agrega el círculo al mapa


            
        </script>
    @endpush
</x-app-layout>
