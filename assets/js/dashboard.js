// import "/node_modules/@kurkle/color/dist/color.esm.js";
// import { Chart } from "/node_modules/chart.js/auto/auto.js";

function dashboardStart() {
    const dashboard = $("#dashboard");
    const chartCanvas = $("#chart")[0]; // I converted jquery to DOM

    const patNum = Number(dashboard.data("patients") || 0);
    const docNum = Number(dashboard.data("doctors") || 0);
    const depNum = Number(dashboard.data("departments") || 0);

    const chartData = {
        labels: ["Patients", "Doctors", "Departments"],
        datasets: [
            {
                label: "Number of rows",
                data: [patNum, docNum, depNum],
                backgroundColor: ["#3b82f6", "#22c55e", "#eab308"], // blue, green, yellow
                borderRadius: 4,
            },
        ],
    };

    const opt = {
        responsive: true,
        plugins: {
            legend: { display: false },
        },
        scales: {
            y: { beginAtZero: true, ticks: { precision: 0 } },
        },
    };

    if (chartCanvas._chartInstance) chartCanvas._chartInstance.destroy();

    const chart = new Chart(chartCanvas, {
        type: "bar",
        data: chartData,
        options: opt,
    });

    chartCanvas._chartInstance = chart;
}

export { dashboardStart };
