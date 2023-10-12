<div wire:poll="render">
    <nav class="flex mb-3" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li class="inline-flex items-center">
                <x-content.nav-link href="#" class="inline-flex items-center">
                    <x-common.icon-home />
                    Home
                </x-content.nav-link>
            </li>
            <li class="flex items-center">
                <x-common.icon-row-nav />
                <x-content.nav-link href="#" class="ml-1 md:ml-2">Roles</x-content.nav-link>
            </li>
            <li class="flex items-center">
                <x-common.icon-row-nav />
                <x-content.nav-link-current>Lista</x-content.nav-link-current>
            </li>
        </ol>
    </nav>
    <div class="mt-3">
        <h1 class="text-xl mb-2 font-semibold text-gray-900 sm:text-2xl dark:text-white">
            Todos los Roles
        </h1>
        <div class="items-center justify-between block sm:flex pb-4">
            <x-content.search-side />
            {{-- <div class="flex items-center ml-auto space-x-2 sm:space-x-3">
                <x-common.button>
                    <x-common.icon-update />
                    Actualizar
                </x-common.button>
                <x-common.button wire:click="create()">
                    <x-common.icon-create />
                    Agregar
                </x-common.button>
            </div> --}}
        </div>
        <x-common.table>
            <x-common.table-head>
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Nombre
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Nombre Guardado
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Acción
                    </th>
                </tr>
            </x-common.table-head>
            <tbody>
                @foreach ($roles as $rol)
                    <x-common.table-row>
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $rol->name }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $rol->guard_name }}
                        </td>
                        <td class="px-6 py-4">
                            {{-- <a wire:click="edit({{ $rol->id }})" href="#"
                                class="mr-2 font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a> --}}
                            <a href="#" class="font-medium text-green-600 dark:text-green-500 hover:underline">Ver
                                más</a>
                        </td>
                    </x-common.table-row>
                @endforeach
            </tbody>
        </x-common.table>
        <div class="mt-2">
            {{ $roles->links() }}
        </div>
    </div>
    <x-views>
        Vistas: {{ $pageViews }}
    </x-views>
    <!-- Modals -->
    @if ($create_modal)
        @include('roles.create')
    @endif
    @if ($edit_modal)
        @include('roles.edit')
    @endif
    @push('scripts')
        <script>
            Livewire.on('alert', function(message) {
                toastr.options = {
                    "closeButton": true,
                    "progressBar": true
                }
                toastr.success(message);
            });
            Livewire.on('alert-error', function(message){
                toastr.options = {
                    "closeButton": true,
                    "progressBar": true
                }
                toastr.error(message);
            })
        </script>
    @endpush
</div>
