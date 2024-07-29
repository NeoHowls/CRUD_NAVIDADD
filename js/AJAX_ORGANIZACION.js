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

        {"data": "id"},
        {"data": "nombre"},
        {"data": "direccion"},
        {"data": "organizacion"},
        {"data": "fechaIngreso"},
        {"data": "checkVigente"},
        {"data": "numProvidencia"},
        {"data": "habilitado"},
        {"data": "estado"},
        {"data": "aniosVigente"},
        {"data": "vigente"},
        {
            "data": null,
            "render": function(data, type, row) {

                $(document).ready(function () {
                    $('[data-toggle="tooltip"]').tooltip({
                        delay: { show: 0, hide: 0 },
                        placement: 'top'
                });    
                });
                
                // data es null ya que no especificamos una propiedad específica de data para esta columna
                let estadoButton = '';
                if (row.estado == '1') {
                    estadoButton = '<button type="button" class="btn btn-danger text-light btnBorrar me-2" data-toggle="tooltip" data-placement="top" title="Desactivar Organizacion"><i class="bi bi-person-dash-fill icon-100"></i> </button>';
                } else {
                    estadoButton = '<button type="button" class="btn btn-success text-light btnHabilitar me-2" data-toggle="tooltip" data-placement="top" title="Activar Organizacion"><i class="bi bi-person-plus-fill icon-100"></i> </button>';
                }
                let checkHabilitadoButton = '';
                if (row.checkHabilitado == '1') {
                    checkHabilitadoButton = '<button type="button" class="btn btn-danger text-light btnDeshabilitar me-2" data-toggle="tooltip" data-placement="top" title="Deshabilitar Web Organizacion"><i class="bi bi-x-square icon-100"></i> </button>';
                } else {
                    checkHabilitadoButton = '<button type="button" class="btn btn-success text-light btnAutorizar me-2" data-toggle="tooltip" data-placement="top" title="Habilitar Web Organizacion"><i class="bi bi-check-square icon-100"></i> </button>';
                }
        
                // Botón de editar con modal
                let editarButton = '';
                    if (row.checkHabilitado == '1') {
                        editarButton = '<button type="button" class="btn btn-primary text-light btnEditar me-2"  data-toggle="tooltip" data-placement="top" title="Editar registro" ><i class="bi bi-pencil-square icon-100"></i></button>';
                    } else {
                        editarButton = '<button type="button" class="btn btn-secondary text-light btnEditar me-2"   data-toggle="tooltip" data-placement="top" title="No se puede editar"  disabled><i class="bi bi-pencil-square icon-100"></i></button>';
                    }


                    let id1 = data["id"];
                    let nombre1=data["nombre"];
                    let tipo1=data["organizacion"];
                    /* pdf ="<button type='button' class='btn btn-warning me-2 btnAnular text-light' data-toggle='tooltip' data-placement='top' title='Imprimir informe'"+
                    "onclick=\"crearpdf('"+id1+"','"+nombre1+"')\">"+
                    "<i class='bi bi-filetype-pdf icon-100'></i>"+
                    "</button>"; */
                    pdf2 = "<button type='button' class='btn btn-warning me-2 btnPdf text-light btnPdf' data-id='" + id1 + "' data-nombre='" + nombre1 + "' data-organizacion='" + tipo1 + "' data-toggle='tooltip' data-placement='top' title='Imprimir informe detallado.'>" +
                        "<i class='bi bi-filetype-pdf icon-100'></i>" +
                    "</button>";

                    pdf3 = "<button type='button' class='btn btn-warning me-2 btnPdf2 text-light btnPdf2' data-id='" + id1 + "' data-nombre='" + nombre1 + "' data-organizacion='" + tipo1 + "' data-toggle='tooltip' data-placement='top' title='Imprimir informe para firmar.'>" +
                        "<i class='bi bi-filetype-pdf icon-100'></i>" +
                    "</button>";

                    ActualizarVigencia = '<button type="button" class="btn btn-info text-light btnActualizarVigencia me-2" data-toggle="tooltip" data-placement="top" title="actualizar Vigencia"><i class="bi bi-clock-history icon-100"></i> </button>';
                    
                    //todo: botones desactivados.
                    estadoButtonDesactivado = '<button type="button" class="btn btn-secondary text-light btnEditar me-2"   data-toggle="tooltip" data-placement="top" title="No se puede editar"  disabled><i class="bi bi-person-dash-fill icon-100"></i></button>';
                    checkHabilitadoButtonDesactivado = '<button type="button" class="btn btn-secondary text-light btnEditar me-2"   data-toggle="tooltip" data-placement="top" title="No se puede editar"  disabled><i class="bi bi-x-square icon-100"></i></button>';
                    editarButtonDesactivado = '<button type="button" class="btn btn-secondary text-light btnEditar me-2"   data-toggle="tooltip" data-placement="top" title="No se puede editar"  disabled><i class="bi bi-pencil-square icon-100"></i></button>';
                    ActualizarVigenciaDesactivado = '<button type="button" class="btn btn-secondary text-light btnActualizarVigencia me-2" data-toggle="tooltip" data-placement="top" title="actualizar Vigencia"  disabled><i class="bi bi-clock-history icon-100"></i> </button>';

                // Combinamos los botones en una sola columna
                
                if(row.checkVigente== '1'){
                return estadoButton + checkHabilitadoButton + editarButton + pdf2 + pdf3 + ActualizarVigenciaDesactivado;
                }else{
                    return estadoButtonDesactivado + checkHabilitadoButtonDesactivado + editarButton+ pdf2 + pdf3 + ActualizarVigencia;
                }
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
                        columns: ':visible:not(:last-child)'
                    }
                    
                },
                {    
                    extend: 'colvis',
                    text: 'COLUMNAS',
                    columns: [12,13,14,18,21]
                }
            ] 
        }
    }
} );


//todo: verificacion de mensaje error al seleccionar input

$('#nombre').on('change click', function() {
    $('#m_nombre').text('');
});
$('#direccion').on('change click', function() {
    $('#m_direccion').text('');
});
$('#tipo').on('change click', function() {
    $('#m_tipo').text('');
});
$('#numProvidencia').on('change click', function() {
    $('#m_numProvidencia').text('');
});

function limpiarMensaje(){
    $('#m_nombre').text('');
    $('#m_direccion').text('');
    $('#m_tipo').text('');
    $('#m_numProvidencia').text('');
}

var fila; //captura la fila, para editar o eliminar
//submit para el Alta y Actualización
$('#formUsuarios').submit(function(e){                         
    e.preventDefault(); //evita el comportambiento normal del submit, es decir, recarga total de la página
    //CAPTURA EL DATO DEL FORMULARIO
    nombre = $.trim($('#nombre').val());
    direccion = $.trim($('#direccion').val());
    tipo = $.trim($('#tipo').val());
    // fechaIngreso = $.trim($('#fechaIngreso').val());
    // aniosVigente = $.trim($('#aniosVigente').val());
    // checkVigente = $.trim($('#checkVigente').val());
    numProvidencia = $.trim($('#numProvidencia').val());   
    // checkHabilitado = $.trim($('#checkHabilitado').val());
    // estado = $.trim($('#estado').val());
   
    //alert(nombre+" "+direccion+" "+numProvidencia+" "+tipo+" "+aniosVigente);
    //console.log(opcion)
    // alert (user_id);
                             
    //EJECUTA EL AJAX
    $.ajax({
        //Laa URL es similar al AJAX principaal pero en el op= capturaa la opcion del boton para ejecutar la consulta correcta
          url: "../controller/controllerO.php?op="+opcion,
          type: "POST",
          datatype:"json", 
          //La prueba al solo la tabla ETNIA CAPTURA SOLO 2 VALORES, EL ID Y LA ETNIA, el ID es en caso que se quiera editar   
          data:  {
                nombre:nombre, 
                direccion:direccion, 
                tipo:tipo, 
                user_id:user_id,
                numProvidencia:numProvidencia
            },    
          //Si todo funiona recarga el AJAX
          success: function(data) {
            table.ajax.reload(null, false);
           }
        }).done(function(response){ 
            //console.log(response);
            respuesta = JSON.parse(response);
            //console.log(respuesta);
            for(i=0;i<respuesta.length;i++){
            if(respuesta[i].error==1)
                {$('#m_nombre').html(respuesta[i].mensaje);}
            if(respuesta[i].error==2)
                {$('#m_direccion').html(respuesta[i].mensaje);}
            if(respuesta[i].error==3)
                {$('#m_tipo').html(respuesta[i].mensaje);}
            /* if(respuesta[i].error==4)
                {$('#m_aniosVigentes').html(respuesta[i].mensaje);} */
            if(respuesta[i].error==5)
                {$('#m_numProvidencia').html(respuesta[i].mensaje);}
            }
            // alert(respuesta.length);
            if(respuesta.length==1 && respuesta[0].error==0){
                $('#modalCRUD').modal('hide');
                Swal.fire({
                    icon: "success",
                    title: respuesta[0].mensaje,
                    width: 400,
                    showConfirmButton: false,
                    timer: 3000
                });
            }else if(respuesta.length==1 && respuesta[0].error==99){
                Swal.fire({
                    icon: "error",
                    title: respuesta[0].mensaje,
                    width: 400,
                    showConfirmButton: false,
                    timer: 3000
                });
            }
            
        });//fin done			
        
        //EL MODAL SE DESTRUYE/ESCONDE NUEVAMENTE COMO SE LIMPIA LOS DATOS        
    
        											     			
});
        
//todo Manejar el cambio en el campo tipo (si es necesario para tu lógica)
$("#tipo").on("change", function() {
    if ($(this).val() === '4') {
        $("#numProvidenciaGroup").show();
        $("#aniosVigente").val("");
        $('#m_numProvidencia').text('');
        $('#numProvidencia').val('');
        $("#aniosVigente").children('option[value="4"]').hide();
        // $("#aniosVigente").val('1').prop('disabled', false);
    } else {
        $("#numProvidenciaGroup").hide();
        $("#aniosVigente").val("");
        $('#m_numProvidencia').text('');
        $('#numProvidencia').val('');
        $("#aniosVigente").children('option[value="4"]').show();
        // $("#aniosVigente").prop('disabled', false);
    }
});

//todo: ANAÑIR--------------------------------------------------------------------------
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
    $("#aniosVigente").children('option[value="4"]').show();

    limpiarMensaje();

    // Reiniciar el estado de los campos relacionados con el tipo de organización
    document.getElementById('numProvidenciaGroup').style.display = 'none';
    // document.getElementById('aniosVigente').disabled = false;

    // Mostrar el modal y configurar estilos y título
    $(".modal-header").css("background-color", "#17a2b8");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Añadir Organización");

    $('#modalCRUD').modal('show');
});





//! Editar-----------------------------------------------------------------       
$(document).on("click", ".btnEditar", function() {	        
    opcion = "edit_organizacion";//editar

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

    document.getElementById('numProvidenciaGroup').style.display = 'none';
    // document.getElementById('aniosVigente').disabled = false;

     

    // Resto de tu código para obtener y mostrar los datos en el modal de edición
    fila = $(this).closest("tr");	        
    user_id = parseInt(fila.find('td:eq(0)').text()); //capturo el ID		            
    nombre = fila.find('td:eq(1)').text();
    direccion = fila.find('td:eq(2)').text();
    tipo = fila.find('td:eq(3)').text();
    // fechaIngreso = fila.find('td:eq(4)').text();
    // checkVigente= fila.find('td:eq(5)').text();
    numProvidencia= fila.find('td:eq(6)').text();
    // checkHabilitado=fila.find('td:eq(7)').text();
    // estado= fila.find('td:eq(8)').text();
    // aniosVigente= fila.find('td:eq(9)').text();
    
    $("#nombre").val(nombre);
    $("#direccion").val(direccion);
    $("#tipo").val(tipo);
    // $("#fechaIngreso").val(fechaIngreso);
    // $("#checkVigente").val(checkVigente);
    $("#numProvidencia").val(numProvidencia);
    // $("#checkHabilitado").val(checkHabilitado);
    // $("#estado").val(estado);
    // $("#aniosVigente").val(aniosVigente);
    
    $(".modal-header").css("background-color", "#17a2b8");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Editar Organizacion");		
    $('#modalCRUD').modal('show');	

    // Obtener el valor actual del tipo seleccionado
    var tipoActual = $("#tipo").val();

    // Mostrar u ocultar campos según el tipo seleccionado al inicio
    if (tipoActual === '4') {
        $("#numProvidenciaGroup").show();
        $("#aniosVigente").val('1').prop('disabled', true);
    } else {
        $("#numProvidenciaGroup").hide();
        $("#aniosVigente").prop('disabled', false);
    }

   // Lógica para manejar cambios en el campo tipo
    $("#tipo").on("change", function() {
        var nuevoTipo = $(this).val();
        if (nuevoTipo === '4') {
            $("#numProvidenciaGroup").show();
            $("#aniosVigente").val('1').prop('disabled', true);
        } else {
            $("#numProvidenciaGroup").hide();
            $("#aniosVigente").prop('disabled', false);
        }
    });


    //! poner solo los perfiles seleccionables al editar
    //! si es representante o providencia || administrador o dideco

    $('#tipo option').show(); // Primero muestra todas las opciones
    
    if (tipo == 1 || tipo == 2 || tipo == 3) {
        $('#tipo option').each(function() {
            var valor = $(this).val();
            if (valor != 1 && valor != 2 && valor != 3 && valor != '') {
                
                $(this).hide();
            }
        });
    } else if (tipo == 4) {
        $('#tipo option').each(function() {
            var valor = $(this).val();
            if (valor != 4 && valor != '') {
                
                $(this).hide();
            }
        });
    }


});



//todo: funcion para que los formularios se puedan enviar con el enter
window.addEventListener("keydown", (e) => {
    if (e.keyCode === 13) {
        e.preventDefault(); // Previene el comportamiento por defecto del Enter
        $('#btnGuardar').click(); // Dispara el evento de clic en el botón "Iniciar Sesión"
    }
  });

//todo: desacticar/activar  POR ORGANIZACION Y PERSONAL ASOCIADO
$(document).on("click", ".btnBorrar, .btnHabilitar", function(e){
    e.preventDefault(); //evita el comportambiento normal del submit, es decir, recarga total de la página
    fila = $(this).closest('tr');           
    user_id = parseInt(fila.find('td:eq(0)').text()); //capturo el ID		            
    nombre = fila.find('td:eq(1)').text();
    direccion = fila.find('td:eq(2)').text();
    tipo = fila.find('td:eq(3)').text();
    fechaIngreso = fila.find('td:eq(4)').text();
    checkVigente= fila.find('td:eq(5)').text();
    numProvidencia= fila.find('td:eq(6)').text();
    checkHabilitado=fila.find('td:eq(7)').text();
    estado= fila.find('td:eq(8)').text();
    let action = estado == '1' ? 'borrar_persona' : 'habilitar_persona';
    let confirmMessage = estado == '1' ? "¿Está seguro de Desactivar el registro de "+nombre+"?" : "¿Quieres activar el registro de  "+nombre+"?"  ;
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
          url: "../controller/controllerO.php?op=borrar_organizacion",
          type: "POST",
          datatype:"json",    
            data: { user_id:user_id,nombre:nombre, direccion:direccion, tipo:tipo, fechaIngreso:fechaIngreso, checkVigente:checkVigente, numProvidencia:numProvidencia, checkHabilitado:checkHabilitado, estado:estado},
          success: function(data) {
            table.ajax.reload(null, false);
           },
           error: function(xhr, status, error) {
            console.error("Error en la operación:", error);
        }
        }).done(function(response){ 
            //console.log(response);
            respuesta =JSON.parse(response);
            //alert(respuesta.length);
            if(respuesta.length==1 && respuesta[0].error==0){
                
                Swal.fire({
                    icon: "success",
                    title: respuesta[0].mensaje,
                    width: 400,
                    showConfirmButton: false,
                    timer: 3000
                });
            }else if(respuesta.length==1 && respuesta[0].error==99){
                Swal.fire({
                    icon: "error",
                    title: respuesta[0].mensaje,
                    width: 400,
                    showConfirmButton: false,
                    timer: 3000
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

  //todo: deshabilitar/habiliar WEB POR ORGANIZACION Y PERSONAL ASOCIADO
$(document).on("click", ".btnDeshabilitar, .btnAutorizar", function(e){
    e.preventDefault(); //evita el comportambiento normal del submit, es decir, recarga total de la página
    fila = $(this).closest('tr');           
    user_id = parseInt(fila.find('td:eq(0)').text()); //capturo el ID		            
    nombre = fila.find('td:eq(1)').text();
    direccion = fila.find('td:eq(2)').text();
    tipo = fila.find('td:eq(3)').text();
    fechaIngreso = fila.find('td:eq(4)').text();
    checkVigente= fila.find('td:eq(5)').text();
    numProvidencia= fila.find('td:eq(6)').text();
    checkHabilitado=fila.find('td:eq(7)').text();
    estado= fila.find('td:eq(8)').text();
    // aniosVigente= fila.find('td:eq(9)').text();
    let action = checkHabilitado == '1' ? 'borrar_persona' : 'habilitar_persona';
    let confirmMessage =  checkHabilitado== '1' ? "¿Está seguro que desesa deshabilitar el registro de la organizacion "+nombre+"?" : "¿Quieres habilitar el registro de la organizacion "+nombre+"?"  ;
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
          url: "../controller/controllerO.php?op=Habilitar_organizacion",
          type: "POST",
          datatype:"json",    
            data: { user_id:user_id,nombre:nombre, direccion:direccion, tipo:tipo, fechaIngreso:fechaIngreso, checkVigente:checkVigente, numProvidencia:numProvidencia, checkHabilitado:checkHabilitado, estado:estado},
          success: function(data) {
            table.ajax.reload(null, false);
           },
           error: function(xhr, status, error) {
            console.error("Error en la operación:", error);
        }
        }).done(function(response){ 
            //console.log(response);
            respuesta =JSON.parse(response);
            //alert(respuesta.length);
            if(respuesta.length==1 && respuesta[0].error==0){
                
                Swal.fire({
                    icon: "success",
                    title: respuesta[0].mensaje,
                    width: 400,
                    showConfirmButton: false,
                    timer: 3000
                });
            }else if(respuesta.length==1 && respuesta[0].error==99){
                Swal.fire({
                    icon: "error",
                    title: respuesta[0].mensaje,
                    width: 400,
                    showConfirmButton: false,
                    timer: 3000
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

 //todo: Deshabilitar General--------------------------------------------------- 
$(document).on("click", ".btnDesHabGeneral", function(e){
    e.preventDefault(); // Evita el comportamiento normal del submit, es decir, recarga total de la página
    let fila = $(this).closest('tr');           
    let user_id = fila.find('td:eq(0)').text();
    nombre = $(this).closest('tr').find('td:eq(1)').text() ;
    let checkHabilitado = 1;
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
            url: "../controller/controllerO.php?op=DesHabGeneralO",
            type: "POST",
            dataType: "json",
            data: {  user_id: user_id, checkHabilitado:checkHabilitado, nombre:nombre },
            success: function(data) {
                table.ajax.reload(null, false);
            },
            error: function(xhr, status, error) {
                console.error("Error en la operación:", error);
            }
        }).done(function(response){ 
            // console.log(response);
            respuesta =response;
            // alert(respuesta.length);
            if(respuesta.length==1 && respuesta[0].error==0){
                
                Swal.fire({
                    icon: "success",
                    title: respuesta[0].mensaje,
                    width: 400,
                    showConfirmButton: false,
                    timer: 3000
                });
            }else if(respuesta.length==1 && respuesta[0].error==99){
                Swal.fire({
                    icon: "error",
                    title: respuesta[0].mensaje,
                    width: 400,
                    showConfirmButton: false,
                    timer: 3000
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

//todo: Habilitar General------------------------------------------------------ 
$(document).on("click", ".btnHabGeneral", function(e){
    e.preventDefault(); // Evita el comportamiento normal del submit, es decir, recarga total de la página
    let fila = $(this).closest('tr');           
    let user_id = fila.find('td:eq(0)').text();
    nombre = $(this).closest('tr').find('td:eq(1)').text() ;
    let checkHabilitado = 0;
    let confirmMessage = "¿Quieres habilitar todos los registros?";
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
        }).done(function(response){ 
            // console.log(response);
            respuesta =response;
            // alert(respuesta.length);
            if(respuesta.length==1 && respuesta[0].error==0){
                
                Swal.fire({
                    icon: "success",
                    title: respuesta[0].mensaje,
                    width: 400,
                    showConfirmButton: false,
                    timer: 3000
                });
            }else if(respuesta.length==1 && respuesta[0].error==99){
                Swal.fire({
                    icon: "error",
                    title: respuesta[0].mensaje,
                    width: 400,
                    showConfirmButton: false,
                    timer: 3000
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


$('#btnInformeDetallado').on('click', function () {
    periodo=$('#select_periodo').val();
    crearpdf(id1, nombre1, periodo,tipo1);
});


$('#btnInformeRutFirma').on('click', function () {
    periodo=$('#select_periodo2').val();
    crearpdf2(id1, nombre1, periodo,tipo1);
});
//! Actualizar vigencia-------------------------------------------
$(document).on('click', '.btnActualizarVigencia', function (e) {
    e.preventDefault(); // Evita el comportamiento normal del submit, es decir, recarga total de la página
    let fila = $(this).closest('tr');
    user_id = parseInt(fila.find('td:eq(0)').text()); //capturo el ID		            
    nombre = fila.find('td:eq(1)').text();
    direccion = fila.find('td:eq(2)').text();
    tipo = fila.find('td:eq(3)').text();
    fechaIngreso = fila.find('td:eq(4)').text();
    checkVigente= fila.find('td:eq(5)').text();
    numProvidencia= fila.find('td:eq(6)').text();
    checkHabilitado=fila.find('td:eq(7)').text();
    estado= fila.find('td:eq(8)').text();
   
    let confirmMessage = "¿Quieres Actualizar la vigencia de: "+nombre+"?";
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
            url: "../controller/controllerO.php?op=actualizarVigencia",
            type: "POST",
            dataType: "json",
            data: { user_id:user_id,nombre:nombre, direccion:direccion, tipo:tipo, fechaIngreso:fechaIngreso, checkVigente:checkVigente, numProvidencia:numProvidencia, checkHabilitado:checkHabilitado, estado:estado},
            success: function(data) {
                table.ajax.reload(null, false);
            },
            error: function(xhr, status, error) {
                console.error("Error en la operación:", error);
            }
        }).done(function(response){ 
            // console.log(response);
            respuesta =response;
             //alert(respuesta.length);
            if(respuesta.length==1 && respuesta[0].error==0){
                
                Swal.fire({
                    icon: "success",
                    title: respuesta[0].mensaje,
                    width: 400,
                    showConfirmButton: false,
                    timer: 3000
                });
            }else if(respuesta.length==1 && respuesta[0].error==99){
                Swal.fire({
                    icon: "error",
                    title: respuesta[0].mensaje,
                    width: 400,
                    showConfirmButton: false,
                    timer: 3000
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

//! DESACTIVAR VIGENCIA ORG Y PERSONA

$(document).on("click", ".btnDeshabilitarTime", function(e){
    e.preventDefault(); // Evita el comportamiento normal del submit, es decir, recarga total de la página
    /* let fila = $(this).closest('tr');           
    let user_id = fila.find('td:eq(0)').text();
    nombre = $(this).closest('tr').find('td:eq(1)').text() ;
    let checkHabilitado = 0; */
    let confirmMessage = "¿Quieres desactivar todas las Organizaciones vencidas?";
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
            url: "../controller/controllerO.php?op=desactivarVigencia",
            type: "POST",
            dataType: "json",
            
            success: function(data) {
                table.ajax.reload(null, false);
            },
            error: function(xhr, status, error) {
                console.error("Error en la operación:", error);
            }
        }).done(function(response){ 
            // console.log(response);
            respuesta =response;
            
            // alert(respuesta.length);
            if(respuesta.length==1 && respuesta[0].error==0){
                
                Swal.fire({
                    icon: "success",
                    title: respuesta[0].mensaje,
                    width: 400,
                    showConfirmButton: false,
                    timer: 3000
                });
            }else if(respuesta.length==1 && respuesta[0].error==99){
                Swal.fire({
                    icon: "error",
                    title: respuesta[0].mensaje,
                    width: 400,
                    showConfirmButton: false,
                    timer: 3000
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

//!PDF DETALLADO
$(document).on('click', '.btnPdf', function () {
    // Capturar los datos del botón
    id1 = $(this).data("id");
    nombre1 = $(this).data("nombre");
    tipo1=$(this).data("organizacion");

    // Mostrar el modal
    $(".modal-header").css("background-color", "#17a2b8");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Informes por año: "+tipo1+"-"+nombre1);		
    $('#imprimirModal').modal('show');
});


//!PDF CON FIRMA Y RUT PARA RETIRO
 $(document).on('click', '.btnPdf2', function () {
        // Capturar los datos del botón
        id1 = $(this).data("id");
        nombre1 = $(this).data("nombre");
        tipo1=$(this).data("organizacion");

        // Mostrar el modal
        $(".modal-header").css("background-color", "#17a2b8");
        $(".modal-header").css("color", "white");
        $(".modal-title").text("Informes por año: "+tipo1+"-"+nombre1);		
        $('#imprimirModal2').modal('show');
    });


function crearpdf(id1, nombre1, periodo, tipo) {
    window.open("../view/reportePdfOrganizacion.php?idOrg=" + id1 + "&nombre1=" + nombre1 + "&periodo=" + periodo+ "&organizacion=" + tipo);
}

function crearpdf2(id1, nombre1, periodo, tipo) {
    window.open("../view/reportePdfOrganizacionFirma.php?idOrg=" + id1 + "&nombre1=" + nombre1 + "&periodo=" + periodo+ "&organizacion=" + tipo);
}



//table.draw();