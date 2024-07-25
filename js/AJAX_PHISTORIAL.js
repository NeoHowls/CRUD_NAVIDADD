$('#more_info').change(function() {
    if(this.checked != true){
          $("#conditional_part").hide();
     }
  else{
        $("#conditional_part").show();
  }
});

$('#more_infos').change(function() {
    if(this.checked != true){
          $("#conditional_parts").hide();
     }
  else{
        $("#conditional_parts").show();
  }
});
 

let table = $('#myTable4').DataTable( {
    // destroy : true,


    pageLength: 20,
    
    //TENGO QUE SEPARAR ESTO EN OTRO ARCHIVO
    "ajax":{
        url: "../controller/controllerPHistorial.php?op=personaH",
        dataSrc:"",
        type: "post",
        responsive : true,
        aaSorting:[]

    },
    "columns":[

        {"data": "id"},
        {"data": "dni"},
        {"data": "nombre"},
        {"data": "direccion"},
        {"data": "telefono"},
        {"data": "mail"},
        {"data": "idPerfil"},
        {"data": "estado"},
        {"data": "usuario"},
        {"data": "contrasena"},
        {"data": "checkHabilitado"},
        {"data": "usuarioCambio"},
        {"data": "fechaCambio"},
        {"data": "tipoMovimiento"},
        
        
        
        
       

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

