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
                <x-content.nav-link href="{{ route('users.index') }}" class="ml-1 md:ml-2">Usuarios</x-content.nav-link>
            </li>
            <li class="flex items-center">
                <x-common.icon-row-nav />
                <x-content.nav-link-current>Lista</x-content.nav-link-current>
            </li>
        </ol>
    </nav>
    <div class="mt-2">
        <h1 class="text-xl mb-2 font-semibold text-gray-900 sm:text-2xl dark:text-white">
            Todos los Usuarios
        </h1>
        <div class="items-center block sm:flex pb-4">
            <div class="items-center mb-4 sm:mb-0">
                <form class="flex sm:pr-3" action="{{ route('users.index') }}" method="GET">
                    <div class="relative w-48 mt-1 sm:w-64 xl:w-96">
                        <x-common.input id="textSearch" name="textSearch" placeholder="Buscar"
                            value="{{ $textSearch }}" />
                    </div>
                    <div class="ml-2 w-48 mt-1 sm:w-48 xl:w-64">
                        <select id="role" name="role"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            @can('crear admin')
                                <option {{ $rol == $sRoles->get(0)->name ? 'selected' : '' }}
                                    value="{{ $sRoles->get(0)->name }}">{{ $sRoles->get(0)->name }}</option>
                            @endcan
                            @can('crear funcionario')
                                <option {{ $rol == $sRoles->get(1)->name ? 'selected' : '' }}
                                    value="{{ $sRoles->get(1)->name }}">{{ $sRoles->get(1)->name }}</option>
                            @endcan
                            @can('crear personal medico')
                                <option {{ $rol == $sRoles->get(2)->name ? 'selected' : '' }}
                                    value="{{ $sRoles->get(2)->name }}">{{ $sRoles->get(2)->name }}</option>
                            @endcan
                            @can('crear paciente')
                                <option {{ $rol == $sRoles->get(3)->name ? 'selected' : '' }}
                                    value="{{ $sRoles->get(3)->name }}">{{ $sRoles->get(3)->name }}</option>
                            @endcan
                        </select>
                    </div>
                    <div class="flex items-center justify-end">
                        <div class="pl-2">
                            <x-common.button class="w-auto" type="submit">
                                <svg class="w-5 h-5 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                </svg>
                            </x-common.button>
                        </div>
                    </div>

                </form>
                {{-- <div class="flex items-center w-full sm:justify-end">
                    <div class="flex pl-2 space-x-1">
                        <a href="#"
                            class="inline-flex justify-center p-1 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </a>
                        <a href="#"
                            class="inline-flex justify-center p-1 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </a>
                        <a href="#"
                            class="inline-flex justify-center p-1 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </a>
                        <a href="#"
                            class="inline-flex justify-center p-1 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z">
                                </path>
                            </svg>
                        </a>
                    </div>
                </div> --}}
            </div>

            <div class="flex items-center ml-auto space-x-3 sm:space-x-3">
                <x-common.button-link href="{{ route('users.index') }}">
                    <svg class="w-5 h-5 mr-2 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 20 18">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m2.133 2.6 5.856 6.9L8 14l4 3 .011-7.5 5.856-6.9a1 1 0 0 0-.804-1.6H2.937a1 1 0 0 0-.804 1.6Z" />
                    </svg>
                    Quitar filtros
                </x-common.button-link>
                <x-common.button-csv href="{{ route('users.export') }}">
                </x-common.button-csv>
                @can('agregar usuario')
                    <x-common.button-link href="{{ route('users.create') }}">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                clip-rule="evenodd"></path>
                        </svg>
                        Agregar
                    </x-common.button-link>
                @endcan
            </div>
        </div>
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table id="datatable" class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="p-4">
                            CI
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Nombre
                        </th>
                        <th scope="col" class="px-4 py-3">
                            Rol
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Estado
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Acción
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($users) <= 0)
                        <tr>
                            <td colspan="5" class="pt-3 text-center">
                                No se encontraron resultados
                            </td>
                        </tr>
                    @else
                        @foreach ($users as $user)
                            <tr
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <td class="w-4 p-4">
                                    {{ $user->ci }}
                                </td>
                                <th scope="row"
                                    class="flex items-center px-2 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                                    @if ($user->profile_photo_path)
                                        <img class="w-8 h-8 rounded-full object-cover"
                                            src="{{ asset('storage/' . $user->profile_photo_path) }}" alt="user photo">
                                    @else
                                        <img class="w-8 h-8 rounded-full" src="{{ $user->profile_photo_url }}"
                                            alt="user photo">
                                    @endif
                                    <div class="pl-3">
                                        <div class="text-base font-semibold">
                                            {{ $user->name . ' ' . $user->ap_paterno . ' ' . $user->ap_materno }}</div>
                                        <div class="font-normal text-gray-500">{{ $user->email }}</div>
                                    </div>
                                </th>
                                <td class="px-4 py-4">
                                    @forelse ($user->roles as $role)
                                        {{ $role->name }}
                                    @empty
                                        Sin rol
                                    @endforelse
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        @if ($user->estado == 1)
                                            <span id="activo{{ $user->id }}"
                                                class="bg-green-100 text-green-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">
                                                Activo</span>
                                            <span id="inactivo{{ $user->id }}" hidden
                                                class="bg-red-100 text-red-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">
                                                Inactivo</span>
                                        @else
                                            <span id="activo{{ $user->id }}" hidden
                                                class="bg-green-100 text-green-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">
                                                Activo</span>
                                            <span id="inactivo{{ $user->id }}"
                                                class="bg-red-100 text-red-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">
                                                Inactivo</span>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <a href="{{ route('users.edit', $user->id) }}"
                                        class="mr-2 font-medium text-blue-600 dark:text-blue-500 hover:underline">Editar</a>
                                    @can('cambiar estado usuario')
                                        @if ($user->estado == 1)
                                            <a id="inhabilitar{{ $user->id }}"
                                                onclick="inhabilitarF({{ $user->id }})"
                                                class="font-medium text-red-600 dark:text-red-500 hover:underline">Inhabilitar</a>
                                            <a id="habilitar{{ $user->id }}" hidden
                                                onclick="habilitarF({{ $user->id }})"
                                                class="mr-2 font-medium text-green-600 dark:text-green-500 hover:underline">Habilitar</a>
                                        @else
                                            <a id="habilitar{{ $user->id }}"
                                                onclick="habilitarF({{ $user->id }})"
                                                class="mr-2 font-medium text-green-600 dark:text-green-500 hover:underline">Habilitar</a>
                                            <a id="inhabilitar{{ $user->id }}" hidden
                                                onclick="inhabilitarF({{ $user->id }})"
                                                class="font-medium text-red-600 dark:text-red-500 hover:underline">Inhabilitar</a>
                                        @endif
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
        <div class="mt-2">
            {{ $users->links() }}
        </div>
    </div>
    <x-views>
        Vistas: {{ getPageViews('usuarios_inicio') }}
    </x-views>
    @push('scripts')
        <script>
            function habilitarF(user_id) {
                let activo = document.getElementById('activo' + user_id);
                let inactivo = document.getElementById('inactivo' + user_id);
                let habilitar = document.getElementById('habilitar' + user_id);
                let inhabilitar = document.getElementById('inhabilitar' + user_id);
                $.ajax({
                    type: "POST",
                    url: "{{ route('users.cambiarEstado') }}",
                    data: {
                        id: user_id
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    dataType: 'JSON',
                    success: function(response) {
                        activo.hidden = false;
                        inactivo.hidden = true;
                        habilitar.hidden = true;
                        inhabilitar.hidden = false;
                        toastr.options = {
                            "closeButton": true,
                            "progressBar": true
                        };
                        toastr.success(response.message);
                    },
                    error: function(response) {
                        toastr.options = {
                            "closeButton": true,
                            "progressBar": true
                        };
                        toastr.error(response.error);
                    },
                });
            };

            function inhabilitarF(user_id) {
                let activo = document.getElementById('activo' + user_id);
                let inactivo = document.getElementById('inactivo' + user_id);
                let habilitar = document.getElementById('habilitar' + user_id);
                let inhabilitar = document.getElementById('inhabilitar' + user_id);
                $.ajax({
                    type: "POST",
                    url: "{{ route('users.cambiarEstado') }}",
                    data: {
                        id: user_id
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    dataType: 'JSON',
                    success: function(response) {
                        activo.hidden = true;
                        inactivo.hidden = false;
                        habilitar.hidden = false;
                        inhabilitar.hidden = true;
                        toastr.options = {
                            "closeButton": true,
                            "progressBar": true
                        };
                        toastr.success(response.message);
                    },
                    error: function(response) {
                        toastr.options = {
                            "closeButton": true,
                            "progressBar": true
                        };
                        toastr.error(response.error);
                    },
                });
            };
        </script>
    @endpush
</x-app-layout>
