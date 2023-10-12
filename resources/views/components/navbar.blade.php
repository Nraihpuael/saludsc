<nav class="fixed top-0 z-50 w-full bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">

    <div class="px-3 py-3 lg:px-5 lg:pl-3">
        <div class="flex items-center justify-between">
            <div class="flex items-center justify-start">
                <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar"
                    type="button"
                    class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
                    <span class="sr-only">Open sidebar</span>
                    <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path clip-rule="evenodd" fill-rule="evenodd"
                            d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
                        </path>
                    </svg>
                </button>
                <a href="{{ route('dashboard') }}" class="flex ml-2 md:mr-24">
                    <img src="{{ asset('logo.png') }}" class="h-8 mr-3" alt="SSEM logo" />
                    <span
                        class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap dark:text-white">SSEM</span>
                </a>
            </div>
            <div class="flex items-center">
                <div class="flex">
                    <button type="button" data-dropdown-toggle="notification-dropdown" class="inline-flex items-center text-gray-500 mr-1 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm px-1 py-2.5">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z">
                            </path>
                        </svg>
                        @if (auth()->user()->unreadNotifications->count() > 0)
                        <span class="inline-flex items-center justify-center w-4 h-4 text-xs font-semibold text-blue-800 bg-red-500 rounded-full">
                            {{ auth()->user()->unreadNotifications->count() }}</span>
                        @endif
                    </button>
                    <!-- Dropdown menu -->
                    <div class="z-50 hidden max-w-sm my-4 overflow-hidden text-base list-none bg-white divide-y divide-gray-100 rounded shadow-lg dark:divide-gray-600 dark:bg-gray-700"
                        id="notification-dropdown">
                        <div
                            class="block px-4 py-2 text-base font-medium text-center text-gray-700 bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            Notificaciones
                        </div>
                        <div>
                            <div class="w-full pl-3">
                                @foreach (Auth()->user()->unreadNotifications as $notification)
                                    <a href="{{ route('caso.ver', $notification->id) }}"
                                        class="flex px-4 py-3 border-b hover:bg-gray-100 dark:hover:bg-gray-600 dark:border-gray-600">


                                        <div class="notification-item" data-notification-id="{{ $notification->id }}">
                                            <div class="text-gray-500 font-normal text-sm mb-1.5 dark:text-gray-400">
                                                {{ $notification->data['razon'] }} de
                                                {{ $notification->data['enfermedad'] }}

                                            </div>
                                            <div class="text-xs font-medium text-blue-700 dark:text-blue-400">
                                                ver caso
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>

                    </div>
                    <button id="theme-toggle" type="button"
                        class="text-gray-500 mr-1 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5">
                        <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                        </svg>
                        <svg id="theme-toggle-light-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"
                                fill-rule="evenodd" clip-rule="evenodd"></path>
                        </svg>
                    </button>
                    <button type="button"
                        class="flex text-sm m-auto bg-white dark:bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600"
                        aria-expanded="false" data-dropdown-toggle="dropdown-user">
                        <span class="sr-only">Open user menu</span>
                        @if (Auth::user()->profile_photo_path)
                            <img class="w-8 h-8 rounded-full object-cover"
                                src="{{ asset('storage/' . Auth::user()->profile_photo_path) }}" alt="user photo">
                        @else
                            <img class="w-8 h-8 rounded-full" src="{{ Auth::user()->profile_photo_url }}"
                                alt="user photo">
                        @endif
                        <span
                            class="items-center mt-2 ml-2 mr-2 text-gray-500 hover:text-gray-700">{{ Auth::user()->name }}</span>
                    </button>
                </div>
                <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow dark:bg-gray-700 dark:divide-gray-600"
                    id="dropdown-user">
                    <div class="px-4 py-3" role="none">
                        <p class="text-sm text-gray-900 dark:text-white" role="none">
                            {{ Auth::user()->name }}
                        </p>
                        <p class="text-sm font-medium text-gray-900 truncate dark:text-gray-300" role="none">
                            {{ Auth::user()->email }}
                        </p>
                    </div>
                    <ul class="py-1" role="none">
                        <li>
                            <x-nav-link class="block px-4 py-2 text-sm" href="{{ route('dashboard') }}"
                                :active="request()->routeIs('dashboard')">
                                Dashboard
                            </x-nav-link>
                        </li>
                        <li>
                            <x-nav-link class="block px-4 py-2 text-sm" href="{{ route('profile.show') }}"
                                :active="request()->routeIs('profile.show')">
                                Perfil
                            </x-nav-link>
                        </li>
                        <li>
                            <x-nav-link class="block px-4 py-2 text-sm" href="#">Configuraciones</x-nav-link>
                        </li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}" x-data>
                                @csrf
                                <x-nav-link href="{{ route('logout') }}" @click.prevent="$root.submit();"
                                    class="block px-4 py-2 text-sm" role="menuitem">Cerrar Sesión</x-nav-link>
                            </form>
                        </li>
                    </ul>
                </div>

            </div>
        </div>
    </div>
</nav>
