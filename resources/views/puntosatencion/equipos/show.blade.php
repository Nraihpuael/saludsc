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
                <x-content.nav-link href="{{ route('equipos.index') }}" class="ml-1 md:ml-2">Lista de Equipos
                </x-content.nav-link>
            </li>
            <li class="flex items-center">
                <x-common.icon-row-nav />
                <x-content.nav-link-current>Agregando</x-content.nav-link-current>
            </li>
        </ol>
    </nav>
    <div class="mt-2">
        <h1 class="text-xl mb-2 font-semibold text-gray-900 sm:text-2xl dark:text-white">
            Agregar Nuevo Equipo
        </h1>

        <div
            class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-md 2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800">
            <h3 class="mb-4 text-xl font-semibold dark:text-white">
                Información General
            </h3>
            <div class="grid grid-cols-6 gap-6">
                <!-- Nombre -->
                <div class="col-span-6 sm:col-span-3">
                    <label for="nombre"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre</label>
                    <input type="text" id="nombre" name="nombre" value="{{ $equipo->nombre }}" readonly
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>

                <div class="col-span-6 sm:col-span-3">
                    <label for="num_cuartos_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Cantidad
                    </label>
                    <input type="text" id="cantidad" name="cantidad" value="{{ $equipo->cantidad }}" readonly
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>

                <div class="col-span-6 sm:col-span-3">
                    <label for="num_camillas_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Descripcion
                    </label>
                    <textarea name="descripcion" id="descripcion" rows="2" readonly
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        >{{ $equipo->descripcion }}</textarea>
                </div>


                <div class="col-span-6 sm:col-span-3">
                    <label for="id_tipo_punto" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Punto de Atención
                    </label>
                    <input type="text" id="punto_atencion" name="punto_atencion" value="{{ $equipo->punto_atencions[0]->nombre }}" readonly
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>
                <div class="col-span-6 sm:col-full">
                    <button onclick="window.location.href = '{{ route('equipos.index') }}'"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                        type="submit">Volver</button>
                </div>
            </div>
        </div>

    </div>
    <x-views>
        Vistas: {{ getPageViews('equipos_ver') }}
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
