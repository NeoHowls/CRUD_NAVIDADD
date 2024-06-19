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

var fila; //captura la fila, para editar o eliminar
//submit para el Alta y Actualización
$('#formUsuarios').submit(function(e){                         
    e.preventDefault(); //evita el comportambiento normal del submit, es decir, recarga total de la página
    //CAPTURA EL DATO DEL FORMULARIO
    dni = $.trim($('#dni').val());
    nombre = $.trim($('#nombre').val());
    direccion = $.trim($('#direccion').val());
    telefono = $.trim($('#telefono').val());
    mail = $.trim($('#mail').val());
    idPerfil = $.trim($('#idPerfil').val());
    estado = $.trim($('#estado').val());
    usuario = $.trim($('#usuario').val());
    contrasena = $.trim($('#contrasena').val());
    checkHabilitado = $.trim($('#checkHabilitado').val());
    usuarioCambio = $.trim($('#usuarioCambio').val());
    fechaCambio = $.trim($('#fechaCambio').val());
    tipoMovimiento = $.trim($('#tipoMovimiento').val());
    checkOrganizacion= $.trim($('#more_infos').val());
    id_org= $.trim($('#O_ID').val());
    //console.log(opcion)                            
    //EJECUTA EL AJAX
    $.ajax({
        //Laa URL es similar al AJAX principaal pero en el op= capturaa la opcion del boton para ejecutar la consulta correcta
          url: "../controller/controllerPHistorial.php?op="+opcion,
          type: "POST",
          datatype:"json", 
          //La prueba al solo la tabla ETNIA CAPTURA SOLO 2 VALORES, EL ID Y LA ETNIA, el ID es en caso que se quiera editar   
          data:  {user_id:user_id,dni:dni,nombre:nombre,direccion:direccion,telefono:telefono,mail:mail,idPerfil:idPerfil,estado:estado,
            usuario:usuario,contrasena:contrasena,checkHabilitado:checkHabilitado,usuarioCambio:usuarioCambio,
            fechaCambio:fechaCambio,tipoMovimiento:tipoMovimiento,checkOrganizacion:checkOrganizacion, id_org:id_org},    
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
    opcion = "add_persona"; //alta           
    user_id=null;
    $("#formUsuarios").trigger("reset");
    $(".modal-header").css( "background-color", "#17a2b8");
    $(".modal-header").css( "color", "white" );
    $(".modal-title").text("Añadir Persona");
    $('#modalCRUD').modal('show');	    
});

//Editar       

$(document).on("click", ".btnEditar", function(){		        
    opcion = "edit_persona";//editar
    fila = $(this).closest("tr");	        
    user_id = parseInt(fila.find('td:eq(0)').text()); //capturo el ID		            
    dni = fila.find('td:eq(1)').text();
    nombre = fila.find('td:eq(2)').text();
    direccion = fila.find('td:eq(3)').text();
    telefono = fila.find('td:eq(4)').text();
    mail = fila.find('td:eq(5)').text();
    idPerfil = fila.find('td:eq(6)').text();
    estado = fila.find('td:eq(7)').text();
    usuario = fila.find('td:eq(8)').text();
    contrasena = fila.find('td:eq(9)').text();
    checkHabilitado = fila.find('td:eq(10)').text();
    usuarioCambio = fila.find('td:eq(11)').text();
    fechaCambio = fila.find('td:eq(12)').text();
    tipoMovimiento = fila.find('td:eq(13)').text();
    $("#dni").val(dni);
    $("#nombre").val(nombre);
    $("#direccion").val(direccion);
    $("#telefono").val(telefono);
    $("#mail").val(mail);
    $("#idPerfil").val(idPerfil);
    $("#estado").val(estado);
    $("#usuario").val(usuario);
    $("#contrasena").val(contrasena);
    $("#checkHabilitado").val(checkHabilitado);
    $("#usuarioCambio").val(usuarioCambio);
    $("#fechaCambio").val(fechaCambio);
    $("#tipoMovimiento").val(tipoMovimiento);

    $(".modal-header").css("background-color", "#007bff");
    $(".modal-header").css("color", "white" );
    $(".modal-title").text("Editar Usuario");		
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