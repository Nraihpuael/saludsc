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
                        de calor</a>
                </div>
            </li>
            <li>
                <div class="flex items-center">
                    <svg aria-hidden="true" class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 dark:text-gray-400">Editando</span>
                </div>
            </li>

        </ol>
    </nav>
    <div class="mt-2">
        <h1 class="text-xl mb-2 font-semibold text-gray-900 sm:text-2xl dark:text-white">
            Editando Mapa de Infección
        </h1>
        <form method="POST" action="{{ route('mapas.update', $mapa) }}">
            @method('put')
            @csrf
            <div
                class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-md 2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800">
                <h3 class="mb-4 text-xl font-semibold dark:text-white">
                    Información General
                </h3>
                <div class="grid grid-cols-6 gap-6">
                    <!-- name mapa -->
                    <div class="col-span-6 sm:col-span-3">
                        <label for="name"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Titulo del Mapa</label>
                        <input type="text" name="name" id="name"
                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Infecciones de Dengue y Neumonia" required
                            value="{{ old('name', $mapa->name) }}" />
                    </div>


                    <div class="col-span-6 sm:col-span-3"></div>


                    <div class="col-span-6 sm:col-span-3">
                        <label for="detalle"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Detalle</label>
                        <textarea name="detalle" id="detalle" rows="4"
                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Detalle del mapa">{{ old('name', $mapa->detalle) }}</textarea>
                    </div>

                    <!-- enfermedades -->
                    <div class="col-span-6 sm:col-span-3">
                        <label for="enfermedades"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Seleccione las
                            Enfermedades
                            Virales</label>
                        <select id="enfermedadesID" multiple name="enfermedadesID[]" required
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            size="4" oninvalid="this.setCustomValidity('Selecciona al menos un campo')"
                            oninput="this.setCustomValidity('')">
                            @foreach ($enfermedades as $enfermedad)
                                <option value="{{ $enfermedad->id }}"
                                    {{ in_array($enfermedad->id, $enferGuardadas->toArray()) ? 'selected' : '' }}>
                                    {{ $enfermedad->nombre }}
                                </option>
                            @endforeach
                        </select>

                    </div>

                </div>
            </div>

            <div
                class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-md 2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800">
                <h3 class="mb-4 text-xl font-semibold dark:text-white">
                    Estableciendo Centro del Mapa
                </h3>
                <div class="grid grid-cols-6 gap-6">

                    <div class="col-span-12 sm:col-span-6">
                        <div id="map" class="w-full h-72 rounded-lg"></div>
                        <input type="text" id='latitud' name="latitud" value="{{ $mapa->latitud }}" hidden />
                        <input type="text" id='longitud' name="longitud" value="{{ $mapa->longitud }}" hidden />
                    </div>
                    <div class="col-span-6 sm:col-full">
                        <button onclick="validate()"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                            type="submit">Actualizar Mapa</button>
                    </div>
                </div>
            </div>

        </form>
    </div>
    <x-views>
        Vistas: {{ getPageViews('mapas_editar') }}
    </x-views>
    @push('scripts')
        <script>
            window.onload = function() {
                initMap();
            }


            // window.onload = initMap();

            function initMap() {
                const formulario = document.getElementById("formulario");
                var map;
                var marcador;
                var contador = 0;
                var latitud = document.getElementById('latitud').value;
                var longitud = document.getElementById('longitud').value;

                map = new google.maps.Map(document.getElementById('map'), {
                    center: {
                        lat: parseFloat(latitud),
                        lng: parseFloat(longitud)
                    },
                    zoom: 14
                });

                // Crear el marcador
                marcador = new google.maps.Marker({
                    position: {
                        lat: parseFloat(latitud),
                        lng: parseFloat(longitud)
                    },
                    map: map,
                    title: 'Centro del Mapa'
                });

                map.addListener("click", (e) => {
                    if (marcador) {
                        marcador.setMap(null);
                    }
                    placeMarkerAndPanTo(e.latLng, map);
                });

                function placeMarkerAndPanTo(latLng, map) {
                    if (contador > 0) {
                        marcador.setMap(null);
                    }
                    marcador = new google.maps.Marker({
                        position: latLng,
                        map: map,
                        title: 'Nuevo Centro del Mapa'
                    });
                    contador++;
                    map.panTo(latLng);
                    this.latitud.value = latLng.lat().toFixed(6);
                    this.longitud.value = latLng.lng().toFixed(6);
                }
            }


            function validate() {
                if (contador == 0) {
                    console.log('selecciona una ubicacion papi');
                }
            }
        </script>

        @if (session('success') == 'ok')
            <script>
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Actualizado',
                    showConfirmButton: false,
                    background: '#1f2937', // para el tema oscuro
                    iconColor: '#ffffff', // icono blanco
                    timer: 1500
                })
            </script>
        @endif

    @endpush

</x-app-layout>
