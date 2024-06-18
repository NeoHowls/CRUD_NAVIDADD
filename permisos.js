
 

let table = $('#myTable').DataTable( {
    // destroy : true,


    pageLength: 50,
    
    //TENGO QUE SEPARAR ESTO EN OTRO ARCHIVO
    "ajax":{
        url: "../controller/controller.php?op=ninos",
        dataSrc:""
    },
    "columns":[
        {"data": "correlativo"},
        {"data": "dni"},
        {"data": "nombre"},
        {"data": "sexo"},
        {"data": "edad"},
        {"data": "fechaNacimiento"},
        {"data": "idNacionalidad"},
        {"data": "idEtnia"},
        {"data": "estado"},
        {"data": "periodo"},
        {"data": "checkCeguera"},
        {"data": "checkSordera"},
        {"data": "checkMudez"},
        {"data": "checkFisica"},
        {"data": "checkMental"},
        {"data": "checkPsiquica"},
        {"data": "descripcion"},
        {"data": "corrRegistro"}
    ] , 

    //ESTO DEBERIA INVOCARSE EN BASE A UN ID
    language : idioma_espanol,
    // autoWidth: false,
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



//table.draw();

