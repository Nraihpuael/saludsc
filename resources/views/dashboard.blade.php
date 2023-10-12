<x-app-layout>
    <nav class="flex mb-3" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li class="inline-flex items-center">
                <x-content.nav-link href="/dashboard" class="inline-flex items-center">
                    <x-common.icon-home />
                    Home
                </x-content.nav-link>
            </li>
        </ol>
    </nav>
    <div class="mt-2">
        <h1 class="text-xl mb-2 font-semibold text-gray-900 sm:text-2xl dark:text-white">
            Home
        </h1>
        <div
            class="flex justify-center items-center flex-col p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-md 2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800">
            <div class="text-center mt-8 pb-8">
                <h1 class="text-4xl text-blue-500 font-extrabold">Bienvenido al sistema de confianza SSEM!</h1>
            </div>
            <img class="rounded-3xl" width="200px" src="https://i.ytimg.com/vi/QTDLMVXDvzs/mqdefault.jpg"
                alt="GAMS">
        </div>

        {{--  --}}
        <form action="{{ route('buscar') }}" method="GET">
            <input type="text" name="query" placeholder="Buscar en cualquier tabla..." required>
            <button type="submit">Buscar</button>
        </form>


    </div>
    <x-views>
        Vistas: {{ getPageViews('inicio_dashboard') }}
    </x-views>

    @if (session('alerta'))
        <div class="alert alert-danger">
            {{ session('alerta') }}
        </div>
    @endif


        <div class="flex justify-center items-center flex-col p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-md 2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800">
            <div class="text-center mt-8 pb-8">
                <h1 class="text-4xl text-blue-500 font-extrabold">Cantidad de Enfermos en el año</h1>
            </div>
            <div style="width: 80%; margin: auto;">
                <canvas id="graficaEnfermedades"></canvas>
            </div>
        </div>

        <div class="flex justify-center items-center flex-col p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-md 2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800">
            <div class="text-center mt-8 pb-8">
                <h1 class="text-4xl text-blue-500 font-extrabold">Distribucion de los pacientes</h1>
            </div>
            <div style="width: 80%; margin: auto;">
                <canvas id="graficaPuntosAtencion"></canvas>
            </div>
        </div>

        <div class="flex justify-center items-center flex-col p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-md 2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800">
            <div class="text-center mt-8 pb-8">
                <h1 class="text-4xl text-blue-500 font-extrabold">Distribucion de los pacientes por genero</h1>
            </div>
            <div style="width: 80%; margin: auto;">
                <canvas id="graficaGenero"></canvas>
            </div>
        </div>
    </div>    
    <x-views>
        Vistas: {{ getPageViews('inicio_dashboard') }}
    </x-views>
        <!-- Incluye la librería de Chart.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.8.0/chart.min.js"></script>
        
    <script>
        var datosEnfermedades = @json($datosEnfermedades);
        var datosPuntosAtencion = @json($datosPuntosAtencion);
        var datosGenero = @json($datosGenero);


        // Datos para utilizarlos en la gráfica graficaEnfermedades
        var nombresEnfermedades = datosEnfermedades.map(dato => dato.nombre);
        var cantidadesEnfermos = datosEnfermedades.map(dato => dato.cantidad_enfermos);

        // Datos para utilizarlos en la gráfica graficaPuntosAtencion
        var nombresPuntosAtencion = datosPuntosAtencion.map(dato => dato.nombre);
        var cantidadesEnfermosPuntosAtencion = datosPuntosAtencion.map(dato => dato.cantidad_enfermos);
        
        // Procesa los datos para utilizarlos en el gráfico de género
        var generos = datosGenero.map(dato => dato.genero);
        var cantidadesGenero = datosGenero.map(dato => dato.cantidad_enfermos);

        // Configura y crea la gráfica con Chart.js
        var ctx = document.getElementById('graficaEnfermedades').getContext('2d');
        var grafica = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: nombresEnfermedades,
                datasets: [{
                    label: 'Cantidad de enfermos por enfermedad',
                    data: cantidadesEnfermos,
                    backgroundColor: 'rgba(75, 192, 192, 0.6)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    x: {
                        display: true,
                        title: {
                            display: true,
                            text: 'Enfermedad'
                            }
                    },
                    y: {
                        display: true,
                        title: {
                            display: true,
                            text: 'Cantidad de enfermos'
                        }
                    }
                }
            }
        });

        // Configura y crea el gráfico para la cantidad de enfermos en cada punto de atención con Chart.js
        var ctxPuntosAtencion = document.getElementById('graficaPuntosAtencion').getContext('2d');
        var graficaPuntosAtencion = new Chart(ctxPuntosAtencion, {
            type: 'bar',
            data: {
                labels: nombresPuntosAtencion,
                datasets: [{
                    label: 'Cantidad de enfermos por punto de atención',
                    data: cantidadesEnfermosPuntosAtencion,
                    backgroundColor: 'rgba(192, 75, 192, 0.6)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    x: {
                        display: true,
                        title: {
                            display: true,
                            text: 'Punto de atención'
                        }
                    },
                    y: {
                        display: true,
                        title: {
                            display: true,
                            text: 'Cantidad de enfermos'
                        }
                    }
                }
            }
        });

         // Configura y crea el gráfico de género con Chart.js
         var ctxGenero = document.getElementById('graficaGenero').getContext('2d');
        var graficaGenero = new Chart(ctxGenero, {
            type: 'pie',
            data: {
                labels: generos,
                datasets: [{
                    label: 'Cantidad de enfermos por género',
                    data: cantidadesGenero,
                    backgroundColor: ['rgba(75, 192, 192, 0.6)', 'rgba(192, 75, 192, 0.6)']
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });
    </script>
</x-app-layout>
