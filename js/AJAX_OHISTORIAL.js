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
 

let table = $('#myTable5').DataTable( {
    // destroy : true,


    pageLength: 20,
    
    //TENGO QUE SEPARAR ESTO EN OTRO ARCHIVO
    "ajax":{
        url: "../controller/controllerOHistorial.php?op=organizacionH",
        dataSrc:"",
        type: "post",
        responsive : true,
        aaSorting:[]

    },
    "columns":[

        {"data": "id"},
        {"data": "nombre"},
        {"data": "direccion"},
        {"data": "tipo"},
        {"data": "fechaIngreso"},
        {"data": "checkVigente"},
        {"data": "numProvidencia"},
        {"data": "checkHabilitado"},
        {"data": "estado"},
        {"data": "usuarioCambio"},
        {"data": "fechaCambio"},
        {"data": "tipoMovimiento"}

        
       

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

var fila; //captura la fila, para editar o eliminar
//submit para el Alta y Actualización
$('#formUsuarios').submit(function(e){                         
    e.preventDefault(); //evita el comportambiento normal del submit, es decir, recarga total de la página
    //CAPTURA EL DATO DEL FORMULARIO
    nombre = $.trim($('#nombre').val());
    direccion = $.trim($('#direccion').val());
    tipo = $.trim($('#tipo').val());
    fechaIngreso = $.trim($('#fechaIngreso').val());
    checkVigente = $.trim($('#checkVigente').val());
    numProvidencia = $.trim($('#numProvidencia').val());   
    checkHabilitado = $.trim($('#checkHabilitado').val());
    estado = $.trim($('#estado').val());
    usuarioCambio = $.trim($('#usuarioCambio').val());
    fechaCambio = $.trim($('#fechaCambio').val());
    tipoMovimiento = $.trim($('#tipoMovimiento').val());
    
    //console.log(opcion)                            
    //EJECUTA EL AJAX
    $.ajax({
        //Laa URL es similar al AJAX principaal pero en el op= capturaa la opcion del boton para ejecutar la consulta correcta
          url: "../controller/controllerOHistorial.php?op="+opcion,
          type: "POST",
          datatype:"json", 
          //La prueba al solo la tabla ETNIA CAPTURA SOLO 2 VALORES, EL ID Y LA ETNIA, el ID es en caso que se quiera editar   
          data:  {user_id:user_id,nombre:nombre, direccion:direccion, tipo:tipo, fechaIngreso:fechaIngreso, 
            checkVigente:checkVigente, numProvidencia:numProvidencia, checkHabilitado:checkHabilitado, estado:estado,
            usuarioCambio:usuarioCambio,fechaCambio:fechaCambio,tipoMovimiento:tipoMovimiento},    
          //Si todo funiona recarga el AJAX
          success: function(data) {
            table.ajax.reload(null, false);
           }
        });		
        
        //EL MODAL SE DESTRUYE/ESCONDE NUEVAMENTE COMO SE LIMPIA LOS DATOS        
    
        $('#modalCRUD').modal('hide');											     			
});
        
 

//para limpiar los campos antes de dar de Alta una Persona
$("#btnNuevo").click(function(){
    opcion = "add_organizacion"; //alta           
    user_id=null; 
    $("#formUsuarios").trigger("reset");
    $(".modal-header").css( "background-color", "#17a2b8");
    $(".modal-header").css( "color", "white" );
    $(".modal-title").text("Añadir Organizacion");
    $('#modalCRUD').modal('show');	    
});

//Editar       

$(document).on("click", ".btnEditar", function(){		        
    opcion = "edit_organizacion";//editar
    fila = $(this).closest("tr");	        
    user_id = parseInt(fila.find('td:eq(0)').text()); //capturo el ID		            
    nombre = fila.find('td:eq(1)').text();
    direccion = fila.find('td:eq(2)').text();
    tipo = fila.find('td:eq(3)').text();
    fechaIngreso = fila.find('td:eq(4)').text();
    checkVigente= fila.find('td:eq(5)').text();
    numProvidencia= fila.find('td:eq(6)').text();
    checkHabilitado=fila.find('td:eq(7)').text();
    estado= fila.find('td:eq(8)').text();
    usuarioCambio = fila.find('td:eq(9)').text();
    fechaCambio = fila.find('td:eq(10)').text();
    tipoMovimiento = fila.find('td:eq(11)').text();
    $("#nombre").val(nombre);
    $("#direccion").val(direccion);
    $("#tipo").val(tipo);
    $("#fechaIngreso").val(fechaIngreso);
    $("#checkVigente").val(checkVigente);
    $("#numProvidencia").val(numProvidencia);
    $("#checkHabilitado").val(checkHabilitado);
    $("#estado").val(estado);
    $("#usuarioCambio").val(usuarioCambio);
    $("#fechaCambio").val(fechaCambio);
    $("#tipoMovimiento").val(tipoMovimiento);
    $(".modal-header").css("background-color", "#007bff");
    $(".modal-header").css("color", "white" );
    $(".modal-title").text("Editar Organizacion");		
    $('#modalCRUD').modal('show');		   
});

//Borrar
$(document).on("click", ".btnBorrar", function(){
    fila = $(this);           
    user_id = parseInt($(this).closest('tr').find('td:eq(0)').text()) ;		
    opcion = 3; //eliminar        
    var respuesta = confirm("¿Está seguro de borrar el registro "+user_id+"?");                
    if (respuesta) {            
        $.ajax({
          url: "bd/crud.php",
          type: "POST",
          datatype:"json",    
          data:  {opcion:opcion, user_id:user_id},    
          success: function() {
            table.row(fila.parents('tr')).remove().draw();                  
           }
        });	
    }
 });

 function cerrarModal() {
    $('#fondo-modal').hide();
  }



//table.draw();