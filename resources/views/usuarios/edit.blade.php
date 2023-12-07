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
                <x-content.nav-link href="{{ route('users.index') }}" class="ml-1 md:ml-2">Usuarios</x-content.nav-link>
            </li>
            <li class="flex items-center">
                <x-common.icon-row-nav />
                <x-content.nav-link-current>Editar</x-content.nav-link-current>
            </li>
        </ol>
    </nav>
    <div class="mt-2">
        <h1 class="text-xl mb-2 font-semibold text-gray-900 sm:text-2xl dark:text-white">
            Editar Usuario {{ $user->name }}
        </h1>
        <form method="POST" action="{{ route('users.update',$user) }}">
            @csrf
            @method('PUT')
            <div
                class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-md 2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800">
                <h3 class="mb-4 text-xl font-semibold dark:text-white">
                    Información General 
                </h3>
                <div class="grid grid-cols-6 gap-6">
                    <!-- ci -->
                    <div class="col-span-6 sm:col-span-3">
                        <label for="ci"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">CI</label>
                        <input type="text" name="ci" id="ci"
                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="8845545" value="{{ $user->ci }}" required />
                    </div>
                    <!-- nombre -->
                    <div class="col-span-6 sm:col-span-3">
                        <label for="name"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombres</label>
                        <input type="text" name="name" id="name"
                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Juan Daniel" value="{{ $user->name }}" required />
                    </div>
                    <!-- apellido_materno -->
                    <div class="col-span-6 sm:col-span-3">
                        <label for="ap_paterno"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Apellido
                            Paterno</label>
                        <input type="text" name="ap_paterno" id="ap_paterno"
                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Almazan" value="{{ $user->ap_paterno }}" required />
                    </div>
                    <!-- ap_materno -->
                    <div class="col-span-6 sm:col-span-3">
                        <label for="ap_materno"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Apellido
                            Materno</label>
                        <input type="text" name="ap_materno" id="ap_materno"
                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Contreras" value="{{ $user->ap_materno }}" required />
                    </div>
                    <!-- telefono -->
                    <div class="col-span-6 sm:col-span-3">
                        <label for="telefono"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Telefono
                            Celular</label>
                        <input type="text" name="telefono" id="telefono"
                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="78487848" value="{{ $user->telefono }}" required />
                    </div>
                </div>
            </div>
            
            <div
                class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-md 2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800">
                <h3 class="mb-4 text-xl font-semibold dark:text-white">
                    Información Ubicación
                </h3>
                <div class="grid grid-cols-6 gap-6">
                    <div class="col-span-6 sm:col-span-3">
                        <label for="departamento"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Departamento</label>
                        <select id="departamento" name="departamento"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="Beni">Beni</option>
                            <option value="Cochabamba">Cochabamba</option>
                            <option value="La Paz" selected>La Paz</option>
                            <option value="Oruro" selected>Oruro</option>
                            <option value="Pando" selected>Pando</option>
                            <option value="Potosi">Potosi</option>
                            <option value="Sucre">Sucre</option>
                            <option value="Santa Cruz" selected>Santa Cruz</option>
                            <option value="Tarija">Tarija</option>
                        </select>
                    </div>
                    <div class="col-span-6 sm:col-span-3">
                        <label for="localidad"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Localidad</label>
                        <x-common.input type="text" name="localidad" id="localidad"
                            placeholder="" required value="{{ old('localidad') }}" />
                        <x-jet-input-error for="localidad" />
                    </div>
                    <div class="col-span-6 sm:col-span-3">
                        <label for="barrio"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Barrio</label>
                        <x-common.input type="text" name="barrio" id="barrio"
                            placeholder="" required value="{{ old('barrio') }}" />
                        <x-jet-input-error for="barrio" />
                    </div>
                </div>
               
                <div class="grid grid-cols-6 gap-6">
                    <div class="col-span-12 sm:col-span-6">
                        <label for="direccion"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Direccion</label>
                        <input type="text" name="ubicacion" id="direccion"
                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Avenida, calle # X" value="{{ $user->ubicacion }}" required />
                    </div>
                    <div class="col-span-12 sm:col-span-6">
                        <div id="map" class="w-full h-72 rounded-lg"></div>
                        <input type="text" id='longitud' name="longitud" value="{{ $user->longitud }}" hidden />
                        <input type="text" id='latitud' name="latitud" value="{{ $user->latitud }}" hidden />
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
        Vistas: {{ getPageViews('usuarios_editar') }}
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