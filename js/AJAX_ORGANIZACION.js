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
 
$(document).ready(function () {
    $('[data-toggle="tooltip"]').tooltip({
        delay: { show: 0, hide: 0 }
});    
});

let table = $('#myTable2').DataTable( {
    // destroy : true,


    pageLength: 20,
    
    //TENGO QUE SEPARAR ESTO EN OTRO ARCHIVO
    "ajax":{
        url: "../controller/controllerO.php?op=organizacion",
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
        {"data": "aniosVigente"},
        {"data": "vigente"},
        {
            "data": null,
            "render": function(data, type, row) {
                // data es null ya que no especificamos una propiedad específica de data para esta columna
                let checkHabilitadoButton = '';
                if (row.checkHabilitado == '1') {
                    checkHabilitadoButton = '<button type="button" class="btn btn-danger text-dark btnDeshabilitar me-2" data-toggle="tooltip" title="Deshabilitar Organizacion"><i class="bi bi-x-square"></i> </button>';
                } else {
                    checkHabilitadoButton = '<button type="button" class="btn btn-success text-dark btnAutorizar me-2" data-toggle="tooltip" title="Habilitar Organizacion"><i class="bi bi-check-square"></i> </button>';
                }
        
                // Botón de editar con modal
                let editarButton = '<button type="button" class="btn btn-primary text-dark btnEditar me-2" data-bs-toggle="modal" data-bs-target="#myModal" title="Editar registro" data-toggle="tooltip"><i class="bi bi-pencil-square"></i></button>';

                // Combinamos los botones en una sola columna
                return checkHabilitadoButton + editarButton;
            }
        }
        
        
        
        
       

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
    aniosVigente = $.trim($('#aniosVigente').val());
    checkVigente = $.trim($('#checkVigente').val());
    numProvidencia = $.trim($('#numProvidencia').val());   
    checkHabilitado = $.trim($('#checkHabilitado').val());
    estado = $.trim($('#estado').val());
   
    
    //console.log(opcion)                            
    //EJECUTA EL AJAX
    $.ajax({
        //Laa URL es similar al AJAX principaal pero en el op= capturaa la opcion del boton para ejecutar la consulta correcta
          url: "../controller/controllerO.php?op="+opcion,
          type: "POST",
          datatype:"json", 
          //La prueba al solo la tabla ETNIA CAPTURA SOLO 2 VALORES, EL ID Y LA ETNIA, el ID es en caso que se quiera editar   
          data:  {user_id:user_id,nombre:nombre, direccion:direccion, tipo:tipo, fechaIngreso:fechaIngreso,aniosVigente:aniosVigente, checkVigente:checkVigente, numProvidencia:numProvidencia, checkHabilitado:checkHabilitado, estado:estado},    
          //Si todo funiona recarga el AJAX
          success: function(data) {
            table.ajax.reload(null, false);
           }
        });		
        
        //EL MODAL SE DESTRUYE/ESCONDE NUEVAMENTE COMO SE LIMPIA LOS DATOS        
    
        $('#modalCRUD').modal('hide');											     			
});
        
 

$("#btnNuevo").click(function(){
    opcion = "add_organizacion"; // Indica que se está agregando una nueva organización
    user_id = null; // Reinicia el ID del usuario a null o lo que sea adecuado en tu lógica

    // Limpiar todos los campos del formulario modal
    $("#nombre").val('');
    $("#direccion").val('');
    $("#tipo").val('');
    $("#fechaIngreso").val('');
    $("#checkVigente").val('');
    $("#numProvidencia").val('');
    $("#checkHabilitado").val('');
    $("#estado").val('');
    $("#aniosVigente").val('');

    // Reiniciar el estado de los campos relacionados con el tipo de organización
    document.getElementById('numProvidenciaGroup').style.display = 'none';
    document.getElementById('aniosVigente').disabled = false;

    // Mostrar el modal y configurar estilos y título
    $(".modal-header").css("background-color", "#17a2b8");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Añadir Organización");

    $('#modalCRUD').modal('show');

    // Manejar el cambio en el campo tipo (si es necesario para tu lógica)
    $("#tipo").on("change", function() {
        if ($(this).val() === '4') {
            $("#numProvidenciaGroup").show();
            $("#aniosVigente").val('1').prop('disabled', true);
        } else {
            $("#numProvidenciaGroup").hide();
            $("#aniosVigente").prop('disabled', false);
        }
    });
});


//Editar       

$(document).on("click", ".btnEditar", function(){	        
    opcion = "edit_organizacion";//editar

    selections = document.getElementById('tipo');
    selections.addEventListener('change', function () {
        // Verifica si el checkbox está marcado o no
        if (selections.value === '4') {
            document.getElementById('aniosVigente').style.display = 'block'
            document.getElementById('numProvidenciaGroup').style.display = 'block'
            document.getElementById('aniosVigente').value = '1'
            document.getElementById('aniosVigente').disabled = true
        }else {
            document.getElementById('numProvidenciaGroup').style.display = 'none'
            document.getElementById('aniosVigenteSelect').disabled = false
        }
});

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
    aniosVigente= fila.find('td:eq(9)').text();
    $("#nombre").val(nombre);
    $("#direccion").val(direccion);
    $("#tipo").val(tipo);
    $("#fechaIngreso").val(fechaIngreso);
    $("#checkVigente").val(checkVigente);
    $("#numProvidencia").val(numProvidencia);
    $("#checkHabilitado").val(checkHabilitado);
    $("#estado").val(estado);
    $("#aniosVigente").val(aniosVigente);
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

  //deshabilitar/habiliar 
$(document).on("click", ".btnDeshabilitar, .btnAutorizar", function(e){
    e.preventDefault(); //evita el comportambiento normal del submit, es decir, recarga total de la página
    fila = $(this).closest('tr');           
    user_id = $(this).closest('tr').find('td:eq(0)').text() ;
    nombre = $(this).closest('tr').find('td:eq(1)').text() ;
    checkHabilitado = $(this).closest('tr').find('td:eq(7)').text() ;
    let action = checkHabilitado == '1' ? 'borrar_persona' : 'habilitar_persona';
    let confirmMessage =  checkHabilitado== '1' ? "¿Está seguro que desesa deshabilitar el registro de "+nombre+"?" : "¿Quieres habilitar el registro de "+nombre+"?"  ;
    let respuesta = confirm(confirmMessage);
  
    if (respuesta) {            
        $.ajax({
          url: "../controller/controllerO.php?op=Habilitar_organizacion",
          type: "POST",
          datatype:"json",    
            data: { user_id: user_id, checkHabilitado: checkHabilitado,nombre:nombre} ,
          success: function(data) {
            table.ajax.reload(null, false);
           },
           error: function(xhr, status, error) {
            console.error("Error en la operación:", error);
        }
        });	    	    
    }
 });

 // Deshabilitar General 
$(document).on("click", ".btnDesHabGeneral", function(e){
    e.preventDefault(); // Evita el comportamiento normal del submit, es decir, recarga total de la página
    let fila = $(this).closest('tr');           
    let user_id = fila.find('td:eq(0)').text();
    nombre = $(this).closest('tr').find('td:eq(1)').text() ;
    let checkHabilitado = $(this).closest('tr').find('td:eq(7)').text() ;
    let confirmMessage = "¿Quieres deshabilitar todos los registros?";
    let respuesta = confirm(confirmMessage);
  
    if (respuesta) {            
        $.ajax({
            url: "../controller/controllerO.php?op=DesHabGeneralO",
            type: "POST",
            dataType: "json",
            data: { user_id: user_id, checkHabilitado:checkHabilitado,nombre:nombre},
            success: function(data) {
                table.ajax.reload(null, false);
            },
            error: function(xhr, status, error) {
                console.error("Error en la operación:", error);
            }
        });	    	    
    }
});

// Habilitar General 
$(document).on("click", ".btnHabGeneral", function(e){
    e.preventDefault(); // Evita el comportamiento normal del submit, es decir, recarga total de la página
    let fila = $(this).closest('tr');           
    let user_id = fila.find('td:eq(0)').text();
    nombre = $(this).closest('tr').find('td:eq(1)').text() ;
    let checkHabilitado = $(this).closest('tr').find('td:eq(7)').text() ;
    let confirmMessage = "¿Quieres habilitar todos los registros?";
    let respuesta = confirm(confirmMessage);
  
    if (respuesta) {            
        $.ajax({
            url: "../controller/controllerO.php?op=habGeneralO",
            type: "POST",
            dataType: "json",
            data: { user_id: user_id, checkHabilitado:checkHabilitado, nombre:nombre },
            success: function(data) {
                table.ajax.reload(null, false);
            },
            error: function(xhr, status, error) {
                console.error("Error en la operación:", error);
            }
        });	    	    
    }
});


 function cerrarModal() {
    $('#fondo-modal').hide();
  }



//table.draw();