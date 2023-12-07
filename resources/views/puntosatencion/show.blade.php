<x-app-layout>
    <nav class="flex mb-3" aria-label="Breadcrumb">
        <ol class="inline-flex items-cen`ter space-x-1 md:space-x-3">
            <li class="inline-flex items-center">
                <x-content.nav-link href="/dashboard" class="inline-flex items-center">
                    <x-common.icon-home />
                    Home
                </x-content.nav-link>
            </li>
            <li class="flex items-center">
                <x-common.icon-row-nav />
                <x-content.nav-link href="{{ route('puntosatencion.index') }}" class="ml-1 md:ml-2">Puntos de Atención
                </x-content.nav-link>
            </li>
            <li class="flex items-center">
                <x-common.icon-row-nav />
                <x-content.nav-link-current>{{ $puntosatencion->nombre }}</x-content.nav-link-current>
            </li>
            <li class="flex items-center">
                <x-common.icon-row-nav />
                <x-content.nav-link-current>Informacion</x-content.nav-link-current>
            </li>
        </ol>
    </nav>
    <div class="mt-2">
        <div class="items-center mb-4 justify-between block sm:flex">
            <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">
                Editar Punto de Atencion {{ $puntosatencion->nombre }}
            </h1>
            <form action="{{ route('trabajadores.index') }}" method="GET">
                <input type="text" name="punto_atencion_id" value="{{$puntosatencion->id}}" hidden/>
                <x-common.button type="submit">
                    <svg class="w-5 h-5 mr-2 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4.333 6.764a3 3 0 1 1 3.141-5.023M2.5 16H1v-2a4 4 0 0 1 4-4m7.379-8.121a3 3 0 1 1 2.976 5M15 10a4 4 0 0 1 4 4v2h-1.761M13 7a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm-4 6h2a4 4 0 0 1 4 4v2H5v-2a4 4 0 0 1 4-4Z" />
                    </svg>
                    Ver Trabajadores
                </x-common.button>
            </form>

        </div>

        <div
            class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-md 2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800">
            <h3 class="mb-4 text-xl font-semibold dark:text-white">
                Información General
            </h3>
            <div class="grid grid-cols-6 gap-6">
                <!-- Nombre -->
                <div class="col-span-6 sm:col-span-3">
                    <label for="nombre_id"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre</label>
                    <input type="text" id="nombre_id" name="nombre" readonly
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        value="{{ $puntosatencion->nombre }}">
                </div>

                <!-- Numero de camillas -->
                <div class="col-span-6 sm:col-span-3">
                    <label for="num_camillas_id"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Numero de
                        camillas</label>
                    <input type="text" id="num_camillas_id" name="num_camillas" readonly
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        value="{{ $puntosatencion->num_camillas }}">

                </div>

                <!-- Numero de Cuartos -->
                <div class="col-span-6 sm:col-span-3">
                    <label for="num_cuartos_id"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Numero de
                        Cuartos</label>
                    <input type="text" id="num_cuartos_id" name="num_cuartos" readonly
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        value="{{ $puntosatencion->num_cuartos }}">
                </div>


                <!-- Tipo -->
                <div class="col-span-6 sm:col-span-3">
                    <label for="id_tipo_punto" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tipo
                        de Punto de
                        Atención</label>
                    <input type="text" id="id_tipo_punto" name="tipo_punto" readonly
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        value="{{ $tipo }}">
                </div>

                <div class="col-span-6 sm:col-full">
                    <label for="equipos" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Equipos
                    </label>
                    <textarea readonly name="descripcion" id="descripcion" rows="2" required
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">@foreach ($puntosatencion->equipos as $equipo) {{ $equipo->nombre }} {{ $equipo->cantidad }}, @endforeach</textarea>
                </div>

            </div>
        </div>
        <div
            class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-md 2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800">
            <h3 class="mb-4 text-xl font-semibold dark:text-white">
                Información General
            </h3>
            <h3 class="mb-4 text-xl font-semibold dark:text-white">
                Información de Ubicación
            </h3>
            <div class="grid grid-cols-6 gap-6">
                <div class="col-span-6 sm:col-span-3">
                    <label for="red_id"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Red</label>
                    <input type="text" id="red_id" name="red" readonly
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        value="{{ $puntosatencion->red }}">
                </div>

                <div class="col-span-6 sm:col-span-3">
                    <label for="distrito_id"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Distrito</label>
                    <input type="text" id="distrito_id" name="distrito" readonly
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        value="{{ $puntosatencion->distrito }}">
                </div>

                <div class="col-span-12 sm:col-span-6">
                    <label for="direccion"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Direccion</label>
                    <input type="text" name="ubicacion" id="direccion"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        placeholder="Avenida, calle # X" value="{{ $puntosatencion->ubicacion }}" required />
                </div>
                <div class="col-span-12 sm:col-span-6">
                    <div id="map" class="w-full h-72 rounded-lg"></div>
                    <input type="text" id='longitud' name="longitud" value="{{ $puntosatencion->longitud }}"
                        hidden />
                    <input type="text" id='latitud' name="latitud" value="{{ $puntosatencion->latitud }}"
                        hidden />
                </div>
            </div>
        </div>

    </div>
    <x-views>
        Vistas: {{ getPageViews('puntos_atencion_ver') }}
    </x-views>
    @push('scripts')
        <script>
            const formulario = document.getElementById("formulario");
            const input = document.querySelector(".entrada");
            const elegido = document.getElementById("elegido");
            var map;
            var marcador;
            var contador = 0;
            var latitud = document.getElementById('latitud');
            var longitud = document.getElementById('longitud');
            var direccion = document.getElementById('direccion');

            var latit = parseFloat(latitud.value);
            var longit = parseFloat(longitud.value);

            window.onload = function() {
                initMap();
            }

            function initMap() {
                map = new google.maps.Map(document.getElementById('map'), {
                    center: {
                        lat: -17.795768,
                        lng: -63.167202
                    },
                    zoom: 14
                });

                if (latit && longit) {
                    var ltng = new google.maps.LatLng(latit, longit);
                    placeMarkerAndPanTo(ltng, map);
                }

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
                    console.log('selecciona una ubi raton');
                }
            }
        </script>
    @endpush

</x-app-layout>
