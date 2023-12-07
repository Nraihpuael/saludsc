<x-app-layout>
    <nav class="flex mb-3" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li class="inline-flex items-center">
                <x-content.nav-link href="/dashboard" class="inline-flex items-center">
                    <x-common.icon-home />
                    Home
                </x-content.nav-link>
            </li>
            <li class="flex items-center">
                <x-common.icon-row-nav />
                <x-content.nav-link href="{{ route('puntosatencion.index') }}" class="ml-1 md:ml-2">Puntos de Atención</x-content.nav-link>
            </li>
            <li class="flex items-center">
                <x-common.icon-row-nav />
                <x-content.nav-link-current>Agregar</x-content.nav-link-current>
            </li>
        </ol>
    </nav>
    <div class="mt-2">
        <h1 class="text-xl mb-2 font-semibold text-gray-900 sm:text-2xl dark:text-white">
            Agregar Nuevo Punto de Atencion
        </h1>

        <form action="{{ route('puntosatencion.store') }}" method="POST">
            @csrf
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
                        <input type="text" id="nombre_id" name="nombre"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"> 
                    </div>

                    <!-- Numero de camillas -->
                    <div class="col-span-6 sm:col-span-3">
                        <label for="num_camillas_id"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Numero de camillas</label>
                        <input type="text" id="num_camillas_id" name="num_camillas"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"> 
                    </div>

                    <!-- Numero de Cuartos -->
                    <div class="col-span-6 sm:col-span-3">
                        <label for="num_cuartos_id"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Numero de Cuartos</label>
                        <input type="text" id="num_cuartos_id" name="num_cuartos"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"> 
                    </div>

                   
                    <!-- Tipo -->
                    <div class="col-span-6 sm:col-span-3">
                        <label for="id_tipo_punto"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tipo de Punto de Atención</label>
                        <select id="id_tipo_punto" name="id_tipo_punto"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            @foreach ($tipos as $tipo)
                                <option value="{{ $tipo->id }}">{{ $tipo->nombre }}</option>
                            @endforeach
                        </select>
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
                        <select id="red_id" name="red"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="CENTRO">Centro</option>                    
                            <option value="SUR">Sur</option>
                            <option value="NORTE">Norte</option>
                            <option value="ESTE">Este</option>
                        </select>
                    </div>

                    <div class="col-span-6 sm:col-span-3">
                        <label for="distrito_id"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Distrito</label>
                        <select id="distrito_id" name="distrito"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            @for($i = 1; $i <= 15; $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </div>

                    <div class="col-span-12 sm:col-span-6">
                        <label for="direccion"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Direccion</label>
                        <input type="text" name="ubicacion" id="direccion"
                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Avenida, calle # X"  />
                    </div>
                    <div class="col-span-12 sm:col-span-6">
                        <div id="map" class="w-full h-72 rounded-lg"></div>
                        <input type="text" id='longitud' name="longitud" hidden />
                        <input type="text" id='latitud' name="latitud" hidden />
                    </div>
                    <div class="col-span-6 sm:col-full">
                        <button onclick="validate()"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                            type="submit">Agregar</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <x-views>
        Vistas: {{ getPageViews('puntos_atencion_crear') }}
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
        </script>
    @endpush
</x-app-layout>
