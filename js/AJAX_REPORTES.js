let totalMasculino2 = 0;
let totalFemenino2 = 0;
let totalGeneral2 = 0;

// Inicializar DataTables
let table1 = $('#myTable11').DataTable({
    pageLength: 20,
    ajax: {
        url: "../controller/controllerReport.php?op=pdf",
        dataSrc: "",
        type: "post",
        responsive: true,
        aaSorting: []
    },
    columns: [
        { "data": "edad" },     // Columna de edad
        { "data": "edadV" },    // Columna de edadV
        { "data": "MASCULINO" },// Columna de MASCULINO
        { "data": "FEMENINO" }, // Columna de FEMENINO
        { "data": "TOTAL" }     // Columna de TOTAL
    ],
    language: idioma_espanol,
    responsive: true,
    aaSorting: [],
    pagingType: 'simple',
    dom: 'Bfrtip',
    buttons: [
        {
            extend: 'copyHtml5',
            text: 'COPIAR',
            exportOptions: {
                columns: [1, 2, 3, 4]
            }
        },
        {
            extend: 'excelHtml5',
            text: 'EXCEL',
            exportOptions: {
                columns: [1, 2, 3, 4]
            }
        },
        {
            extend: 'pdfHtml5',
            text: 'PDF',
            exportOptions: {
                columns: [1, 2, 3, 4]
            },
        },
        {
            extend: 'colvis',
            text: 'COLUMNAS',
            columns: [1, 2, 3, 4]
        }
    ],
});

// Función para actualizar el gráfico
function updateChart(chart, data) {
    chart.data.datasets[0].data = data;
    chart.update();
}

// Evento para redirigir al archivo PDF deseado
document.getElementById('btnReportGen').addEventListener('click', function () {
    window.open("../reportePdfGeneral.php");
});

document.getElementById('btnReportNat').addEventListener('click', function () {
    window.open("../reportePdfNacionalidad.php");
});

// Document.ready para inicializar tooltips de Bootstrap y gráficos de Chart.js
$(document).ready(function () {


console.log(totalFemenino2);
console.log(totalMasculino2);
console.log(totalGeneral2);

    // Inicializar tooltips de Bootstrap
    $('[data-toggle="tooltip"]').tooltip({
        delay: { show: 0, hide: 0 },
        placement: 'top'
    });

    // Inicializar gráfico de Chart.js GENERAL
    // Crear el gráfico solo después de que los datos estén disponibles
    const ctx1 = document.getElementById('chartReportGen').getContext('2d');
    const chartReportGen = new Chart(ctx1, {
        type: 'bar',
        data: {
            labels: ['FEMENINO', 'MASCULINO', 'TOTAL'],
            datasets: [{
                label: '# of Votes',
                data: [totalFemenino2, totalMasculino2, totalGeneral2],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Inicializar gráfico de Chart.js POR NACIONALIDAD
    const ctx3 = document.getElementById('chartReportGen3').getContext('2d');
    const chartReportGen3 = new Chart(ctx3, {
        type: 'bar',
        data: {
            labels: ['CHILE', 'ARGENTINA', 'URUGUAY', 'PARAGUAY', 'BOLIVIA', 'PERU', 'BRASIL', 'ECUADOR', 'COLOMBIA', 'VENEZUELA'],
            datasets: [{
                label: '# of Votes',
                data: [12, 19, 3, 5, 2, 3, 14, 4, 9, 10],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)',
                    'rgba(123, 239, 178, 0.2)',
                    'rgba(232, 90, 130, 0.2)',
                    'rgba(101, 143, 255, 0.2)',
                    'rgba(255, 123, 167, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)',
                    'rgba(123, 239, 178, 1)',
                    'rgba(232, 90, 130, 1)',
                    'rgba(101, 143, 255, 1)',
                    'rgba(255, 123, 167, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
});
