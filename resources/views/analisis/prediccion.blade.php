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
            <li>
                <div class="flex items-center">
                    <svg aria-hidden="true" class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <a href="#"
                        class="ml-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ml-2 dark:text-gray-400 dark:hover:text-white">Regresión
                        Polinomial</a>
                </div>
            </li>
            <li aria-current="page">
                <div class="flex items-center">
                    <svg aria-hidden="true" class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 dark:text-gray-400">Mapa
                        Principal</span>
                </div>
            </li>
        </ol>
    </nav>
    <div class="mt-2">
        <h1 class="text-xl mb-2 font-semibold text-gray-900 sm:text-2xl dark:text-white">
            Regresion Polinomial
        </h1>
        <div
            class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-md 2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800">
            <div class="grid grid-cols-1 xl:grid-cols-3 md:grid-cols-2">
                <div class="pb-6 pr-8">
                    <label for="startDate" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-200">Fecha
                        de
                        Inicio</label>
                    <input type="date" id="startDate"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="John" value="2023-03-07" required>
                </div>
                <div class="pb-6 pr-8">
                    <div>
                        <label for="endDate"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-200">Fecha
                            Final</label>
                        <input type="date" id="endDate"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="John" value="2023-03-13" required>
                    </div>
                </div>
                <div class="pb-6 pr-8">
                    <div>
                        <label for="puntos"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-200">Hospitales</label>
                        <select id="puntos"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            @foreach ($puntos_atencion as $punto)
                                <option value="{{ $punto->id }}">{{ $punto->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="pb-6 pr-8">
                    <div>
                        <label for="default-range"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Grado del
                            Polinomio: <span class="text-blue-500" id="gradoPolinomio">3</span></label>
                        <input type="range"
                            class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer dark:bg-gray-700"
                            id="orderPolySlider" min="1" max="10" step="1" value="3"
                            oninput="updateRange(this.value, 'gradoPolinomio')">
                    </div>
                </div>
                <div class="pb-6 pr-8">
                    <div>
                        <label for="default-range"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Medida de
                            Aprendizaje: <span class="text-blue-500" id="medidaAprendizaje">0.1</span></label>
                        <input type="range"
                            class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer dark:bg-gray-700"
                            id="learningRateSlider" min="0.001" max="0.3" step="0.001" value="0.1"
                            oninput="updateRange(this.value, 'medidaAprendizaje')">
                    </div>
                </div>
            </div>
            <div class="flex pb-10">
                <x-common.button class="px-10 py-2.5" id="consultar" onclick="getData()">
                    Consultar
                </x-common.button>
                <x-common.button class="px-10 py-2.5 ml-3" id="consultar" onclick="initGraph()">
                    Aumentar Presicion
                </x-common.button>
                <button onclick="generarPDF()"
                    class="inline-flex items-center ml-2 justify-center w-1/2 px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 sm:w-auto dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800"
                    type="button" data-drawer-target="drawer-create-product-default"
                    data-drawer-show="drawer-create-product-default" aria-controls="drawer-create-product-default"
                    data-drawer-placement="right">
                    <svg class="w-4 h-4 text-white" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M4.5 11H4v1h.5a.5.5 0 0 0 0-1ZM7 5V.13a2.96 2.96 0 0 0-1.293.749L2.879 3.707A2.96 2.96 0 0 0 2.13 5H7Zm3.375 6H10v3h.375a.624.624 0 0 0 .625-.625v-1.75a.624.624 0 0 0-.625-.625Z" />
                        <path
                            d="M19 7h-1V2a1.97 1.97 0 0 0-1.933-2H9v5a2 2 0 0 1-2 2H1a1 1 0 0 0-1 1v9a1 1 0 0 0 1 1h1a1.969 1.969 0 0 0 1.933 2h12.134c1.1 0 1.7-1.236 1.856-1.614a.988.988 0 0 0 .07-.386H19a1 1 0 0 0 1-1V8a1 1 0 0 0-1-1ZM4.5 14H4v1a1 1 0 1 1-2 0v-5a1 1 0 0 1 1-1h1.5a2.5 2.5 0 1 1 0 5Zm8.5-.625A2.63 2.63 0 0 1 10.375 16H9a1 1 0 0 1-1-1v-5a1 1 0 0 1 1-1h1.375A2.63 2.63 0 0 1 13 11.625v1.75ZM17 12a1 1 0 0 1 0 2h-1v1a1 1 0 0 1-2 0v-5a1 1 0 0 1 1-1h2a1 1 0 1 1 0 2h-1v1h1Z" />
                    </svg>
                    &nbsp;&nbsp;Reporte PDF
                </button>                
            </div>
            <div class="bg-gray-200 dark:bg-sky-950 rounded-lg bg-opacity-90 pb-10">
                <div class="py-5 px-5 sm:px-10">
                    <div class="chart">
                        <canvas id="myChart"></canvas>
                    </div>
                </div>
            </div>

            <div class="container">
                <div class="row">
                    <div class="col s12">&nbsp;</div>
                    <div class="col s12 center-align" id="outputs">
                    </div>
                </div>
            </div>
        </div>
        <x-views>
            Vistas: {{ getPageViews('predicciones_inicio') }}
        </x-views>
        @push('scripts')
            {{-- <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script> --}}
            <script>
                function updateRange(value, element) {
                    document.getElementById(element).textContent = value;
                }
            </script>
            <!-- Tensorflow.js -->
            <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.8.0/chart.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs@0.11.1"></script>
            <!-- p5.js -->
            {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/p5.js/0.6.0/p5.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/p5.js/0.6.0/addons/p5.dom.js"></script> --}}
            {{-- <script src="tensorflow.js"></script>
        <script src="sketch.js"></script> --}}
            <script src="{{ asset('/js/analisis/prediccion.js') }}"></script>

            <script>
              
                function generarPDF() {
                    // Crear una instancia de jsPDF
                    const doc = new jsPDF();

                    // Obtener el contenido de la vista como una imagen base64
                    const canvas = document.querySelector('#myChart');
                    const imageData = canvas.toDataURL('image/png');

                    // Definir los márgenes y dimensiones del PDF
                    const marginLeft = 20;
                    const marginTop = 20;
                    const pdfWidth = doc.internal.pageSize.getWidth() - (marginLeft * 2);
                    const pdfHeight = doc.internal.pageSize.getHeight() - (marginTop * 2);


                    // Agregar encabezado
                    doc.setFontSize(24);
                    doc.setTextColor(0, 0, 255);
                    doc.setFontStyle('bold'); 
                    doc.text('     Analisis con Regresión Polinomial ', marginLeft, marginTop);

                    // Agregar la imagen de la gráfica centrada en el PDF
                    const imageWidth = pdfWidth;
                    const imageHeight = (pdfHeight * 3) / 4;
                    const imageX = marginLeft;
                    const imageY = (pdfHeight - imageHeight) / 2 + marginTop + 10;
                    doc.addImage(imageData, 'PNG', imageX, imageY, imageWidth, imageHeight);

                    // Agregar pie de página
                    doc.setFontSize(14);
                    doc.setTextColor(128);
                    doc.text('Comportamiento de las infecciones', marginLeft, doc.internal.pageSize.getHeight() - 10);

                    // Descargar el PDF
                    doc.save('Reporte.pdf');
                }

                
            </script>
        @endpush
</x-app-layout>
