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
                <x-content.nav-link-current>Lista</x-content.nav-link-current>
            </li>
            <li class="flex items-center">
                <x-common.icon-row-nav />
                <x-content.nav-link-current>Agregar</x-content.nav-link-current>
            </li>
        </ol>
    </nav>
    <div class="mt-2">
        <h1 class="text-xl mb-2 font-semibold text-gray-900 sm:text-2xl dark:text-white">
            Agregar Usuario
        </h1>
        <div class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-md 2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800">
            <div class="items-center justify-between block sm:flex pb-4">
                <div class="flex items-center space-x-2 sm:space-x-3">
                    <h1 class="text-xl mb-2 font-semibold text-gray-900 sm:text-2xl dark:text-white">
                        Subir Archivo
                    </h1>
                    <form method="POST" action="{{ route('import.import') }}" enctype="multipart/form-data">
                        @csrf
                        <div style="display: flex; align-items: center;">
                            <input type="file" name="file" accept="image/*">
                            <x-common.button-csv-import></x-common.button-csv-import>
                        </div>
                    </form>
                </div>
            </div>
        </div>    

        <form method="POST" action="{{ route('users.store') }}" onsubmit="validate()">
            @csrf
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
                        <x-common.input type="number" name="ci" id="ci"
                            placeholder="8845545" step="1" required value="{{ old('ci') }}" />
                        <x-jet-input-error for="ci" />
                    </div>
                    <!-- nombre -->
                    <div class="col-span-6 sm:col-span-3">
                        <label for="name"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombres</label>
                        <x-common.input type="text" name="name" id="name"
                            placeholder="Juan Daniel" required value="{{ old('name') }}" />
                        <x-jet-input-error for="name" />
                    </div>
                    <!-- apellido_materno -->
                    <div class="col-span-6 sm:col-span-3">
                        <label for="ap_paterno"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Apellido
                            Paterno</label>
                        <x-common.input type="text" name="ap_paterno" id="ap_paterno"
                            placeholder="Almazan" required value="{{ old('ap_paterno') }}" />
                        <x-jet-input-error for="ap_paterno" />
                    </div>
                    <!-- ap_materno -->
                    <div class="col-span-6 sm:col-span-3">
                        <label for="ap_materno"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Apellido
                            Materno</label>
                        <x-common.input type="text" name="ap_materno" id="ap_materno"
                            placeholder="Contreras" required value="{{ old('ap_materno') }}" />
                        <x-jet-input-error for="ap_materno" />
                    </div>
                    <!-- telefono -->
                    <div class="col-span-6 sm:col-span-3">
                        <label for="telefono"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Telefono
                            Celular</label>
                        <x-common.input type="tel" name="telefono" id="telefono" pattern="[0-9]{8}"
                            placeholder="78487848" required value="{{ old('telefono') }}" />
                        <x-jet-input-error for="telefono" />
                    </div>
                    <div class="col-span-6 sm:col-span-3">
                        <label for="fecha_nac"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Fecha de
                            Nacimiento</label>
                        <x-common.input type="date" name="fecha_nac" id="fecha_nac"
                            placeholder="dd/mm/yyyy" required value="{{ old('fecha_nac') }}" />
                        <x-jet-input-error for="fecha_nac" />
                    </div>
                    <div class="col-span-6 sm:col-span-3">
                        <label for="genero"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Género</label>
                        <select id="genero" name="genero"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="M" selected>Masculino</option>
                            <option value="F">Femenino</option>
                        </select>
                    </div>

                </div>
            </div>
            <div
                class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-md 2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800">
                <h3 class="mb-4 text-xl font-semibold dark:text-white">
                    Credenciales del Usuario
                </h3>
                <div class="grid grid-cols-6 gap-6">
                    <!-- email -->
                    <div class="col-span-6 sm:col-span-3">
                        <label for="email"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                        <input type="email" name="email" id="email"
                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="example@company.com" required value="{{ old('email') }}" />
                        <x-jet-input-error for="email" />
                    </div>
                    <!-- contraseña -->
                    <div class="col-span-6 sm:col-span-3">
                        <label for="password"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Contraseña</label>
                        <x-common.input type="password"
                            id="password" name="password"
                            placeholder="••••••••" required value="{{ old('password') }}" />
                            <x-jet-input-error for="password" />
                    </div>
                    <!-- confirmar contraseña -->
                    <div class="col-span-6 sm:col-span-3">
                        <label for="password_confirmation"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Confirmar
                            Contraseña</label>
                        <input type="password" name="password_confirmation" id="password_confirmation"
                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="••••••••" required value="{{ old('password') }}" />
                            <x-jet-input-error for="password_confirmation" />
                    </div>
                    <!-- rol -->
                    <div class="col-span-6 sm:col-span-3">
                        <label for="role"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Rol</label>
                        <select id="role" name="role"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            @can('crear admin')
                            <option value="{{ $roles->get(0)->name }}">{{ $roles->get(0)->name }}</option>
                            @endcan
                            @can('crear funcionario')
                            <option value="{{ $roles->get(1)->name }}">{{ $roles->get(1)->name }}</option>
                            @endcan
                            @can('crear personal medico')
                            <option value="{{ $roles->get(2)->name }}">{{ $roles->get(2)->name }}</option>
                            @endcan
                            @can('crear paciente')
                            <option value="{{ $roles->get(3)->name }}">{{ $roles->get(3)->name }}</option>
                            @endcan
                        </select>
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
                            <option value="La Paz">La Paz</option>
                            <option value="Oruro">Oruro</option>
                            <option value="Pando">Pando</option>
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
                        <x-common.input type="text" name="ubicacion" id="direccion"
                            placeholder="Avenida, calle # X" required value="{{ old('ubicacion') }}" />
                            <x-jet-input-error for="ubicacion" />
                    </div>
                    <div class="col-span-12 sm:col-span-6">
                        <div id="map" class="w-full h-72 rounded-lg"></div>
                        <input type="text" id='longitud' name="longitud" hidden required
                            value="{{ old('longitud') }}" />
                        <input type="text" id='latitud' name="latitud" hidden required
                            value="{{ old('latitud') }}" />
                    </div>

                    <div class="col-span-6 sm:col-full">
                        <x-common.button
                            type="submit">Agregar</x-common.button>
                    </div>
                </div>
            </div>

        </form>
    </div>
    <x-views>
        Vistas: {{ getPageViews('usuarios_crear') }}
    </x-views>
    @push('scripts')
        <script>
            window.onload = function() {
                initMap();
            }

            const formulario = document.getElementById("formulario");
            const input = document.querySelector(".entrada");
            const elegido = document.getElementById("elegido");
            var map;
            var marcador;
            var contador = 0;
            var latitud = document.getElementById('latitud');
            var longitud = document.getElementById('longitud');
            var direccion = document.getElementById('direccion');
            // window.onload = initMap();

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
                if (latitud.value.length == 0 || longitud.value.length == 0) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Debes seleccionar la Ubicación!',
                    })
                    return false;
                } else {
                    return true;
                }
            }
        </script>
    @endpush

</x-app-layout>