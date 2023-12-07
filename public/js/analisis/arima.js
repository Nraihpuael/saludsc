
const { arima } = require('arima');
const fs = require('fs');

// Load your data from the Laravel controller
const data = (weeklyCounts);

// Convert data to array
const dataArray = Object.values(data);

// Define ARIMA parameters
const p = 1; // order of the AutoRegressive part
const d = 1; // degree of differencing
const q = 1; // order of the Moving Average part

// Create ARIMA model
const model = new ARIMA({ p, d, q });

// Fit the model to the data
model.fit(dataArray);

// Forecast future values
const forecastSteps = 10; // Change this based on your needs
const forecast = model.predict(forecastSteps);

// Save the forecasted values to a file (optional)
fs.writeFileSync('forecast.json', JSON.stringify(forecast));

console.log('Forecast:', forecast);

// Create a Chart.js line chart
const ctx = document.getElementById('myChart').getContext('2d');
const myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: [...Array(dataArray.length).keys(), ...Array(forecastSteps).keys()].map((val) => `Week ${val + 1}`),
        datasets: [
            {
                label: 'Historical Data',
                data: dataArray,
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1,
                fill: false,
            },
            {
                label: 'Forecast',
                data: [...Array(dataArray.length).fill(null), ...forecast],
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1,
                fill: false,
            },
        ],
    },
    options: {
        scales: {
            x: {
                type: 'linear',
                position: 'bottom',
            },
        },
    },
});