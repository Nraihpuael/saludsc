var labels_date = [];
var x_vals = [-2, -1, 0, 1, 2];
var y_vals = [-2, 1, 0, 1, 4];
var operands = [];
var degree = 3; // Grado del polinomio
var learningRate = 0.1; // Tasa de aprendizaje
var optimizer;

function getRandomCoefficient() {
    return Math.random() * 2 - 1; // Generar un número aleatorio entre -1 y 1
}

function initOperands() {
    operands = [];
    for (let i = 0; i <= degree; i++) {
        operands.push(tf.variable(tf.scalar(getRandomCoefficient())));
        console.log(operands[i].dataSync()[0].toFixed(2));
    }
}

function predict(x) {
    const xs = tf.tensor1d(x);
    let ys = tf.variable(tf.zerosLike(xs));
    for (let i = 0; i <= degree; i++) {
        const coef = operands[i];
        const pow_ts = tf.fill(xs.shape, i);
        const sum = tf.add(ys, operands[i].mul(xs.pow(pow_ts)));
        ys.dispose();
        ys = sum.clone();
    }
    return ys;
}

function loss(pred, labels) {
    return pred.sub(labels).square().mean();
}

function train() {
    const xs = tf.tensor1d(x_vals);
    const ys = tf.tensor1d(y_vals);

    for (let i = 0; i < 1500; i++) {
        optimizer.minimize(() => {
            const pred = predict(x_vals);
            return loss(pred, ys);
        });
    }
}

var ctx = document.getElementById("myChart").getContext("2d");
const polynomialLabel = `Polinomio (Grado ${degree})`;
var chart = new Chart(ctx, {
    data: {
        labels: [],
        datasets: [
            {
                type: "scatter",
                label: "Puntos",
                data: [],
                borderColor: "rgb(31, 180, 228)",
                backgroundColor: "rgb(95, 212, 249)",
                fill: false,
            },
            {
                type: "line",
                label: polynomialLabel,
                data: [],
                borderColor: "green",
                backgroundColor: "rgb(27, 254, 116)",
                fill: false,
                tension: 0.3,
            },
        ],
    },
    options: {
        responsive: true,
        plugins: {
            title: {
                display: true,
                text: "Gráfico del Polinomio y Puntos",
            },
        },
        scales: {
            x: {
                display: true,
                title: {
                    display: true,
                    text: "Fechas",
                },
            },
            y: {
                display: true,
                title: {
                    display: true,
                    text: "# Contagios",
                },
            },
        },
    },
});

function initGraph() {
    
    train();

    // Configuración del gráfico
    chart.data.datasets[0] = {
        type: "scatter",
        label: "Puntos",
        data: y_vals,
        borderColor: "rgb(31, 180, 228)",
        backgroundColor: "rgb(95, 212, 249)",
        fill: false,
    };

    // Agregar el polinomio al gráfico
    const curveX = [];
    const curveY = [];
    for (let x = 1; x <= x_vals.length + 1; x += 1) {
        curveX.push(x);
        curveY.push(predict([x]).dataSync()[0]);
    }
    let operandsTextHolder = document.getElementById("outputs");
    const polynomialLabel = `Polinomio (Grado ${degree})`;
    let output = [];
    for (let i = 0; i <= degree; i++) {
        const coef = operands[i].dataSync()[0].toFixed(2);
        // when power of x is one or zero show sont show powers
        if (i === 1) {
            output.push(`${coef}x`);
        } else if (i === 0) {
            output.push(`${coef}`);
        } else {
            output.push(`${coef}x<sup>${i}</sup>`);
        }
    }

    operandsTextHolder.innerHTML =
        "<p class='text-white'>" + output.reverse().join(" + ") + "</p>";

    chart.data.datasets[1] = {
        type: "line",
        label: polynomialLabel,
        data: curveY,
        borderColor: "green",
        backgroundColor: "rgb(27, 254, 116)",
        fill: false,
        tension: 0.3,
    };
    chart.data.labels = curveX;
    // Renderizar el gráfico
    chart.update();
}

function initVariables(){
    degree = document.getElementById("orderPolySlider").value;
    learningRate = document.getElementById("learningRateSlider").value;
    optimizer = tf.train.adam(learningRate);
    initOperands();
}

async function getData() {
    let puntos = document.getElementById("puntos");
    let id = puntos.options[puntos.selectedIndex].value;
    let fecha_ini = document.getElementById("startDate").value;
    let fecha_fin = document.getElementById("endDate").value;
    let url = "";
    var res = null;
    await axios
        .get(
            `/datosPrediccion/${id}/${fecha_ini}/${fecha_fin}`
            // `http://127.0.0.1:3000/api/v1/shoppings/2023-01-02/2023-12-20/4157094700968`
        )
        .then((response) => {
            // console.log(response.data.data);
            res = response.data.data;
            // x.forEach(element => {
            //     console.log(element);
            // });
        })
        .catch((error) => {
            console.log(error);
        });
    if (res != null) {
        x_vals = [];
        y_vals = [];
        labels_date = [];
        var date_ini = new Date(fecha_ini);
        var x = 0;
        res.forEach((element) => {
            // if (date_ini) {

            // }
            labels_date.push(element.fecha_ini);
            x_vals.push(++x);
            y_vals.push(element.ncontagios);
        });
        console.log(labels_date);
        initVariables();
        initGraph();
    }
}
