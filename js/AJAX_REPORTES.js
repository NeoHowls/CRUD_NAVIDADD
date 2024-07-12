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
let table1 = $('#myTable11').DataTable( {
    // destroy : true,


    pageLength: 20,
    
    //TENGO QUE SEPARAR ESTO EN OTRO ARCHIVO
    "ajax":{
        url: "../controller/controllerReport.php?op=pdf",
        dataSrc:"",
        type: "post",
        responsive : true,
        aaSorting:[]

    },
    "columns":[
        {"data": "edad"}, //0
        {"data": "MASCULINO"},//1 
        {"data": "FEMENINO"}, //2
        {"data": "TOTAL"}, //3

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
                    columns: [0,1,2,3]
                }
            ] 
        }
    }
        
    });
//! --------------cambio de areas-------------------

function crearpdf(sexo1,edad1){
    // alert(
    window.open("../reportePdf2.php?edad="+edad1+" &sexo="+sexo1);
   
  
}






                      

