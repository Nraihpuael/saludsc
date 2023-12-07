<x-app-layout>
    @push('styles')

        <style>
            .fotito {
                width: 340px;
                height: 300px;
            }
        </style>
    @endpush

    <nav class="flex mb-3" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li class="inline-flex items-center">
                <a href="#"
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
                    <a href="{{ route('resultados.index') }}"
                        class="ml-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ml-2 dark:text-gray-400 dark:hover:text-white">Lista
                        de Resultados</a>
                </div>
            </li>
            <li class="flex items-center">
                <x-common.icon-row-nav />
                <x-content.nav-link-current>Creando</x-content.nav-link-current>
            </li>

        </ol>
    </nav>

    <div class="mt-2">
        <h1 class="text-xl mb-2 font-semibold text-gray-900 sm:text-2xl dark:text-white">
            Visualizando Resultado
        </h1>

        <div
            class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-md 2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800">
            <h3 class="mb-4 text-xl font-semibold dark:text-white">
                Información del Resultado
            </h3>
            <div class="grid grid-cols-6 gap-6">
                <div id="izq" class="col-span-6 sm:col-span-3">
                    <div>
                        <label for="titulo" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Asunto del Resultado</label>
                        <input type="text" name="titulo" id="titulo"
                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            value="{{ $resultado->titulo }}" readonly />
                    </div>
                    <div class="mt-4">
                        <label for="medico"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Paciente</label>
                        <input type="text" name="medico" id="medico"
                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            value=" {{ $resultado->atencion->paciente->name }} " readonly />
                    </div>
                    <div class="mt-4">
                        <label for="descripcion"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Observaciones o notas del Resultado</label>
                        <textarea name="descripcion" id="descripcion" rows="6"
                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            readonly>{{ $resultado->descripcion }}</textarea>
                    </div>
                </div>

                <div id="der" class="col-span-6 sm:col-span-3">
                    <div class="flex items-center justify-center">
                        <label for="titulo" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Dr.
                            {{ $resultado->atencion->medico->name }} </label>
                    </div>

                    <div class="bg-white dark:bg-gray-800 p-4 flex items-center justify-center rounded-md">
                        <img class="fotito rounded-lg shadow-md"
                            src="https://cdn.create.vista.com/api/media/small/359790962/stock-photo-confident-male-doctor-white-lab"
                            alt="">
                    </div>

                </div>
            </div>

            <div class="col-span-6 sm:col-full" style="margin-top: 10px;">
                <button onclick="window.location.href = '{{ route('resultados.index') }}'" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                    type="button">Volver</button>
            </div>

        </div>

    </div>
    <x-views>
        Vistas: {{ getPageViews('resultados_ver') }}
    </x-views>
</x-app-layout>
