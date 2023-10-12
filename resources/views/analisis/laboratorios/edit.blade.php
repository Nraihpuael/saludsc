<x-app-layout>
    @push('styles')
        <style>
            .switch {
                position: relative;
                display: inline-block;
                width: 60px;
                height: 34px;
            }

            .switch input {
                display: none;
            }

            .slider {
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background-color: #ccc;
                border-radius: 34px;
                transition: 0.4s;
            }

            .slider:before {
                position: absolute;
                content: "";
                height: 26px;
                width: 26px;
                left: 4px;
                bottom: 4px;
                background-color: white;
                border-radius: 50%;
                transition: 0.4s;
            }

            .switch input:checked+.slider {
                background-color: #4f83d6;
            }

            .switch input:checked+.slider:before {
                transform: translateX(26px);
            }
        </style>
    @endpush
    <nav class="flex mb-3" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li class="inline-flex items-center">
                <a href="{{ route('laboratorios.index') }}"
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
                    <a href="{{ route('laboratorios.index') }}"
                        class="ml-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ml-2 dark:text-gray-400 dark:hover:text-white">
                        Lista de Resultados de laboratorio
                    </a>
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
                    <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 dark:text-gray-400">Editando</span>
                </div>
            </li>
        </ol>
    </nav>
    <div class="mt-2">
        <h1 class="text-xl mb-2 font-semibold text-gray-900 sm:text-2xl dark:text-white">
            Editando Un Caso
        </h1>
        <form method="POST" action="{{ route('laboratorios.update', $caso) }}">
            @csrf
            @method('put')
            <div
                class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-md 2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800">
                <h3 class="mb-4 text-xl font-semibold dark:text-white">
                    Información del Caso
                </h3>
                <div class="grid grid-cols-6 gap-6">
                    <!-- user -->
                    <div class="col-span-6 sm:col-span-3">
                        <label for="estadia_enfermedad_id"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Paciente</label>
                        <input type="text" name="estadia_enfermedad_id" id="estadia_enfermedad_id"
                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            value="{{ $caso->name }}" readonly />
                    </div>

                    <div class="col-span-6 sm:col-span-3">
                        <label for="fecha_toma"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Fecha de Toma</label>
                        <x-common.input type="date" name="fecha_toma" id="fecha_toma"
                            placeholder="{{ old('fecha_toma', $caso->fecha_toma) }}" value="{{ old('fecha_toma', $caso->fecha_toma) }}" />
                        <x-jet-input-error for="fecha_toma" />
                    </div>

                    <!-- Hospitalizado -->
                    <div class="col-span-6 sm:col-span-3">
                        <label for="hospitalizado"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Hospitalizado</label>
                        <select id="hospitalizado" name="hospitalizado"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="Si" {{ $caso->hospitalizado === 'Si' ? 'selected' : '' }}>Si</option>
                            <option value="NO" {{ $caso->hospitalizado === 'NO' ? 'selected' : '' }}>NO</option>
                            <option value="Sin Datos" {{ $caso->hospitalizado === 'Sin Datos' ? 'selected' : '' }}>Sin Datos</option>
                        </select>
                    </div>

                    <div class="col-span-6 sm:col-span-3">
                        <label for="resultado"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Resultado</label>
                        <select id="resultado" name="resultado"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="POSITIVO DENGUE" {{ $caso->hospitalizado === 'POSITIVO DENGUE' ? 'selected' : '' }}>POSITIVO DENGUE</option>
                            <option value="NEGATIVO DENGUE" {{ $caso->hospitalizado === 'NEGATIVO DENGUE' ? 'selected' : '' }}>NEGATIVO DENGUE</option>
                        </select>
                    </div>

                    {{-- Detalle del registro --}}
                    <div class="col-span-6 sm:col-span-3">
                        <label for="observaciones"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Detalle</label>
                        <textarea name="observaciones" id="observaciones" rows="4"
                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Ingrese observaciones">{{ old('detalle', $caso->observaciones) }}</textarea>
                    </div>

                                        

                    <div class="col-span-6 sm:col-span-3">
                        <label for="fecha" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Finalizar Caso?
                        </label>
                        <label class="switch">
                            @if (is_null($caso->fecha_fin))
                                <input type="checkbox" name="mySwitch">
                            @else
                                <input type="checkbox" name="mySwitch" checked>
                            @endif
                            <span class="slider"></span>
                        </label>

                    </div>

                </div>

                <div class="col-span-6 sm:col-full" style="margin-top: 10px;">
                    <button onclick="validate()"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                        type="submit">Actualizar</button>
                </div>
            </div>

        </form>
    </div>
    <x-views>
        Vistas: {{ getPageViews('laboratorio_editar') }}
    </x-views>
    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        @if (session('success') == 'ok')
            <script>
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Actualizado',
                    showConfirmButton: false,
                    background: '#1f2937', //para el tema oscuro
                    iconColor: '#ffffff', // icono blanco
                    timer: 1500
                })
            </script>
        @endif
    @endpush
</x-app-layout>