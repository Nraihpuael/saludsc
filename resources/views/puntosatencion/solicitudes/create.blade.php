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
                <x-content.nav-link href="{{ route('solicitudes.index') }}" class="ml-1 md:ml-2">Lista de Solicitudes</x-content.nav-link>
            </li>
            <li class="flex items-center">
                <x-common.icon-row-nav />
                <x-content.nav-link-current>Creando</x-content.nav-link-current>
            </li>
        </ol>
    </nav>
    <div class="mt-2">
        <h1 class="text-xl mb-2 font-semibold text-gray-900 sm:text-2xl dark:text-white">
            Creando Solicitud
        </h1>
        <form method="POST" action="{{ route('solicitudes.store') }}" onsubmit="validate()">
            @csrf
            <div
                class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-md 2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800">
                <h3 class="mb-4 text-xl font-semibold dark:text-white">
                    Información de la Solicitud
                </h3>
                <div class="grid grid-cols-6 gap-6">
                    <!-- ci -->
                    <div class="col-span-6 sm:col-span-3">
                        <label for="titulo"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Titulo</label>
                        <input type="text" name="titulo" id="titulo"
                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Solicito atencion en..." required value="{{ old('titulo') }}" />
                        <x-jet-input-error for="titulo" />
                    </div>
                    <div class="col-span-6 sm:col-span-3">
                        <label for="punto_atencion_id"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Punto de
                            Atencion</label>
                        <select id="punto_atencion_id" name="punto_atencion_id"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            @foreach ($puntos as $punto)
                                <option value="{{ $punto->id }}">{{ $punto->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-span-6 sm:col-span-3">
                        <label for="descripcion"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Descripcion</label>
                        <textarea name="descripcion" id="descripcion" rows="4"
                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Detalle su solicitud...">{{ old('descripcion') }}</textarea>
                        <x-jet-input-error for="descripcion" />
                    </div>
                    <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                    <input type="hidden" name="estado" value="0">
                    <div class="col-span-6 sm:col-full">
                        <button
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                            type="submit">Enviar</button>
                    </div>
                </div>

            </div>


        </form>
    </div>
    <x-views>
        Vistas: {{ getPageViews('solicitudes_crear') }}
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
