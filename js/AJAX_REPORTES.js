//! ----------------------------------------------------------------------------------------------------------------
//! ----------------------------------------------------------------------------------------------------------------
//! ----------------------------------------------PRUEBAS------------------------------------------------------------------
//! ----------------------------------------------------------------------------------------------------------------
//! ----------------------------------------------------------------------------------------------------------------

// Código JavaScript ajustado
let table = $('#myTable10').DataTable( {
    // destroy : true,


    pageLength: 20,
    
    //TENGO QUE SEPARAR ESTO EN OTRO ARCHIVO
    "ajax":{
        url: "../controller/controllerReport.php?op=reporte",
        dataSrc:"",
        type: "post",
        responsive : true,
        aaSorting:[]

    },
    "columns":[

        {"data": "id"}, //0
        {"data": "dni"}, //1
        {"data": "nombre"}, //2
        {"data": "sexo"}, //3
        {"data": "sexo_vista"}, //4
        {"data": "edad"}, //5
        {"data": "fechaNacimiento"},//6
        {"data": "periodo"},//7

        {"data": "fechaRegistro"},//8
        {"data": "idNacionalidad"},//9
        {"data": "checkExtranjero"},//10
        
        {"data": "checkCeguera"},//11
        {"data": "checkSordera"},//12
        {"data": "checkMudez"},//13
        {"data": "checkFisica"},//14
        {"data": "checkMental"},//15
        {"data": "checkPsiquica"},//16

        {"data": "idOrganizacion"},//17
        {"data": "idPersonalRegistro"},//18
        {"data": "checkDiscapacitado"},//19

        {"data": "porcentajeCeguera"},//20
        {"data": "porcentajeSordera"},//21
        {"data": "porcentajeMudez"},//22
        {"data": "porcentajeFisica"},//23
        {"data": "porcentajeMental"},//24
        {"data": "porcentajePsiquica"},//25
        {"data": "descripcion"},//26
        {"data": "etnia"},//27
        {"data": "nacionalidad"},//28
        {"data": "NOMBRE_ORG"},//29
        {"data": "tipo"},//30
        {"data": "tipo_org"},//31
        {"data": "idEtnia"},//32
        /* {
            "data": null,
            "render": function(data, type, row) {
                let sexo1 = data["sexo"];
                let edad1 = data["edad"];

                pdf ="<button type='button' class='btn btn-warning me-2 btnAnular text-light' data-toggle='tooltip' data-placement='top' title='Imprimir usuario y contraseña'"+
                    "onclick=\"crearpdf('"+sexo1+"','"+edad1+"')\">"+
                    "<i class='bi bi-filetype-pdf icon-100'></i>"+
                    "</button>"; 

                // Combinamos los botones en una sola columna
                return pdf;
            }
        } */
        ],

        //ESTO DEBERIA INVOCARSE EN BASE A UN ID
    language : idioma_espanol,
    responsive : true,
    aaSorting:[],
    pagingType: 'simple',
    layout: {
        topStart: {
            // buttons: ['copy', 'excel', 'pdf', 'colvis']
            buttons: [
                {
                    extend: 'copyHtml5',
                    text: 'COPIAR',
                    exportOptions: {
                        // columns: [ 0, ':visible' ]
                        columns: ':visible:not(:last-child)'
                    }
                    
                },
                {
                    extend: 'excelHtml5',
                    text: 'EXCEL',
                    exportOptions: {
                        columns: ':visible:not(:last-child)'
                    }
                    
                },
                {
                    extend: 'pdfHtml5',
                    text: 'PDF',
                    exportOptions: {
                        //columns: [ 0, 1, 2, 5 ]
                       columns: ':visible:not(:last-child)'
                    }
                    
                },
                {    
                    extend: 'colvis',
                    text: 'COLUMNAS',
                    columns: [2,4,5,27, 28]
                }
            ] 
        }
    }
        
    });


//! ----------------------------------------------------------------------------------------------------------------
//! ----------------------------------------------------------------------------------------------------------------
//! ----------------------------------------------PRUEBAS------------------------------------------------------------------
//! ----------------------------------------------------------------------------------------------------------------
//! ----------------------------------------------------------------------------------------------------------------

// Código JavaScript ajustado
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
        { "data": "edad" }, //0
        { "data": "edadV" }, //1
        { "data": "MASCULINO" }, //2
        { "data": "FEMENINO" }, //3
        { "data": "TOTAL" } //4
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
                columns: ':visible:not(:last-child)'
            }
        },
        {
            extend: 'excelHtml5',
            text: 'EXCEL',
            exportOptions: {
                columns: ':visible:not(:last-child)'
            }
        },
        {
            extend: 'pdfHtml5',
            text: 'PDF',
            exportOptions: {
                columns: [1, 2, 3, 4]
            },
            customize: function (doc) {
                pdfMake.createPdf(doc).getBlob(function (blob) {
                    var url = URL.createObjectURL(blob);
                    var newWindow = window.open();
                    var iframe = newWindow.document.createElement('iframe');
                    iframe.style.border = 'none';
                    iframe.style.width = '100%';
                    iframe.style.height = '100%';
                    iframe.src = url;
                    newWindow.document.body.appendChild(iframe);
                });
                return false;
            }
        },
        {
            extend: 'colvis',
            text: 'COLUMNAS',
            columns: [1, 2, 3, 4]
        }
    ],
    footerCallback: function (row, data, start, end, display) {
        var api = this.api();

        // Remove the formatting to get integer data for summation
        var intVal = function (i) {
            return typeof i === 'string' ?
                i.replace(/[\$,]/g, '') * 1 :
                typeof i === 'number' ?
                    i : 0;
        };

        // Total over all pages
        var totalMasculino = api
            .column(2)
            .data()
            .reduce(function (a, b) {
                return intVal(a) + intVal(b);
            }, 0);

        var totalFemenino = api
            .column(3)
            .data()
            .reduce(function (a, b) {
                return intVal(a) + intVal(b);
            }, 0);

        var totalGeneral = api
            .column(4)
            .data()
            .reduce(function (a, b) {
                return intVal(a) + intVal(b);
            }, 0);

        // Update footer
        $(api.column(2).footer()).html(totalMasculino);
        $(api.column(3).footer()).html(totalFemenino);
        $(api.column(4).footer()).html(totalGeneral);
    }
});


//! --------------cambio de areas-------------------






                      

