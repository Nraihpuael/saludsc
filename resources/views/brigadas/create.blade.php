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
                <x-content.nav-link href="{{ route('brigadas.index') }}" class="ml-1 md:ml-2">Lista Brigadas
                </x-content.nav-link>
            </li>
            <li class="flex items-center">
                <x-common.icon-row-nav />
                <x-content.nav-link-current>Creando</x-content.nav-link-current>
            </li>
        </ol>
    </nav>
    <div class="mt-2">
        <h1 class="text-xl mb-2 font-semibold text-gray-900 sm:text-2xl dark:text-white">
            Creando Brigada
        </h1>
        <form method="POST" action="{{ route('brigadas.store') }}" onsubmit="return validate()">
            @csrf

            <div
                class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-md 2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800">
                <h3 class="mb-4 text-xl font-semibold dark:text-white">
                    Información General
                </h3>
                <div class="grid grid-cols-6 gap-6">

                    <div class="col-span-6 sm:col-span-3">
                        <div>
                            <label for="name"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre de la
                                Brigada</label>
                            <input type="text" name="name" id="name"
                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Brigada de Dengue..." required />
                        </div>

                        <div>
                            <label for="enfermedades"
                                class="block mt-3 mb-2 text-sm font-medium text-gray-900 dark:text-white">Seleccione la
                                Zona</label>
                            <select id="lugar_id" name="lugar_id" required
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                oninvalid="this.setCustomValidity('Selecciona al menos un campo')"
                                oninput="this.setCustomValidity('')">
                                @foreach ($lugares as $lugar)
                                    <option value="{{ $lugar->id }}">{{ $lugar->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-span-6 sm:col-span-3">
                        <label for="users"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Seleccione los
                            Integrantes</label>
                        <select id="usersID" multiple name="usersID[]" required
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            size="5" oninvalid="this.setCustomValidity('Selecciona al menos un campo')"
                            oninput="this.setCustomValidity('')">
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>


                    <div class="col-span-6 sm:col-full">
                        <button
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                            type="submit">Crear</button>
                    </div>
                </div>

            </div>


        </form>
    </div>
    <x-views>
        Vistas: {{ getPageViews('brigadas_crear') }}
    </x-views>
    @push('scripts')

        @if (session('success') == 'ok')
            <script>
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Creado',
                    showConfirmButton: false,
                    background: '#1f2937', // para el tema oscuro
                    iconColor: '#ffffff', // icono blanco
                    timer: 1500
                })
            </script>
        @endif

    @endpush

</x-app-layout>
