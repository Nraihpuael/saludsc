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
                <x-content.nav-link-current>Lista de Equipos</x-content.nav-link-current>
            </li>
        </ol>
    </nav>
    <div class="mt-3">
        <h1 class="text-xl mb-2 font-semibold text-gray-900 sm:text-2xl dark:text-white">
            Todos los Equipos
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

                <x-common.button onclick="window.location.href = '{{ route('equipos.create') }}'">
                    <x-common.icon-create />
                    Agregar
                </x-common.button>
            </div>
        </div>

        <x-common.table>
            <x-common.table-head>
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Nombre
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Cantidad
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Punto de Atención
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Acción
                    </th>
                </tr>
            </x-common.table-head>
            <tbody>
                @foreach ($equipos as $equipo)
                    <x-common.table-row>
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $equipo->nombre }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $equipo->cantidad }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $equipo->punto_atencions[0]->nombre }}
                        </td>

                        <td class="px-6 py-4">
                            <a href="{{ route('equipos.edit', $equipo) }}"
                                class="mr-2 font-medium text-blue-600 dark:text-blue-500 hover:underline">Editar</a>
                            <a href="{{ route('equipos.show', $equipo) }}"
                                class="mr-2 font-medium text-green-600 dark:text-green-500 hover:underline">Ver</a>

                            <a href="#" onclick="event.preventDefault(); confirmDelete({{ $equipo->id }})"
                                class="font-medium text-red-600 dark:text-red-500 hover:underline">Eliminar</a>

                            <form id="delete-form-brigada-{{ $equipo->id }}"
                                action="{{ route('equipos.destroy', $equipo) }}" method="POST" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </x-common.table-row>
                @endforeach
            </tbody>
        </x-common.table>
        <div class="mt-3">
            {{ $equipos->links() }}
        </div>
    </div>
    <x-views>
        Vistas: {{ getPageViews('equipos_inicio') }}
    </x-views>
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
</x-app-layout>
