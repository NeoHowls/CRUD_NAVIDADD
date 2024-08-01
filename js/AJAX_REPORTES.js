//!-------------------------------------------------------------------------------------------------------------------------------------------
//!-------------------------------------------------------------------------------------------------------------------------------------------
//!----------------------------------------------------------------GENERAL--------------------------------------------------------------------
//!-------------------------------------------------------------------------------------------------------------------------------------------
//!-------------------------------------------------------------------------------------------------------------------------------------------
let totalMasculino2 = 0;
let totalFemenino2 = 0;
let totalGeneral2 = 0;
let totalGeneralPorNacionalidad = [];

let periodo=2024;

// $('#select_periodo')
$('#select_periodo').on('change', function() {
    periodo = $('#select_periodo').val();
    actualizarGraficoGeneral(periodo);
    actualizarGraficoGeneralD(periodo);
    actualizarGraficoGeneralNacional(periodo);
    
});

//! Función para actualizar un gráfico--------------------------------------------------------
function updateChart(chart, data) {
    chart.data.datasets[0].data = data;
    chart.update();
}
//!grafico general-------------------------------------------------------
// Inicializar DataTables
let table1 = $('#myTable11').DataTable({
    pageLength: 20,
    ajax: {
        url: "../controller/controllerReport.php?op=pdfGeneral",
        dataSrc: "",
        type: "post",
        data:  {periodo:periodo},
        responsive: true,
        aaSorting: []
    },
    columns: [
        { "data": "edad" },
        { "data": "edadV" },
        { "data": "MASCULINO" },
        { "data": "FEMENINO" },
        { "data": "TOTAL" }
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
                columns: [0, 1, 2, 3, 4]
            }
        },
        {
            extend: 'excelHtml5',
            text: 'EXCEL',
            exportOptions: {
                columns: [0, 1, 2, 3, 4]
            }
        },
        {
            extend: 'pdfHtml5',
            text: 'PDF',
            exportOptions: {
                columns: [0, 1, 2, 3, 4]
            }
        },
        {
            extend: 'colvis',
            text: 'COLUMNAS',
            columns: [0, 1, 2, 3, 4]
        }
    ],
    columnDefs: [
        { className: "dt-head-center", targets: [1, 2, 3, 4] },
        { className: "dt-body-center", targets: [1, 2, 3, 4] }
    ]
});

let chartReportGen;
function initChartReportGen() {
    const ctx1 = document.getElementById('chartReportGen').getContext('2d');
    chartReportGen = new Chart(ctx1, {
        type: 'bar',
        data: {
            labels: ['FEMENINO', 'MASCULINO', 'TOTAL'],
            datasets: [{
                label: 'Cantidad',
                data: [totalFemenino2, totalMasculino2, totalGeneral2],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.5)',
                    'rgba(54, 162, 235, 0.5)',
                    'rgba(255, 206, 86, 0.5)'
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
    actualizarGraficoGeneral(periodo);
}
let actualizarGraficoGeneral = function(periodo){
// Solicitar datos para la tabla y actualizar gráfico
$.ajax({
    url: "../controller/controllerReport.php?op=pdfGeneral",
    type: "post",
    data:  {periodo:periodo},
    dataType: "json",
    success: function (data) {
        //console.log('Datos recibidos:', data);
        table1.clear().rows.add(data).draw();

        totalFemenino2 = 0;
        totalMasculino2 = 0;
        totalGeneral2 = 0;

        data.forEach(function (row) {
            totalFemenino2 += parseFloat(row.FEMENINO || 0);
            totalMasculino2 += parseFloat(row.MASCULINO || 0);
            totalGeneral2 += parseFloat(row.TOTAL || 0);
        });

        updateChart(chartReportGen, [totalFemenino2, totalMasculino2, totalGeneral2]);
    },
    error: function (xhr, status, error) {
        console.error('Error en la solicitud:', error);
    }
});

};
//!-------------------------------------------------------------------------------------------------------------------------------------------
//!-------------------------------------------------------------------------------------------------------------------------------------------
//!-----------------------------------------------------------NACIONALIDAD--------------------------------------------------------------------
//!-------------------------------------------------------------------------------------------------------------------------------------------
//!-------------------------------------------------------------------------------------------------------------------------------------------

//!grafico general nacionalidad -------------------------------------------------------
let table2 = $('#myTable12').DataTable({
    pageLength: 20,
    ajax: {
        url: "../controller/controllerReport.php?op=pdfNaciones",
        dataSrc: "",
        type: "post",
        data:  {periodo:periodo},
        responsive: true,
        aaSorting: []
    },
    columns: [
        { "data": "idNacionalidad" },
        { "data": "nacionalidad" },
        { "data": "MASCULINO" },
        { "data": "FEMENINO" },
        { "data": "TOTAL" }
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
                columns: [0, 1, 2, 3, 4]
            }
        },
        {
            extend: 'excelHtml5',
            text: 'EXCEL',
            exportOptions: {
                columns: [0, 1, 2, 3, 4]
            }
        },
        {
            extend: 'pdfHtml5',
            text: 'PDF',
            exportOptions: {
                columns: [0, 1, 2, 3, 4]
            }
        },
        {
            extend: 'colvis',
            text: 'COLUMNAS',
            columns: [0, 1, 2, 3, 4]
        }
    ]
});

let chartReportGen3;
function initChartReportGen3() {
    const ctx2 = document.getElementById('chartReportGen3').getContext('2d');
    chartReportGen3 = new Chart(ctx2, {
        type: 'bar',
        data: {
            labels: [],
            datasets: [{
                label: 'Cantidad',
                data: [],
                backgroundColor: [
                    'rgba(255, 69, 0, 0.5)',     // Orange Red
                    'rgba(124, 252, 0, 0.5)',    // Lawn Green
                    'rgba(0, 191, 255, 0.5)',    // Deep Sky Blue
                    'rgba(255, 20, 147, 0.5)',   // Deep Pink
                    'rgba(255, 140, 0, 0.5)',    // Dark Orange
                    'rgba(30, 144, 255, 0.5)',   // Dodger Blue
                    'rgba(50, 205, 50, 0.5)',    // Lime Green
                    'rgba(138, 43, 226, 0.5)',   // Blue Violet
                    'rgba(255, 105, 180, 0.5)',  // Hot Pink
                    'rgba(218, 165, 32, 0.5)'    // Golden Rod
                ],
                borderColor: [
                    'rgba(255, 69, 0, 1)',     // Orange Red
                    'rgba(124, 252, 0, 1)',    // Lawn Green
                    'rgba(0, 191, 255, 1)',    // Deep Sky Blue
                    'rgba(255, 20, 147, 1)',   // Deep Pink
                    'rgba(255, 140, 0, 1)',    // Dark Orange
                    'rgba(30, 144, 255, 1)',   // Dodger Blue
                    'rgba(50, 205, 50, 1)',    // Lime Green
                    'rgba(138, 43, 226, 1)',   // Blue Violet
                    'rgba(255, 105, 180, 1)',  // Hot Pink
                    'rgba(218, 165, 32, 1)'    // Golden Rod
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
    actualizarGraficoGeneralNacional(periodo);
}

// Solicitar datos para la tabla y actualizar gráfico
let actualizarGraficoGeneralNacional = function(periodo){
$.ajax({
    url: "../controller/controllerReport.php?op=pdfNaciones",
    type: "post",
    data:  {periodo:periodo},
    dataType: "json",
    success: function (data) {
        //console.log('Datos recibidos:', data);
        table2.clear().rows.add(data).draw();

        totalGeneralPorNacionalidad = data.map(row => parseFloat(row.TOTAL || 0));
        let labels = data.map(row => row.nacionalidad);

        updateChart(chartReportGen3, totalGeneralPorNacionalidad);
        chartReportGen3.data.labels = labels;
        chartReportGen3.update();
    },
    error: function (xhr, status, error) {
        console.error('Error en la solicitud:', error);
    }
});
};

//!-------------------------------------------------------------------------------------------------------------------------------------------
//!-------------------------------------------------------------------------------------------------------------------------------------------
//!-----------------------------------------------------------GENERAL DISCAPACIDAD--------------------------------------------------------------------
//!-------------------------------------------------------------------------------------------------------------------------------------------
//!-------------------------------------------------------------------------------------------------------------------------------------------

//!grafico general-------------------------------------------------------
// Inicializar DataTables
let tableD = $('#myTable13').DataTable({
    pageLength: 20,
    ajax: {
        url: "../controller/controllerReport.php?op=pdfGeneralDiscapacidad",
        dataSrc: "",
        type: "post",
        data:  {periodo:periodo},
        responsive: true,
        aaSorting: []
    },
    columns: [
        { "data": "edad" },
        { "data": "MASCULINO" },
        { "data": "FEMENINO" },
        { "data": "TOTAL" }
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
                columns: [0, 1, 2, 3, 4]
            }
        },
        {
            extend: 'excelHtml5',
            text: 'EXCEL',
            exportOptions: {
                columns: [0, 1, 2, 3, 4]
            }
        },
        {
            extend: 'pdfHtml5',
            text: 'PDF',
            exportOptions: {
                columns: [0, 1, 2, 3, 4]
            }
        },
        {
            extend: 'colvis',
            text: 'COLUMNAS',
            columns: [0, 1, 2, 3, 4]
        }
    ],
    columnDefs: [
        { className: "dt-head-center", targets: [1, 2, 3, 4] },
        { className: "dt-body-center", targets: [1, 2, 3, 4] }
    ]
    
});

let chartReportGenD;
function initChartReportGenD() {
    const ctx1 = document.getElementById('chartReportGenD').getContext('2d');
    chartReportGen = new Chart(ctx1, {
        type: 'bar',
        data: {
            labels: ['FEMENINO', 'MASCULINO', 'TOTAL'],
            datasets: [{
                label: 'Cantidad',
                data: [totalFemenino2, totalMasculino2, totalGeneral2],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.5)',
                    'rgba(54, 162, 235, 0.5)',
                    'rgba(255, 206, 86, 0.5)'
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
    actualizarGraficoGeneralD(periodo);
}
let actualizarGraficoGeneralD = function(periodo){
// Solicitar datos para la tabla y actualizar gráfico
$.ajax({
    url: "../controller/controllerReport.php?op=pdfGeneralDiscapacidad",
    type: "post",
    data:  {periodo:periodo},
    dataType: "json",
    success: function (data) {
        //console.log('Datos recibidos:', data);
        table1.clear().rows.add(data).draw();

        totalFemenino2 = 0;
        totalMasculino2 = 0;
        totalGeneral2 = 0;

        data.forEach(function (row) {
            totalFemenino2 += parseFloat(row.FEMENINO || 0);
            totalMasculino2 += parseFloat(row.MASCULINO || 0);
            totalGeneral2 += parseFloat(row.TOTAL || 0);
        });

        updateChart(chartReportGenD, [totalFemenino2, totalMasculino2, totalGeneral2]);
    },
    error: function (xhr, status, error) {
        console.error('Error en la solicitud:', error);
    }
});

};



//! Inicializar los gráficos
initChartReportGen();
initChartReportGenD();
initChartReportGen3();


//!BOTONES PARA GENERAR EL PDF
document.getElementById('btnReportGen').addEventListener('click', function () {
    window.open("../view/reportePdfGeneral.php?periodo="+periodo);
});

document.getElementById('btnReportDis').addEventListener('click', function () {
    window.open("../view/reportePdfGeneralDiscapacitados.php?periodo="+periodo);
});


document.getElementById('btnReportNat').addEventListener('click', function () {
    window.open("../view/reportePdfNacionalidad.php?periodo="+periodo);
});