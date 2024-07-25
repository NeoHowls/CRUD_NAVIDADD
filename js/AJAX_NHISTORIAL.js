let table = $('#myTableNH').DataTable( {
    // destroy : true,


    pageLength: 50,
    
    //TENGO QUE SEPARAR ESTO EN OTRO ARCHIVO
    "ajax":{
        url: "../controller/controllerNHistorial.php?op=ninosH",
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
            {"data": "edad"}, //4
            {"data": "fechaNacimiento"},//6
            {"data": "idNacionalidad"},//7

            {"data": "idEtnia"},//8
            {"data": "estado"},//9
            {"data": "periodo"},//10
            
            {"data": "checkCeguera"},//11
            {"data": "checkSordera"},//12
            {"data": "checkMudez"},//13
            {"data": "checkFisica"},//14
            {"data": "checkMental"},//15
            {"data": "checkPsiquica"},//16
            {"data": "descripcion"},
            {"data": "idOrganizacion"},//17
            {"data": "idPersonalRegistro"},//18
            {"data": "fechaRegistro"},//19
            {"data": "checkExtranjero"},//19
            {"data": "checkDiscapacitado"},//19
            {"data": "checkRSH"},//19
            {"data": "porcentajeCeguera"},//20
            {"data": "porcentajeSordera"},//21
            {"data": "porcentajeMudez"},//22
            {"data": "porcentajeFisica"},//23
            {"data": "porcentajeMental"},//24
            {"data": "porcentajePsiquica"},//25
            {"data": "tipoMovimiento"},
            {"data": "usuarioCambio"},
            {"data": "fechaCambio"}
                   
    ] , 

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
                        columns: ':visible'
                    }
                    
                },
                {
                    extend: 'excelHtml5',
                    text: 'EXCEL',
                    exportOptions: {
                        columns: ':visible'
                    }
                    
                },
                {
                    extend: 'pdfHtml5',
                    text: 'PDF',
                    exportOptions: {
                        //columns: [ 0, 1, 2, 5 ]
                        columns: ':visible'
                    }
                    
                },
                {    
                    extend: 'colvis',
                    text: 'COLUMNAS',
                }
            ] 
        }
    }
} );