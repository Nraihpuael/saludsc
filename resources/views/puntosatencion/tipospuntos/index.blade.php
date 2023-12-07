<div wire:poll="render">
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
                <x-content.nav-link href="{{ route('puntosatencion.index') }}" class="ml-1 md:ml-2">Puntos de Atención</x-content.nav-link>
            </li>
            <li class="flex items-center">
                <x-common.icon-row-nav />
                <x-content.nav-link-current>Lista Tipos de Puntos de Atención</x-content.nav-link-current>
            </li>
        </ol>
    </nav>
    <div class="mt-3">
        <h1 class="text-xl mb-2 font-semibold text-gray-900 sm:text-2xl dark:text-white">
            Todos los Tipos de Puntos de Atención
        </h1>
        <div class="items-center justify-between block sm:flex pb-4">
            <x-content.search-side />
            <div class="flex items-center ml-auto space-x-2 sm:space-x-3">
                
                <x-common.button wire:click="create()">
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
                        Descripción
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Acciones
                    </th>
                </tr>
            </x-common.table-head>
            <tbody>
                @foreach ($tipo_punto as $tipo)
                    <x-common.table-row>
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $tipo->nombre }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $tipo->descripcion }}
                        </td>
                        <td class="px-6 py-4">
                            <a wire:click="edit({{ $tipo->id }})" href="#"
                                class="mr-2 font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                            {{-- <a wire:click="delete({{ $tipo->id }})" href="#"
                                class="mr-2 font-medium text-red-600 dark:text-red-500 hover:underline">Borrar</a>   --}}  
                        </td>
                    </x-common.table-row>
                @endforeach
            </tbody>
        </x-common.table>
        <div class="mt-2">
            {{ $tipo_punto->links() }}
        </div>
    </div>
    <x-views>
        Vistas: {{ $pageViews }}
    </x-views>
    <!-- Modals -->
    @if ($create_modal)
        @include('puntosatencion.tipospuntos.create')
    @endif
    @if ($edit_modal)
        @include('puntosatencion.tipospuntos.edit')
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
        </script>
    @endpush
</div>