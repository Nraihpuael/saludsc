<x-app-layout>
    @push('styles')
        <link rel="stylesheet" type="text/css"
            href="https://unpkg.com/file-upload-with-preview@4.1.0/dist/file-upload-with-preview.min.css" />

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
                    <a href="{{ route('atenciones.index') }}"
                        class="ml-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ml-2 dark:text-gray-400 dark:hover:text-white">Lista
                        de Atenciones</a>
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
            Visualizando Atención
        </h1>

        <div
            class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-md 2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800">
            <h3 class="mb-4 text-xl font-semibold dark:text-white">
                Información de la Atención
            </h3>
            <div class="grid grid-cols-6 gap-6">
                <div id="izq" class="col-span-6 sm:col-span-3">
                    <div>
                        <label for="titulo" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Razón
                            de la Atención</label>
                        <input type="text" name="titulo" id="titulo"
                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            value="{{ $atencione->titulo }}" readonly />
                    </div>
                    <div class="mt-4">
                        <label for="medico"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Paciente</label>
                        <input type="text" name="medico" id="medico"
                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            value=" {{ $atencione->paciente->name }} " readonly />
                    </div>
                    <div class="mt-4">
                        <label for="descripcion"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Sintomas y
                            antecedentes</label>
                        <textarea name="descripcion" id="descripcion" rows="6"
                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            readonly>{{ $atencione->descripcion }}</textarea>
                    </div>
                </div>

                <div id="der" class="col-span-6 sm:col-span-3">
                    <div class="flex items-center justify-center">
                        <label for="titulo" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Dr.
                            {{ $atencione->medico->name }} </label>
                    </div>

                    <div class="bg-white dark:bg-gray-800 p-4 flex items-center justify-center rounded-md">
                        <img class="fotito rounded-lg shadow-md"
                            src="https://cdn.create.vista.com/api/media/small/359790962/stock-photo-confident-male-doctor-white-lab"
                            alt="">
                    </div>

                </div>
            </div>

            <div class="col-span-6 sm:col-full" style="margin-top: 10px;">
                <button
                    @if (isset($atencione->resultado)) disabled 
                        class="block text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800" 
                    @else
                        class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" 
                    @endif
                    data-modal-target="responder-modal" data-modal-toggle="responder-modal" type="button">
                    @if (isset($atencione->resultado))
                        Atendido
                    @else
                        Atender
                    @endif
                </button>
            </div>

        </div>

    </div>

    <div class="mt-2">
        <h1 class="text-xl mb-2 font-semibold text-gray-900 sm:text-2xl dark:text-white">
            Fotos de Pruebas
        </h1>

        <div class="grid grid-cols-1 gap-6">
            <div class="col-span-12">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-4 gap-4">
                    @foreach ($atencione->fotos as $foto)
                        <div
                            class="bg-white border border-gray-200 shadow-md dark:border-gray-700 dark:bg-gray-800 p-4 flex items-center justify-center rounded-md">
                            <a href="{{ asset($foto->uri) }}" target="_blank">
                                <img class="h-auto max-w-full rounded-lg shadow-md" src="{{ asset($foto->uri) }}"
                                    alt="">
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>



    <!-- Main modal -->

    <div id="responder-modal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true"
        class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <button type="button"
                    class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-hide="responder-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
                <div class="px-6 py-6 lg:px-8">
                    <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Respondiendo Consulta</h3>
                    <form class="space-y-6" method="POST" action="{{ route('resultados.store') }}">
                        @csrf

                        <div>
                            <label for="titulo"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Asunto</label>
                            <input type="text" name="titulo" id="titulo"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                required>
                        </div>
                        <div>
                            <label for="password"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Observaciones o
                                notas</label>
                            <textarea name="descripcion" id="descripcion" rows="6"
                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                required></textarea>
                        </div>

                        <input type="hidden" name="atencion_id" value="{{ $atencione->id }}">

                        <button type="submit"
                            class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            Enviar al Paciente
                        </button>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <x-views>
        Vistas: {{ getPageViews('antenciones_ver') }}
    </x-views>
    @push('scripts')

        @if (session('success') == 'ok')
            <script>
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Enviado',
                    showConfirmButton: false,
                    background: '#1f2937', //para el tema oscuro
                    iconColor: '#ffffff', // icono blanco
                    timer: 1500
                })
            </script>
        @endif
    @endpush
</x-app-layout>
