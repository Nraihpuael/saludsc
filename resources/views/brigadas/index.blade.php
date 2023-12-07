<x-app-layout>
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
            <li aria-current="page">
                <div class="flex items-center">
                    <svg aria-hidden="true" class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 dark:text-gray-400">Lista
                        Brigadas</span>
                </div>
            </li>
        </ol>
    </nav>
    <div class="mt-3">
        <h1 class="text-xl mb-2 font-semibold text-gray-900 sm:text-2xl dark:text-white">
            Todos los Tipos de Puntos de Atención
        </h1>
        <div class="items-center justify-between block sm:flex pb-4">
            <div class="flex items-center mb-4 sm:mb-0">
                <form class="sm:pr-3" action="#" method="GET">
                    <label for="products-search" class="sr-only">Search</label>
                    <div class="relative w-48 mt-1 sm:w-64 xl:w-96">
                        <input type="text" name="email" id="products-search"
                            class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Buscar" />
                    </div>
                </form>

            </div>

            <div class="flex items-center ml-auto space-x-2 sm:space-x-3">

                <button id="createProductButton" onclick="window.location.href = '{{ route('brigadas.create') }}'"
                    class="inline-flex items-center justify-center w-1/2 px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 sm:w-auto"
                    type="button" data-drawer-target="drawer-create-product-default"
                    data-drawer-show="drawer-create-product-default" aria-controls="drawer-create-product-default"
                    data-drawer-placement="right">
                    <svg class="w-5 h-5 mr-2 -ml-1" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                            clip-rule="evenodd"></path>
                    </svg>
                    Agregar
                </button>
            </div>
        </div>
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>

                        <th scope="col" class="px-6 py-3">
                            Nombre
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Fecha Inicio
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Fecha Fin
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Lugar
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Acción
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($brigadas as $brigada)
                        <tr
                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">

                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $brigada->name }}
                            </th>
                            <td class="px-6 py-4">
                                {{ $brigada->fecha_ini }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $brigada->fecha_fin }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $brigada->lugar->name }}
                            </td>
                            <td class="px-6 py-4">
                                <a href="{{ route('brigadas.edit', $brigada) }}"
                                    class="mr-2 font-medium text-blue-600 dark:text-blue-500 hover:underline">Editar</a>
                                <a href="{{ route('brigadas.show', $brigada) }}"
                                    class="mr-2 font-medium text-green-600 dark:text-green-500 hover:underline">Ver</a>
                                <a href="#" onclick="event.preventDefault(); confirmDelete({{ $brigada->id }})"
                                    class="font-medium text-red-600 dark:text-red-500 hover:underline">Eliminar</a>

                                <form id="delete-form-brigada-{{ $brigada->id }}"
                                    action="{{ route('brigadas.destroy', $brigada) }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-3">
            {{ $brigadas->links() }}
        </div>
    </div>
    <x-views>
        Vistas: {{ getPageViews('brigadas_inicio') }}
    </x-views>
    @push('scripts')
        <script>
            function confirmDelete(formId) {
                Swal.fire({
                    title: 'Seguro quieres Eliminar?',
                    text: "No habrá vuelta atrás!",
                    icon: 'warning',
                    showCancelButton: true,
                    background: '#1f2937',
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, Eliminarlo!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Eliminado',
                            showConfirmButton: false,
                            background: '#1f2937', // para el tema oscuro
                            iconColor: '#ffffff', // icono blanco
                            timer: 1500
                        });

                        setTimeout(function() {
                            document.getElementById('delete-form-brigada-' + formId).submit();
                        }, 1000);
                    }
                });
            }
        </script>
    @endpush
</x-app-layout>
