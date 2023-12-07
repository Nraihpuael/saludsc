<x-app-layout>
    <nav class="flex mb-3" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li class="inline-flex items-center">
                <a href="{{ route('registrarcasosPunto.index') }}"
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
                    <a href="{{ route('registrarcasosBrigada.index') }}"
                        class="ml-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ml-2 dark:text-gray-400 dark:hover:text-white">Lista
                        de Casos Brigadas</a>
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
                    <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 dark:text-gray-400">Creando</span>
                </div>
            </li>
        </ol>
    </nav>
    <div class="mt-2">
        <h1 class="text-xl mb-2 font-semibold text-gray-900 sm:text-2xl dark:text-white">
            Agregar Nuevo Caso
        </h1>
        <form method="POST" action="{{ route('registrarcasosBrigada.store') }}">
            @csrf
            <div
                class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-md 2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800">
                <h3 class="mb-4 text-xl font-semibold dark:text-white">
                    Información del Caso
                </h3>
                <div class="grid grid-cols-6 gap-6">
                    <!-- user -->
                    <div class="col-span-6 sm:col-span-3">
                        <label for="user_id"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Paciente</label>
                        <select id="user_id" name="user_id"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <!-- Estado -->
                    <div class="col-span-6 sm:col-span-3">
                        <label for="estado_id"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Estado</label>
                        <select id="estado_id" name="estado_id"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            @foreach ($estados as $estado)
                                <option value="{{ $estado->id }}">{{ $estado->estado }}</option>
                            @endforeach
                        </select>
                    </div>
                    <!-- Enfermedad -->
                    <div class="col-span-6 sm:col-span-3">
                        <label for="enfermedad_id"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Enfermedad</label>
                        <select id="enfermedad_id" name="enfermedad_id"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            @foreach ($enfermedades as $enfermedad)
                                <option value="{{ $enfermedad->id }}">{{ $enfermedad->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Brigada -->
                    <div class="col-span-6 sm:col-span-3">
                        <label for="brigada_id"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Brigada</label>
                        <select id="brigada_id" name="brigada_id"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            @foreach ($brigadas as $brigada)
                                <option value="{{ $brigada->id }}">{{ $brigada->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Detalle del registro --}}
                    <div class="col-span-6 sm:col-span-3">
                        <label for="detalle"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Detalle</label>
                        <textarea name="detalle" id="detalle" rows="4"
                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Ingrese detalles del registros"></textarea>
                    </div>


                    <div class="col-span-6 sm:col-span-3">
                        <label for="detalle"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Seleccione los Sintomas</label>
                        <select id="sintoma_id" multiple name="sintoma_id[]" required
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            size="4" oninvalid="this.setCustomValidity('Selecciona al menos un campo')"
                            oninput="this.setCustomValidity('')">
                            @foreach ($sintomas as $sintoma)
                                <option value="{{ $sintoma->id }}">{{ $sintoma->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                </div>

                <div class="col-span-6 sm:col-full" style="margin-top: 10px;">
                    <button onclick="validate()"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                        type="submit">Agregar</button>
                </div>
            </div>

        </form>
    </div>
    <x-views>
        Vistas: {{ getPageViews('caso_brigada_crear') }}
    </x-views>
    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        @if (session('success') == 'ok')
            <script>
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Agregado',
                    showConfirmButton: false,
                    background: '#1f2937', //para el tema oscuro
                    iconColor: '#ffffff', // icono blanco
                    timer: 1500
                })
            </script>
        @endif
    @endpush
</x-app-layout>
