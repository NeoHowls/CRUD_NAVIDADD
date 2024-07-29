let checkOrganizacion='';


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

let listarPersonas = function(){
    table = $('#myTable1').DataTable( {
    destroy : true,


    pageLength: 50,
    
    //TENGO QUE SEPARAR ESTO EN OTRO ARCHIVO
    "ajax":{
        url: "../controller/controllerP.php?op=persona",
        dataSrc:"",
        type: "post",
        responsive : true,
        aaSorting:[]

    },
    "columns":[

        {"data": "id"},//0
        {"data": "dni"},//1
        {"data": "nombreP"},//2
        {"data": "direccion"},//3
        {"data": "telefono"},//4
        {"data": "mail"},//5
        {"data": "idPerfil"},//6
        {"data": "estadoP"},//7
        {"data": "checkHabilitado"},//8
        {"data": "usuario"},//9
        {"data": "contrasena"},//10
        {"data": "idOrganizacion"},//11
        {"data": "NOMBRE_O"},//12
        {"data": "tipo"},//13

        {"data": "id"},//14
        {"data": "dni"},//15
        {"data": "nombreP"},//16
        {"data": "direccion"},//17
        {"data": "telefono"},//18          
        {"data": "mail"},//19
        {"data": "idPerfil"},//20
        {"data": "estadoPersona"},//21
        {"data": "habilitado"},//22
        {"data": "usuario"},//23
        {"data": "contrasena"},//24
        {"data": "idOrganizacion"},//25
        {"data": "NOMBRE_O"},//26
        {"data": "organizacion"},//27
        {//28
            "data": null,
            "render": function(data, type, row) {

                $(document).ready(function () {
                    $('[data-toggle="tooltip"]').tooltip({
                        delay: { show: 0, hide: 0 },
                        placement: 'top'
                });    
                });
                
                // data es null ya que no especificamos una propiedad específica de data para esta columna
                let estadoPButton = '';
                if (row.estadoP == '1') {
                    estadoPButton = '<button type="button" class="btn btn-danger text-light btnBorrar me-2" data-toggle="tooltip" data-placement="top" title="Desactivar usuario"><i class="bi bi-person-dash-fill icon-100"></i> </button>';
                } else {
                    estadoPButton = '<button type="button" class="btn btn-success text-light btnHabilitar me-2" data-toggle="tooltip" data-placement="top" title="Activar usuario"><i class="bi bi-person-plus-fill icon-100"></i> </button>';
                }
        
                let checkHabilitadoButton = '';
                if (row.checkHabilitado == '1') {
                    checkHabilitadoButton = '<button type="button" class="btn btn-danger text-light btnDeshabilitar me-2" data-toggle="tooltip" data-placement="top" title="Deshabilitar Usuario Web"><i class="bi bi-x-square icon-100"></i> </button>';
                } else {
                    checkHabilitadoButton = '<button type="button" class="btn btn-success text-light btnAutorizar me-2" data-toggle="tooltip" data-placement="top" title="Habilitar usuario Web"><i class="bi bi-check-square icon-100"></i> </button>';
                }
        
                let editarButton = '';
                    if (row.checkHabilitado == '1') {
                        // editarButton = '<button type="button" class="btn btn-primary text-light btnEditar me-2" data-bs-toggle="modal" data-bs-target="#myModal" data-toggle="tooltip" data-placement="top" title="Editar registro" ><i class="bi bi-pencil-square icon-100"></i></button>';
                        editarButton = '<button type="button" class="btn btn-primary text-light btnEditar me-2" data-toggle="tooltip" data-placement="top" title="Editar registro" ><i class="bi bi-pencil-square icon-100"></i></button>';
                    } else {
                        editarButton = '<button type="button" class="btn btn-secondary text-light btnEditar me-2" data-toggle="tooltip" data-placement="top" title="No se puede editar"  disabled><i class="bi bi-pencil-square icon-100"></i></button>';
                    }
                    
                let nombre1 = data["nombreP"];
                let usuario1 = data["usuario"];
                let contrasena1 = data["contrasena"];
                let nombreO=data["NOMBRE_O"];
                let organizacion1=data["organizacion"];

                pdf ="<button type='button' class='btn btn-warning me-2 btnAnular text-light' data-toggle='tooltip' data-placement='top' title='Imprimir usuario y contraseña'"+
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
    },
    columnDefs: [
        // Center align the header content of column 1
       { className: "dt-head-center", targets: [15,16,18,19,21,22,26,27,28] },
       // Center align the body content of columns 2, 3, & 4
       { className: "dt-body-center", targets: [21,22,28] },
        { className: "dt-body-left", targets: [18] }
    ]
} );
}//fin funcion



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
//todo: guardar editar------------------------------------
//todo: guardar editar------------------------------------
//todo: guardar editar------------------------------------
$('#formUsuarios').submit(function(e){                         
    e.preventDefault(); //evita el comportambiento normal del submit, es decir, recarga total de la página
    //CAPTURA EL DATO DEL FORMULARIO
    user_id = $.trim($("#id").val());
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
    
    // alert("direccion "+direccion);
    
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
          beforeSend: function(){
            //  console.log("enviado");
          },
            //Si todo funiona recarga el AJAX
          success: function(data) {
            table.ajax.reload(null, false);
           },
           error:function(){
                 alert("error");
           }
        }).done(function(response){
            //console.log(response);
            respuesta = JSON.parse(response);
            for(i=0;i<respuesta.length;i++){
            if(respuesta[i].error==1)
                {$('#m_dni').html(respuesta[i].mensaje);}
            if(respuesta[i].error==2)
                {$('#m_nombre').html(respuesta[i].mensaje);}
            if(respuesta[i].error==3)
                {$('#m_direccion').html(respuesta[i].mensaje);}
            if(respuesta[i].error==4)
                {$('#m_mail').html(respuesta[i].mensaje);}
            if(respuesta[i].error==5)
                {$('#m_telefono').html(respuesta[i].mensaje);}
            if(respuesta[i].error==6)
                {$('#m_perfil').html(respuesta[i].mensaje);}
            if(respuesta[i].error==7)
                {$('#m_organizacion').html(respuesta[i].mensaje);}
            if(respuesta[i].error==8)
                {$('#m_user').html(respuesta[i].mensaje);}
            if(respuesta[i].error==9)
                {$('#m_pass').html(respuesta[i].mensaje);}
            }
 
        		
        
        //EL MODAL SE DESTRUYE/ESCONDE NUEVAMENTE COMO SE LIMPIA LOS DATOS        
        if(respuesta.length==1 && respuesta[0].error==0){
            // console.log("correcto");
            $('#modalCRUD').modal('hide');
            Swal.fire({
                icon: "success",
                title: "PERSONA INGRESADO / ACTUALIZADO",
                width: 300,
                showConfirmButton: false,
                timer: 2000
            });
        }else if(respuesta.length>0){
            //console.log("errores");
            
        }else{
            $('#modalCRUD').modal('hide');
        }
        
        });//fin done;										     			
});
        
//todo: verificacion de mensaje error al seleccionar input
$('#dni').on('change click', function() {
    $('#m_dni').text('');
});
$('#nombre').on('change click', function() {
    $('#m_nombre').text('');
});
$('#direccion').on('change click', function() {
    $('#m_direccion').text('');
});
$('#mail').on('change click', function() {
    $('#m_mail').text('');
}); 
$('#telefono').on('change click', function() {

    $('#m_telefono').text('');
});
$('#idPerfil').on('change click', function() {
    $('#m_perfil').text('');
}); 

$('#O_ID').on('change click', function() {
    $('#m_organizacion').text('');
}); 
$('#usuario').on('change click', function() {
    $('#m_user').text('');
});
$('#contrasena').on('change click', function() {
    $('#m_pass').text('');
});
//!----------------------------------------------------
//!----------------------------------------------------


function limpiarContenidoMensajes(){
    $('#m_dni').text('');
    $('#m_nombre').text('');
    $('#m_direccion').text('');
    $('#m_mail').text('');
    $('#m_telefono').text('');
    $('#m_perfil').text('');
    $('#m_organizacion').text('');
    $('#m_user').text('');
    $('#m_pass').text('');
}

//!----------------------------------------------------
//!----------------------------------------------------

//para limpiar los campos antes de dar de Alta una Persona
$(document).ready(function() {
    // Ocultar o mostrar el checkbox y su etiqueta dependiendo del perfil seleccionado
    $('#idPerfil').change(function() {
        var selectedOption = $(this).find('option:selected');
        var perfilId = selectedOption.val();
        var perfilText = selectedOption.text().toLowerCase();

        if (perfilId == 9) { // Representante
            $('#checkbox-container').show();
            $('#more_infos').prop('checked', true).prop('disabled', true).change(); // Activa y desactiva el checkbox
        } else if (perfilId == 10) { // Providencia
            $('#checkbox-container').show();
            $('#more_infos').prop('checked', true).prop('disabled', true).change();
            $('#conditional_parts').show();
            $('#O_ID').val('').change(); // Resetear el valor del select
            $('#O_ID option').each(function() {
                if ($(this).data('tipo') == 4) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        } else if (perfilText === 'administrador' || perfilText === 'dideco') {
            $('#checkbox-container').hide();
            $('#more_infos').prop('checked', false).prop('disabled', false).change();
        } else {
            $('#checkbox-container').hide();
            $('#more_infos').prop('checked', false).prop('disabled', false).change();
            $('#conditional_parts').hide();
        }
    });

    // Mostrar u ocultar el selector de organización dependiendo del checkbox
    $('#more_infos').change(function() {
        var selectedPerfil = $('#idPerfil').val();
        if ($(this).is(':checked')) {
            $('#conditional_parts').show();
            if (selectedPerfil == 9) { // Representante
                checkOrganizacion = 1;
                $('#O_ID').val('').change(); // Resetear el valor del select
                $('#m_organizacion').text('');
                $('#O_ID option').each(function() {
                    var tipo = $(this).data('tipo');
                    if (tipo == 1 || tipo == 2 || tipo == 3) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            }
        } else {
            $('#conditional_parts').hide();
        }
    });

    //todo: Inicializar el formulario al hacer clic en el botón "Nuevo"
    $("#btnNuevo").click(function() {
        // Limpiar campos
        limpiarContenidoMensajes();
        $("#id").val('');
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

        opcion = "add_persona"; // alta
        user_id = null;
        idOrganizacion = 0;

        if (idOrganizacion >= 1) {
            $('#more_infos').prop('checked', true).prop('disabled', true);
            $("#conditional_parts").show();
        } else {
            $('#more_infos').prop('checked', false).prop('disabled', false);
            $("#conditional_parts").hide();
        }
        checkOrganizacion = 0;

        // Configurar el evento de cambio para el checkbox "Desea agregar Organización"
        var checkboxNC = document.getElementById('more_infos');
        checkboxNC.addEventListener('change', function() {
            if (this.checked) {
                //console.log('El checkbox está activado.');
                checkOrganizacion = 1;
                $("#conditional_parts").show();
            } else {
                //console.log('El checkbox está desactivado.');
                checkOrganizacion = 0;
                $("#conditional_parts").hide();
            }
        });

        // Resetear el formulario y mostrar el modal
        $("#formUsuarios").trigger("reset");
        $(".modal-header").css("background-color", "#17a2b8");
        $(".modal-header").css("color", "white");
        $(".modal-title").text("Añadir Persona");
        $('#modalCRUD').modal('show');

        
    });

    // Validar el formulario antes de enviarlo
    $('#formUsuarios').submit(function(event) {
        var perfilVal = $('#idPerfil').val();
        var organizacionVal = $('#O_ID').val();

        var isValid = true;

        if (perfilVal === "") {
            $('#perfilError').text("Por favor, selecciona un perfil.");
            isValid = false;
        } else {
            $('#perfilError').text("");
        }

        if ($('#more_infos').is(':checked') && organizacionVal === "") {
            $('#organizacionError').text("Por favor, selecciona una organización.");
            isValid = false;
        } else {
            $('#organizacionError').text("");
        }

        if (!isValid) {
            event.preventDefault();
        }
    });
});



//todo: Editar -------------------------------------------
//todo: Editar ------------------------------------------- 
//todo: Editar -------------------------------------------       
$(document).on("click", ".btnEditar", function() {
    limpiarContenidoMensajes();
    // $("#dni").val('');
    $('#usuario').prop('readonly', false);
    $('#contrasena').prop('readonly', false);	        
    opcion = "edit_persona"; // editar
    fila = $(this).closest("tr");	        
    user_id = fila.find('td:eq(0)').text(); // capturo el ID		            
    dni = fila.find('td:eq(1)').text();
    nombre = fila.find('td:eq(2)').text();
    direccion = fila.find('td:eq(3)').text();
    telefono = fila.find('td:eq(4)').text();
    mail = fila.find('td:eq(5)').text();
    idPerfil = fila.find('td:eq(6)').text();
    estado = fila.find('td:eq(7)').text();
    usuario = fila.find('td:eq(9)').text();
    contrasena = fila.find('td:eq(10)').text();
    idOrganizacion = fila.find('td:eq(11)').text();
    
    
    $("#id").val(user_id);
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
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Editar Usuario");		
    $('#modalCRUD').modal('show');
    
    // Mostrar el checkbox "Desea agregar Organización" según el valor de idOrganizacion
    if (idOrganizacion >= 1) {
        $('#more_infos').prop('checked', true);
        $('#checkbox-container').show();
        $("#conditional_parts").show();
    } else {
        $('#more_infos').prop('checked', false);
        $('#checkbox-container').hide();
        $("#conditional_parts").hide();
    }
    
    // Comprobar si el perfil es "Representante" o "Providencia"
    if (idPerfil == 9) { // Representante
        $('#checkbox-container').show();
        $('#more_infos').prop('checked', true).prop('disabled', true).change(); // Activa y desactiva el checkbox
        $('#O_ID').val(idOrganizacion); // Captura la organización
        $("#O_ID option").each(function() {
            var tipo = $(this).data('tipo');
            if (tipo == 1 || tipo == 2 || tipo == 3) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    } else if (idPerfil == 10) { // Providencia
        $('#checkbox-container').show();
        $('#more_infos').prop('checked', true).prop('disabled', true).change(); // Activa y desactiva el checkbox
        $('#O_ID').val(idOrganizacion); // Captura la organización
        $('#O_ID option').each(function() {
            if ($(this).data('tipo') == 4) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    } else {
        $('#checkbox-container').hide();
        $('#more_infos').prop('checked', false).prop('disabled', false).change();
        $('#conditional_parts').hide();
    }

    //! poner solo los perfiles seleccionables al editar
    //! si es representante o providencia || administrador o dideco

    $('#idPerfil option').show(); // Primero muestra todas las opciones
    
    if (idPerfil == 7 || idPerfil == 8) {
        $('#idPerfil option').each(function() {
            var valor = $(this).val();
            if (valor != 7 && valor != 8 && valor != '') {
                checkOrganizacion = 0;//!segun felipe
                $(this).hide();
            }
        });
    } else if (idPerfil == 9 || idPerfil == 10) {
        $('#idPerfil option').each(function() {
            var valor = $(this).val();
            if (valor != 9 && valor != 10 && valor != '') {
                checkOrganizacion = 1;//!segun felipe
                $(this).hide();
            }
        });
    }

    // Comprueba si el Check está ON u OFF
    var checkboxNC = document.getElementById('more_infos');
    checkboxNC.addEventListener('change', function() {
        if (this.checked) {
            checkOrganizacion = 1;
            $("#conditional_parts").show();
        } else {
            checkOrganizacion = 0;
            $("#conditional_parts").hide();
        }
    });
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

//todo: Borrar/activar perona (estado)
 $(document).on("click", ".btnBorrar, .btnHabilitar", function(e){
    e.preventDefault(); //evita el comportambiento normal del submit, es decir, recarga total de la página
    fila = $(this).closest('tr');           
    user_id = fila.find('td:eq(0)').text(); // capturo el ID		            
    dni = fila.find('td:eq(1)').text();
    nombre = fila.find('td:eq(2)').text();
    direccion = fila.find('td:eq(3)').text();
    telefono = fila.find('td:eq(4)').text();
    mail = fila.find('td:eq(5)').text();
    idPerfil = fila.find('td:eq(6)').text();
    estado = fila.find('td:eq(7)').text();
    checkHabilitado= fila.find('td:eq(8)').text();
    usuario = fila.find('td:eq(9)').text();
    contrasena = fila.find('td:eq(10)').text();
    idOrganizacion = fila.find('td:eq(11)').text();
    let action = estado == '1' ? 'borrar_persona' : 'habilitar_persona';
    let confirmMessage = estado == '1' ? "¿Está seguro de Desactivar el registro de "+nombre+"?" : "¿Quieres activar al usuario "+nombre+"?"  ;
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: "btn btn-success",
            cancelButton: "btn btn-danger"
        },
        buttonsStyling: true
    });

    swalWithBootstrapButtons.fire({
        title: confirmMessage,
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Sí, continuar",
        cancelButtonText: "No, cancelar",
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "../controller/controllerP.php?op=borrar_persona",
                type: "POST",
                datatype: "json",
                data: { 
                    user_id: user_id,
                    dni: dni,
                    nombre: nombre,
                    direccion: direccion,
                    telefono: telefono,
                    mail: mail,
                    idPerfil: idPerfil,
                    estado: estado,
                    checkHabilitado: checkHabilitado,
                    usuario: usuario,
                    contrasena: contrasena,
                    idOrganizacion: idOrganizacion
                },
                success: function(data) {
                    table.ajax.reload(null, false);
                },
                error: function(xhr, status, error) {
                    console.error("Error en la operación:", error);
                    alert(error);
                }
            }).done(function(response){ 
                respuesta = JSON.parse(response);
                // alert (response);
                if(respuesta.length == 1 && respuesta[0].error == 0){
                    Swal.fire({
                        icon: "success",
                        title: respuesta[0].mensaje,
                        width: 400,
                        showConfirmButton: false,
                        timer: 3000
                    });
                } else if(respuesta.length == 1 && respuesta[0].error == 99){
                    Swal.fire({
                        icon: "error",
                        title: respuesta[0].mensaje,
                        width: 400,
                        showConfirmButton: false,
                        timer: 3000
                    });
                }
            });
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            swalWithBootstrapButtons.fire({
                title: "Cancelado",
                text: "La acción ha sido cancelada.",
                icon: "error"
            });
        }
    });
});

 //! deshabilitar/habilitar 
 $(document).on("click", ".btnAutorizar, .btnDeshabilitar", function(e){
    e.preventDefault(); // Evita el comportamiento normal del submit, es decir, recarga total de la página
    fila = $(this).closest('tr');
    user_id = fila.find('td:eq(0)').text(); // Capturo el ID
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
    let action = checkHabilitado == '1' ? 'borrar_persona' : 'habilitar_persona';
    let confirmMessage = checkHabilitado == '1' ? "¿Está seguro de Deshabilitar al usuario "+nombre+"?" : "¿Quieres habilitar al usuario "+nombre+"?";

    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: "btn btn-success",
            cancelButton: "btn btn-danger"
        },
        buttonsStyling: true
    });

    swalWithBootstrapButtons.fire({
        title: confirmMessage,
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Sí, continuar",
        cancelButtonText: "No, cancelar",
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "../controller/controllerP.php?op=Habilitar_persona",
                type: "POST",
                datatype: "json",
                data: { 
                    user_id: user_id,
                    dni: dni,
                    nombre: nombre,
                    direccion: direccion,
                    telefono: telefono,
                    mail: mail,
                    idPerfil: idPerfil,
                    estado: estado,
                    checkHabilitado: checkHabilitado,
                    usuario: usuario,
                    contrasena: contrasena,
                    idOrganizacion: idOrganizacion
                },
                success: function(data) {
                    table.ajax.reload(null, false);
                },
                error: function(xhr, status, error) {
                    console.error("Error en la operación:", error);
                    alert(error);
                }
            }).done(function(response){ 
                respuesta = JSON.parse(response);
                if(respuesta.length == 1 && respuesta[0].error == 0){
                    Swal.fire({
                        icon: "success",
                        title: respuesta[0].mensaje,
                        width: 400,
                        showConfirmButton: false,
                        timer: 3000
                    });
                } else if(respuesta.length == 1 && respuesta[0].error == 99){
                    Swal.fire({
                        icon: "error",
                        title: respuesta[0].mensaje,
                        width: 400,
                        showConfirmButton: false,
                        timer: 3000
                    });
                }
            });
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            swalWithBootstrapButtons.fire({
                title: "Cancelado",
                text: "La acción ha sido cancelada.",
                icon: "error"
            });
        }
    });
});




// Habilitar General 
$(document).on("click", ".btnHabGeneral", function(e){
    e.preventDefault(); // Evita el comportamiento normal del submit, es decir, recarga total de la página
    let fila = $(this).closest('tr');           
    let user_id = fila.find('td:eq(0)').text();
    let dni = fila.find('td:eq(1)').text();
    let checkHabilitado = $(this).closest('tr').find('td:eq(8)').text() ;
    let confirmMessage = "¿Quieres Habilitar todos los registros?";
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: "btn btn-success",
            cancelButton: "btn btn-danger"
        },
        buttonsStyling: true
    });

    swalWithBootstrapButtons.fire({
        title: confirmMessage,
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Sí, continuar",
        cancelButtonText: "No, cancelar",
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {            
        $.ajax({
            url: "../controller/controllerP.php?op=habGeneral",
            type: "POST",
            dataType: "json",
            data: { user_id: user_id, checkHabilitado:checkHabilitado, dni: dni },
            success: function(data) {
                table.ajax.reload(null, false);
            },
            error:function(){
                alert("error");
            }
        }).done(function(response){ 
            //console.log(response);
            respuesta =(response);
            if(respuesta.length==1 && respuesta[0].bandera==2){
                
                Swal.fire({
                    icon: "success",
                    title: respuesta[0].mensaje,
                    width: 400,
                    showConfirmButton: false,
                    timer: 2000
                });
            

            }else  if(respuesta.length==1 && respuesta[0].error==0){
                
                Swal.fire({
                    icon: "success",
                    title: respuesta[0].mensaje,
                    width: 300,
                    showConfirmButton: false,
                    timer: 2000
                });
            }else if(respuesta.length==1 && respuesta[0].error==99){
                Swal.fire({
                    icon: "error",
                    title: respuesta[0].mensaje,
                    width: 300,
                    showConfirmButton: false,
                    timer: 2000
                });
            }
            
        });//fin done
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            swalWithBootstrapButtons.fire({
                title: "Cancelado",
                text: "La acción ha sido cancelada.",
                icon: "error"
            });
        }
    });
});

// Deshabilitar General 
$(document).on("click", ".btnDesHabGeneral", function(e){
    e.preventDefault(); // Evita el comportamiento normal del submit, es decir, recarga total de la página
    let fila = $(this).closest('tr');           
    let user_id = fila.find('td:eq(0)').text();
    let dni = fila.find('td:eq(1)').text();
    let checkHabilitado = $(this).closest('tr').find('td:eq(8)').text() ;
    let confirmMessage = "¿Quieres deshabilitar todos los registros?";
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: "btn btn-success",
            cancelButton: "btn btn-danger"
        },
        buttonsStyling: true
    });

    swalWithBootstrapButtons.fire({
        title: confirmMessage,
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Sí, continuar",
        cancelButtonText: "No, cancelar",
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {             
        $.ajax({
            url: "../controller/controllerP.php?op=DesHabGeneral",
            type: "POST",
            dataType: "json",
            data: { user_id: user_id, checkHabilitado:checkHabilitado, dni: dni },
            success: function(data) {
                table.ajax.reload(null, false);
            }/* ,
            error:function(){
                alert("error")
            } */,
            error: function(xhr, status, error) {
                console.error("Error en la operación:", error);
            }
        }).done(function(response){ 
            //console.log(response);
            respuesta =(response);
            if(respuesta.length==1 && respuesta[0].error==0){
                
                Swal.fire({
                    icon: "success",
                    title: "DESHABILITADO GENERAL DE PERSONAS",
                    width: 300,
                    showConfirmButton: false,
                    timer: 2000
                });

            }else if(respuesta.length==1 && respuesta[0].error==99){
                Swal.fire({
                    icon: "error",
                    title: "FALLO AL DESHABILITAR PERSONAS",
                    width: 300,
                    showConfirmButton: false,
                    timer: 2000
                });
            }
            
        });//fin done	    	    
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            swalWithBootstrapButtons.fire({
                title: "Cancelado",
                text: "La acción ha sido cancelada.",
                icon: "error"
            });
        }
    });
});

 function cerrarModal() {
    $('#fondo-modal').hide();
  }

  function abrirModal() {
    $('#modalCRUD').show();
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

// Agregar el prefijo "+569" al hacer clic en el campo
document.getElementById('telefono').addEventListener('focus', function() {
    if (this.value === '') {
        this.value = '+569';
}
});
