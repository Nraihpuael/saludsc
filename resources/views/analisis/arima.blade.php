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
                        class="ml-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ml-2 dark:text-gray-400 dark:hover:text-white">
                        ARIMA</a>
                </div>
            </li>
            
        </ol>
    </nav>
    <div class="mt-2">
        <h1 class="text-xl mb-2 font-semibold text-gray-900 sm:text-2xl dark:text-white">
            ARIMA
        </h1>
        <canvas id="arimaChart" width="800" height="400"></canvas>


    <!-- Add JavaScript to handle the JSON data and create the chart -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-moment"></script> <!-- Add this line -->

    <!-- Configure Chart.js to use Moment.js -->
    <script>
        Chart.register(ChartMoment); // Register the adapter
    </script>
    <script>

    fetch('http://127.0.0.1:5000/get_data')
        .then(response => response.json())
        .then(arimaResult => {
            // Extract data for x-axis (dates) and y-axis (counts)
            console.log(arimaResult);
            console.log(arimaResult.dates);

            var dates = arimaResult.dates;
            var actualCounts = arimaResult.actual;
            var fittedValues = arimaResult.fitted_values;

            var lastDate = dates[dates.length - 1];

            // Extend the x-axis labels for additional 6 weeks from the last date
            var extendedDates = dates.concat(getNextWeeksDates(lastDate, 6));

            console.log(extendedDates);
            // Extend the fitted values, lower, and upper confidence interval arrays
            var extendedFittedValues = fittedValues.concat(new Array(6).fill(null));

            // Create a chart using Chart.js
            var ctx = document.getElementById('arimaChart').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: extendedDates,
                    datasets: [
                        {
                            label: 'Datos Historicos',
                            data: actualCounts,
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'Modelos Predictivo',
                            data: extendedFittedValues,
                            borderColor: 'rgba(255, 99, 132, 1)',
                            borderWidth: 1,
                            borderDash: [5, 5]  // Optional: Use dashed line for fitted values
                        }
                    ]
                },
                options: {
                    scales: {
                        x: {
                            type: 'time', // Use 'time' scale for dates
                            time: {
                                unit: 'day' // Adjust the time unit as needed
                            },
                            title: {
                                display: true,
                                text: 'Semenas'
                            }
                        },
                        y: {
                            title: {
                                display: true,
                                text: 'Pacientes'
                            }
                        }
                    }
                }
            });
        })
        .catch(error => console.error('Error fetching ARIMA results:', error));


        function getNextWeeksDates(lastDate, weeks) {
            var currentDate = new Date(lastDate);
            var nextWeeksDates = [];
        
            for (var i = 1; i <= weeks; i++) {
                var nextDate = new Date(currentDate);
                nextDate.setDate(nextDate.getDate() + 7 * i);
                nextWeeksDates.push(nextDate.toISOString().split('T')[0]);
            }
        
            return nextWeeksDates;
        }    
    </script>
</x-app-layout>
