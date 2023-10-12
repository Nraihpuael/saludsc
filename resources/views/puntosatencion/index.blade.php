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
                <x-content.nav-link href="#" class="ml-1 md:ml-2">Puntos de Atención</x-content.nav-link>
            </li>
            <li class="flex items-center">
                <x-common.icon-row-nav />
                <x-content.nav-link-current>Lista</x-content.nav-link-current>
            </li>
        </ol>
    </nav>
    <div class="mt-3">
        <h1 class="text-xl mb-2 font-semibold text-gray-900 sm:text-2xl dark:text-white">
            Todos los Puntos de Atención
        </h1>
        <div class="items-center justify-between block sm:flex pb-4">
            <div class="flex items-center mb-4 sm:mb-0">
                {{-- <form class="sm:pr-3" action="#" method="GET">
                    <label for="products-search" class="sr-only">Search</label>
                    <div class="relative w-48 mt-1 sm:w-64 xl:w-96">
                        <input type="text" name="email" id="products-search"
                            class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Buscar" />
                    </div>
                </form> --}}
                
            </div>

            
                
                
            

            <div class="flex items-center ml-auto space-x-2 sm:space-x-3">
                <x-common.button onclick="window.location.href = '{{ route('visualizar.ver') }}'">
                    <x-common.icon-create />
                    Visualizar Hospitales
                </x-common.button>

                <x-common.button onclick="window.location.href = '{{ route('puntosatencion.create') }}'">
                    <x-common.icon-create />
                    Agregar
                </x-common.button>
            </div>
        </div>

        <x-common.table class="table-fixed">
            <x-common.table-head>
                <tr>
                    {{-- <th scope="col" class="p-4">
                        <div class="flex items-center">
                            <input id="checkbox-all-search" type="checkbox"
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="checkbox-all-search" class="sr-only">checkbox</label>
                        </div>
                    </th> --}}
                    <th scope="col" class="px-6 py-3 w-1/7">
                        Nombre
                    </th>
                    <th scope="col" class="px-6 py-3 w-5/14">
                        Ubicación
                    </th>
                    <th scope="col" class="px-6 py-3 w-1/6">
                        Nº Camillas
                    </th>
                    <th scope="col" class="px-6 py-3 w-1/6">
                        Tipo
                    </th>
                    <th scope="col" class="px-6 py-3 w-1/4">
                        Acción
                    </th>
                </tr>
            </x-common.table-head>
            <tbody>
                @foreach ($puntosatencion as $punto)
                    <x-common.table-row>
                        {{-- <td class="w-4 p-4">
                            <div class="flex items-center">
                                <input id="checkbox-table-search-1-{{$punto->id}}" type="checkbox" oninput="llamar(this.value)"
                                value="{{ $punto->id }}"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="checkbox-table-search-1" class="sr-only">checkbox</label>
                            </div>
                        </td> --}}
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $punto->nombre }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $punto->ubicacion }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $punto->num_camillas }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $punto->tipo->nombre }}
                        </td>
                        <td class="flex px-6 py-4">
                            <a href="{{ route('puntosatencion.edit', $punto->id) }}"
                                class="mr-2 font-medium text-blue-600 dark:text-blue-500 hover:underline">Editar</a>
                            <a href="{{ route('puntosatencion.show', $punto->id) }}"
                                class="mr-2 font-medium text-green-600 dark:text-green-500 hover:underline">Ver más</a>

                            <form method="POST" action="{{ route('puntosatencion.destroy',$punto->id) }}" ">
                                @csrf
                                @method('DELETE')
                                <button class="switch-icon switch-icon-fade" style = "color: red">Eliminar</button>
                            </form>   
                        </td>
                    </x-common.table-row>
                @endforeach
            </tbody>
        </x-common.table>
        <div class="mt-3">
            {{ $puntosatencion->links() }}
        </div>
    </div>
    <x-views>
        Vistas: {{ getPageViews('puntos_atencion_inicio') }}
    </x-views>
</x-app-layout>
