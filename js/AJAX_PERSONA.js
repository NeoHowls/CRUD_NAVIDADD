
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

let table = $('#myTable1').DataTable( {
    // destroy : true,


    pageLength: 20,
    
    //TENGO QUE SEPARAR ESTO EN OTRO ARCHIVO
    "ajax":{
        url: "../controller/controllerP.php?op=persona",
        dataSrc:"",
        type: "post",
        responsive : true,
        aaSorting:[]

    },
    "columns":[

        {"data": "id"},
        {"data": "dni"},
        {"data": "nombreP"},
        {"data": "direccion"},
        {"data": "telefono"},
        {"data": "mail"},
        {"data": "idPerfil"},
        {"data": "estadoP"},
        {"data": "checkHabilitado"},
        {"data": "usuario"},
        {"data": "contrasena"},
        {"data": "idOrganizacion"},
        {"data": "NOMBRE_O"},
        {"data": "tipo"},

        {"data": "id"},
        {"data": "dni"},
        {"data": "nombreP"},
        {"data": "direccion"},
        {"data": "telefono"},
        {"data": "mail"},
        {"data": "idPerfil"},
        {"data": "estadoPersona"},
        {"data": "habilitado"},
        {"data": "usuario"},
        {"data": "contrasena"},
        {"data": "idOrganizacion"},
        {"data": "NOMBRE_O"},
        {"data": "organizacion"},
        {
            "data": null,
            "render": function(data, type, row) {
                // data es null ya que no especificamos una propiedad específica de data para esta columna
                let estadoPButton = '';
                if (row.estadoP == '1') {
                    estadoPButton = '<button type="button" class="btn btn-danger text-light btnBorrar me-2" data-toggle="tooltip" title="Desactivar usuario"><i class="bi bi-person-dash-fill icon-100"></i> </button>';
                } else {
                    estadoPButton = '<button type="button" class="btn btn-success text-light btnHabilitar me-2"data-toggle="tooltip" title="Activar usuario"><i class="bi bi-person-plus-fill icon-100"></i> </button>';
                }
        
                let checkHabilitadoButton = '';
                if (row.checkHabilitado == '1') {
                    checkHabilitadoButton = '<button type="button" class="btn btn-danger text-light btnDeshabilitar me-2" data-toggle="tooltip" title="Deshabilitar usuario"><i class="bi bi-x-square icon-100"></i> </button>';
                } else {
                    checkHabilitadoButton = '<button type="button" class="btn btn-success text-light btnAutorizar me-2" data-toggle="tooltip" title="Habilitar usuario"><i class="bi bi-check-square icon-100"></i> </button>';
                }
        
                // Botón de editar con modal
                let editarButton = '<button type="button" class="btn btn-primary text-light btnEditar me-2" data-bs-toggle="modal" data-bs-target="#myModal" title="Editar registro" data-toggle="tooltip"><i class="bi bi-pencil-square icon-100"></i></button>';
                //let PrintButton = '<button type="button" class="btn btn-outline-warning   btnimprimir me-2" data-bs-toggle="modal" data-bs-target="#myModal" title="Imprimir usuario y contraseña" data-toggle="tooltip"><i class="bi bi-filetype-pdf fs-5"></i></button>';
                
                let nombre1 = data["nombreP"];
                let usuario1 = data["usuario"];
                let contrasena1 = data["contrasena"];
                let nombreO=data["NOMBRE_O"];
                let organizacion1=data["organizacion"];

                pdf ="<button type='button' class='btn btn-warning me-2 btnAnular text-light'  title='Imprimir usuario y contraseña'"+
                    "onclick=\"crearpdf('"+usuario1+"','"+contrasena1+"','"+nombre1+"','"+nombreO+"','"+organizacion1+"')\">"+
                    "<i class='bi bi-filetype-pdf icon-100'></i>"+
                    "</button>"; 

                // Combinamos los botones en una sola columna
                return estadoPButton + checkHabilitadoButton + editarButton+ pdf;
            }
        }
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
                    columns: [15, 16, 17, 18, 19,21 ,22 ,26 ,27 ]
                }
            ] 
        }
    }
} );

// Funciones para generar usuario y contraseña
function generarUsuario(nombre) {
    let partes = nombre.split(' ');
    let usuario = partes[0].charAt(0) + (partes[1] || partes[0]);
    return usuario.toLowerCase();
}

function generarContrasena(dni) {
    // Elimina todos los caracteres que no sean dígitos
    const cleanDni = dni.replace(/\D/g, '');
    // Toma los últimos 6 caracteres del RUT limpio
    return cleanDni.slice(-6);
}

function actualizarUsuarioYContrasena() {
    let nombre = $('#nombre').val();
    let dni = $('#dni').val();
    if (nombre && dni) {
        let usuario = generarUsuario(nombre);
        let contrasena = generarContrasena(dni);
        $('#usuario').val(usuario);
        $('#contrasena').val(contrasena);
    }
}

$('#nombre').on('input', actualizarUsuarioYContrasena);
$('#dni').on('input', actualizarUsuarioYContrasena);


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
    estado = 1
    checkHabilitado = 1
    idOrganizacion= $.trim($('#O_ID').val());
    usuario = $('#usuario').val();
    contrasena = $('#contrasena').val();
    
  
    
    //EJECUTA EL AJAX
    $.ajax({
        //Laa URL es similar al AJAX principaal pero en el op= capturaa la opcion del boton para ejecutar la consulta correcta
          url: "../controller/controllerP.php?op="+opcion,
          type: "POST",
          datatype:"json", 
          //La prueba al solo la tabla ETNIA CAPTURA SOLO 2 VALORES, EL ID Y LA ETNIA, el ID es en caso que se quiera editar   
          data:  {user_id:user_id,dni:dni,nombre:nombre,direccion:direccion,telefono:telefono,mail:mail,idPerfil:idPerfil,estado:estado,
            checkHabilitado:checkHabilitado,usuario:usuario,contrasena:contrasena,checkOrganizacion:checkOrganizacion, idOrganizacion:idOrganizacion},    
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


    $("#dni").val('');
    $("#nombre").val('');
    $("#direccion").val('');
    $("#telefono").val('');
    $("#mail").val('');
    $("#idPerfil").val('');
    $("#estado").val('');
    $("#usuario").val('');
    $("#contrasena").val('');
    $("#O_ID").val('');

    // Deshabilitar los campos de usuario y contraseña
    $('#usuario').prop('readonly', true);
    $('#contrasena').prop('readonly', true);

    opcion = "add_persona"; //alta           
    user_id=null;
    idOrganizacion = 0

    if (idOrganizacion >= 1) {
        document.getElementById('more_infos').checked = true;
        $("#conditional_parts").show();
    }
    else {
        document.getElementById('more_infos').checked = false;
        $("#conditional_parts").hide();
    }
    checkOrganizacion = 0
    // Comprueba si el Check esta ON u OFF 
    checkboxNC = document.getElementById('more_infos');
    checkboxNC.addEventListener('change', function () {
        // Verifica si el checkbox está marcado o no
        if (this.checked) {
            console.log('El checkbox está activado.');
            checkOrganizacion = 1;
            $("#conditional_part").show();
        } else {
            console.log('El checkbox está desactivado.');
            checkOrganizacion = 0;
            $("#conditional_part").hide();
        }
    });
    
    $("#formUsuarios").trigger("reset");
    $(".modal-header").css( "background-color", "#17a2b8");
    $(".modal-header").css( "color", "white" );
    $(".modal-title").text("Añadir Persona");
    $('#modalCRUD').modal('show');
	    
});


//Editar       

$(document).on("click", ".btnEditar", function(){	
    $('#usuario').prop('readonly', false);
    $('#contrasena').prop('readonly', false);	        
    opcion = "edit_persona";//editar
    fila = $(this).closest("tr");	        
    user_id = fila.find('td:eq(0)').text(); //capturo el ID		            
    dni = fila.find('td:eq(1)').text();
    nombre = fila.find('td:eq(2)').text();
    direccion = fila.find('td:eq(3)').text();
    telefono = fila.find('td:eq(4)').text();
    mail = fila.find('td:eq(5)').text();
    idPerfil = fila.find('td:eq(6)').text();
    estado = fila.find('td:eq(7)').text();
    checkHabilitado = fila.find('td:eq(8)').text();
    usuario = fila.find('td:eq(9)').text();
    contrasena = fila.find('td:eq(10)').text();
    idOrganizacion = fila.find('td:eq(11)').text();
    checkOrganizacion = fila.find('td:eq(12)').text();
    
    $("#dni").val(dni);
    $("#nombre").val(nombre);
    $("#direccion").val(direccion);
    $("#telefono").val(telefono);
    $("#mail").val(mail);
    $("#idPerfil").val(idPerfil);
    $("#estado").val(estado);
    $("#usuario").val(usuario);
    $("#contrasena").val(contrasena);
    $("#O_ID").val(idOrganizacion);
    $(".modal-header").css("background-color", "#007bff");
    $(".modal-header").css("color", "white" );
    $(".modal-title").text("Editar Usuario");		
    $('#modalCRUD').modal('show');
    
    //AUTO DETECTOR DE CHECK CUANDO SE LEE LOS DATOS DEVUELTA CUANDO SE EDITA
    //Se comprueba si la variable CHECKCREATE  1, en caso de serlo simplemente auto levanta el Check en caso de que no sea asi baja el check 
    //



// Comprueba si el Check esta ON u OFF 
checkboxNC = document.getElementById('more_infos');
checkboxNC.addEventListener('change', function () {
    // Verifica si el checkbox está marcado o no
    if (this.checked) {
        console.log('El checkbox está activado.');
        checkOrganizacion = 1;
        $("#conditional_part").show();
    } else {
        console.log('El checkbox está desactivado.');
        checkOrganizacion = 0;
    }
});

if (idOrganizacion >= 1) {
    document.getElementById('more_infos').checked = true;
    $("#conditional_parts").show();
    checkOrganizacion = 1
    console.log('El checkbox está activado@@@.');
}
else {
    document.getElementById('more_infos').checked = false;
    $("#conditional_parts").hide();
    checkOrganizacion = 0
    console.log('El checkbox está desactivado@@@.');
}

});

window.addEventListener("keydown", (e) => {
    if (e.keyCode === 13) {
        e.preventDefault(); // Previene el comportamiento por defecto del Enter
        $('#btnGuardar').click(); // Dispara el evento de clic en el botón "Iniciar Sesión"
    }
  });

$(document).on("click", ".btnimprimir", function(e){
   
    fila = $(this).closest('tr');           
    user_id = $(this).closest('tr').find('td:eq(0)').text() ;
    nombre = $(this).closest('tr').find('td:eq(2)').text() ;
    contrasena = $(this).closest('tr').find('td:eq(10)').text() ;
    usuario = $(this).closest('tr').find('td:eq(9)').text();
         
        $.ajax({
          url: "../controller/controllerP.php?op=imprimir",
          type: "POST",
          datatype:"json",    
            data: { user_id: user_id, usuario: usuario, contrasena: contrasena},
          success: function(data) {
   
           },
           error: function(xhr, status, error) {
            console.error("Error en la operación:", error);
        }
        });	    	    
    }
 );    

//Borrar/activar estado
$(document).on("click", ".btnBorrar, .btnHabilitar", function(e){
    e.preventDefault(); //evita el comportambiento normal del submit, es decir, recarga total de la página
    fila = $(this).closest('tr');           
    user_id = $(this).closest('tr').find('td:eq(0)').text() ;
    nombre = $(this).closest('tr').find('td:eq(2)').text() ;
    estado = $(this).closest('tr').find('td:eq(7)').text() ;
    dni = $(this).closest('tr').find('td:eq(1)').text();
    let action = estado == '1' ? 'borrar_persona' : 'habilitar_persona';
    let confirmMessage = estado == '1' ? "¿Está seguro de Desactivar el registro de "+nombre+"?" : "¿Quieres activar al usuario "+nombre+"?"  ;
    let respuesta = confirm(confirmMessage);
    console.log("funciona")
    console.log(dni)
    if (respuesta) {            
        $.ajax({
          url: "../controller/controllerP.php?op=borrar_persona",
          type: "POST",
          datatype:"json",    
            data: { user_id: user_id, estado: estado, dni: dni },
          success: function(data) {
            table.ajax.reload(null, false);
           },
           error: function(xhr, status, error) {
            console.error("Error en la operación:", error);
        }
        });	    	    
    }
 });

 //deshabilitar/habiliar 
$(document).on("click", ".btnDeshabilitar, .btnAutorizar", function(e){
    e.preventDefault(); //evita el comportambiento normal del submit, es decir, recarga total de la página
    fila = $(this).closest('tr');           
    user_id = $(this).closest('tr').find('td:eq(0)').text() ;
    nombre = $(this).closest('tr').find('td:eq(2)').text() ;
    dni = $(this).closest('tr').find('td:eq(1)').text();
    checkHabilitado = $(this).closest('tr').find('td:eq(8)').text() ;
    let action = checkHabilitado == '1' ? 'borrar_persona' : 'habilitar_persona';
    let confirmMessage =  checkHabilitado== '1' ? "¿Está seguro que desesa deshabilitar el registro de "+nombre+"?" : "¿Quieres habilitar el registro de "+nombre+"?"  ;
    let respuesta = confirm(confirmMessage);
  
    if (respuesta) {            
        $.ajax({
          url: "../controller/controllerP.php?op=Habilitar_persona",
          type: "POST",
          datatype:"json",    
            data: { user_id: user_id, checkHabilitado: checkHabilitado, dni: dni } ,
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
    let dni = fila.find('td:eq(1)').text();
    let checkHabilitado = $(this).closest('tr').find('td:eq(8)').text() ;
    let confirmMessage = "¿Quieres habilitar todos los registros?";
    let respuesta = confirm(confirmMessage);
  
    if (respuesta) {            
        $.ajax({
            url: "../controller/controllerP.php?op=habGeneral",
            type: "POST",
            dataType: "json",
            data: { user_id: user_id, checkHabilitado:checkHabilitado, dni: dni },
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
    let dni = fila.find('td:eq(1)').text();
    let checkHabilitado = $(this).closest('tr').find('td:eq(8)').text() ;
    let confirmMessage = "¿Quieres deshabilitar todos los registros?";
    let respuesta = confirm(confirmMessage);
  
    if (respuesta) {            
        $.ajax({
            url: "../controller/controllerP.php?op=DesHabGeneral",
            type: "POST",
            dataType: "json",
            data: { user_id: user_id, checkHabilitado:checkHabilitado, dni: dni },
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

 
  function crearpdf(usuario1,contrasena1,nombre1,nombreO,organizacion1){
    // alert(
    window.open("../crearPdf.php?usuario="+usuario1+" &contrasena="+contrasena1+"&nombre="+nombre1+"&organizacion="+nombreO+"&tipo="+organizacion1);
   
  
}
//table.draw();

 // Inicializa el campo con el prefijo "+569"
 document.getElementById('telefono').value = '+569';

 function validatePhoneNumber(input) {
     // Asegurarse de que el prefijo "+569" no se pueda borrar
     if (input.value.indexOf('+569') !== 0) {
         input.value = '+569' + input.value.substring(4).replace(/[^0-9]/g, '');
     } else {
         // Permitir solo números después del prefijo "+569"
         input.value = '+569' + input.value.substring(4).replace(/[^0-9]/g, '');
     }

     // Limitar la longitud total del campo a 15 caracteres
     if (input.value.length > 15) {
         input.value = input.value.substring(0, 15);
     }

     // Mostrar mensaje de error si se intenta ingresar caracteres no permitidos
     const errorMessage = document.querySelector('.help-block');
     if (/[^0-9]/.test(input.value.substring(4))) {
         errorMessage.textContent = 'Por favor ingrese solo números.';
     } else {
         errorMessage.textContent = '';
     }
 }

 // Evitar que se pueda borrar el prefijo usando el evento keydown
 document.getElementById('telefono').addEventListener('keydown', function(e) {
     const key = e.key;
     if (this.selectionStart < 4 && (key === 'Backspace' || key === 'Delete')) {
         e.preventDefault();
     }
 });
