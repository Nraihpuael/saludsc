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
                <x-content.nav-link href="{{ route('puntosatencion.index') }}" class="ml-1 md:ml-2">Puntos de Atención
                </x-content.nav-link>
            </li>
            <li class="flex items-center">
                <x-common.icon-row-nav />
                <x-content.nav-link href="{{ route('puntosatencion.show', $puntoAtencion->id) }}">
                    {{ $puntoAtencion->nombre }}
                </x-content.nav-link>
            </li>
            <li class="flex items-center">
                <x-common.icon-row-nav />
                <x-content.nav-link-current>Informacion de Medicos</x-content.nav-link-current>
            </li>
        </ol>
    </nav>
    <div class="mt-2">
        <div class="items-center mb-4 justify-between block sm:flex">
            <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">
                Trabajadores en el punto de atención {{ $puntoAtencion->nombre }}
            </h1>
        </div>

        <div
            class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-md 2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800">
            <h3 class="mb-4 text-xl font-semibold dark:text-white">
                Personal Médico Disponible
            </h3>
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
                                Cargo
                            </th>
                            <th scope="col" class="px-4 py-3">
                                Fecha Entrada
                            </th>
                            <th scope="col" class="px-4 py-3">
                                Fecha Salida
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
                        @if (count($trabajadores) <= 0)
                            <tr>
                                <td colspan="5" class="pt-3 text-center">
                                    No se encontraron resultados
                                </td>
                            </tr>
                        @else
                            @foreach ($trabajadores as $trabajador)
                                <tr
                                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <td class="w-4 p-4">
                                        {{ $trabajador->medico->ci }}
                                    </td>
                                    <td scope="row"
                                        class="flex items-center px-2 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                                        @if ($trabajador->medico->profile_photo_path)
                                            <img class="w-8 h-8 rounded-full object-cover"
                                                src="{{ asset('storage/' . $trabajador->medico->profile_photo_path) }}"
                                                alt="user photo">
                                        @else
                                            <img class="w-8 h-8 rounded-full"
                                                src="{{ $trabajador->medico->profile_photo_url }}" alt="user photo">
                                        @endif
                                        <div class="pl-3">
                                            <div class="text-base font-semibold">
                                                {{ $trabajador->medico->name . ' ' . $trabajador->medico->ap_paterno . ' ' . $trabajador->medico->ap_materno }}
                                            </div>
                                            <div class="font-normal text-gray-500">{{ $trabajador->medico->email }}
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-4">
                                        {{$trabajador->cargo}}
                                    </td>
                                    <td class="px-4 py-4">
                                        {{$trabajador->fecha_ini}}
                                    </td>
                                    <td class="px-4 py-4">
                                        {{$trabajador->fecha_fin}}
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center">
                                            @if ($trabajador->medico->estado == 1)
                                                <span
                                                    class="bg-green-100 text-green-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">
                                                    Activo</span>
                                            @else
                                                <span
                                                    class="bg-red-100 text-red-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">
                                                    Inactivo</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <a href="{{ route('trabajadores.quitar', $trabajador->id) }}"
                                            class="mr-2 font-medium text-red-600 dark:text-red-500 hover:underline">Declinar</a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
        <div
            class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-md 2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800">
            <h3 class="mb-4 text-xl font-semibold dark:text-white">
                Lista de Personal Médico
            </h3>
            <form action="{{ route('trabajadores.agregar') }}" method="POST">
            <div class="grid grid-cols-6 gap-6 mb-6">
                    @csrf
                    <div class="col-span-6 sm:col-span-3">
                        <label for="fecha_ini"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Fecha
                            Entrada</label>
                        <x-common.input type="date" name="fecha_ini" id="fecha_ini"
                            value="{{ old('fecha_ini') }}" />
                        <x-jet-input-error for="fecha_ini" />
                    </div>
                    <div class="col-span-6 sm:col-span-3">
                        <label for="fecha_fin"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Fecha
                            Salida (Opcional)</label>
                        <x-common.input type="date" name="fecha_fin" id="fecha_fin"
                            value="{{ old('fecha_fin') }}" />
                        <x-jet-input-error for="fecha_fin" />
                    </div>
                    <div class="col-span-6 sm:col-span-3">
                        <label for="cargo"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Cargo</label>
                        <x-common.input type="text" name="cargo" id="cargo" value="{{ old('cargo') }}" />
                        <x-jet-input-error for="cargo" />
                    </div>
                    <div class="col-span-6 sm:col-span-3">
                        <label for="user_id"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Personal Médico</label>
                        <select id="user_id" name="user_id"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            @foreach ($medicos as $medico)
                                <option value="{{ $medico->id }}" selected>
                                    {{ $medico->name . ' ' . $medico->ap_paterno . ' ' . $medico->ap_materno }}</option>
                            @endforeach
                        </select>
                    </div>
                    <input type="text" name="punto_atencion_id" id="punto_atencion_id" hidden value="{{ $puntoAtencion->id }}"/>
                    <x-common.button type="submit">
                        Agregar
                    </x-common.button>
                </div>
            </form>
            {{-- <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
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
                        @if (count($medicos) <= 0)
                            <tr>
                                <td colspan="5" class="pt-3 text-center">
                                    No se encontraron resultados
                                </td>
                            </tr>
                        @else
                            @foreach ($medicos as $medico)
                                <tr
                                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <td class="w-4 p-4">
                                        {{ $medico->ci }}
                                    </td>
                                    <th scope="row"
                                        class="flex items-center px-2 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                                        @if ($medico->profile_photo_path)
                                            <img class="w-8 h-8 rounded-full object-cover"
                                                src="{{ asset('storage/' . $medico->profile_photo_path) }}"
                                                alt="user photo">
                                        @else
                                            <img class="w-8 h-8 rounded-full" src="{{ $medico->profile_photo_url }}"
                                                alt="user photo">
                                        @endif
                                        <div class="pl-3">
                                            <div class="text-base font-semibold">
                                                {{ $medico->name . ' ' . $medico->ap_paterno . ' ' . $medico->ap_materno }}
                                            </div>
                                            <div class="font-normal text-gray-500">{{ $medico->email }}</div>
                                        </div>
                                    </th>
                                    <td class="px-4 py-4">
                                        @forelse ($medico->roles as $role)
                                            {{ $role->name }}
                                        @empty
                                            Sin rol
                                        @endforelse
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center">
                                            @if ($medico->estado == 1)
                                                <span
                                                    class="bg-green-100 text-green-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">
                                                    Activo</span>
                                            @else
                                                <span
                                                    class="bg-red-100 text-red-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">
                                                    Inactivo</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <a type="button" onclick="agregar({{$medico->id}}, {{$puntoAtencion->id}})"
                                            class="mr-2 font-medium text-green-600 dark:text-green-500 hover:underline">Agregar</a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div> --}}
        </div>

    </div>
    <x-views>
        Vistas: {{ getPageViews('puntos_atencion_trabajadores') }}
    </x-views>
    {{-- @push('scripts')
        <script>
            var cargo = document.getElementById('cargo');
            var fecha_ini = document.getElementById('fecha_ini');
            var fecha_fin = document.getElementById('fecha_fin');

            function agregar(user_id, punto_id) {
                var data = {
                    'cargo': cargo.value,
                    'fecha_ini': fecha_ini.value,
                    'fecha_fin': fecha_fin.value,
                    'user_id': user_id,
                    'punto_atencion_id': punto_id
                };
                console.log(data);
                if (fecha_ini.value != null && fecha_ini.value != '') {
                    axios.post(
                            "{{route('trabajadores.agregar')}}", data
                        )
                        .then(response => {
                            console.log(response);
                            toastr.options = {
                                "closeButton": true,
                                "progressBar": true
                            }
                            toastr.success(response.message);
                        })
                        .catch(error => {
                            console.log(error);
                        });
                } else {
                    toastr.options = {
                        "closeButton": true,
                        "progressBar": true
                    }
                    toastr.error("Debe agregar la fecha de inicio");
                }
            }
        </script>
    @endpush --}}
</x-app-layout>
