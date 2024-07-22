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
                        editarButton = '<button type="button" class="btn btn-primary text-light btnEditar me-2" data-bs-toggle="modal" data-bs-target="#myModal" data-toggle="tooltip" data-placement="top" title="Editar registro" ><i class="bi bi-pencil-square icon-100"></i></button>';
                    } else {
                        editarButton = '<button type="button" class="btn btn-secondary text-light btnEditar me-2" data-bs-toggle="modal" data-bs-target="#myModal"  data-toggle="tooltip" data-placement="top" title="No se puede editar"  disabled><i class="bi bi-pencil-square icon-100"></i></button>';
                    }


                    let id1 = data["id"];
                    let nombre1=data["nombre"];
                    /* pdf ="<button type='button' class='btn btn-warning me-2 btnAnular text-light' data-toggle='tooltip' data-placement='top' title='Imprimir informe'"+
                    "onclick=\"crearpdf('"+id1+"','"+nombre1+"')\">"+
                    "<i class='bi bi-filetype-pdf icon-100'></i>"+
                    "</button>"; */
                    pdf2 = "<button type='button' class='btn btn-warning me-2 btnPdf text-light btnPdf' data-id='" + id1 + "' data-nombre='" + nombre1 + "' data-toggle='tooltip' data-placement='top' title='Imprimir informe detallado.'>" +
                        "<i class='bi bi-filetype-pdf icon-100'></i>" +
                    "</button>";

                    pdf3 = "<button type='button' class='btn btn-warning me-2 btnPdf2 text-light btnPdf2' data-id='" + id1 + "' data-nombre='" + nombre1 + "' data-toggle='tooltip' data-placement='top' title='Imprimir informe para firmar.'>" +
                        "<i class='bi bi-filetype-pdf icon-100'></i>" +
                    "</button>";

                // Combinamos los botones en una sola columna
                return estadoButton + checkHabilitadoButton + editarButton +pdf2+pdf3;
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
    document.getElementById('aniosVigente').disabled = false;

     

    // Resto de tu código para obtener y mostrar los datos en el modal de edición
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
});



//funcion para que los formularios se puedan enviar con el enter
window.addEventListener("keydown", (e) => {
    if (e.keyCode === 13) {
        e.preventDefault(); // Previene el comportamiento por defecto del Enter
        $('#btnGuardar').click(); // Dispara el evento de clic en el botón "Iniciar Sesión"
    }
  });

//Borrar/activar estado
$(document).on("click", ".btnBorrar, .btnHabilitar", function(e){
    e.preventDefault(); //evita el comportambiento normal del submit, es decir, recarga total de la página
    fila = $(this).closest('tr');           
    user_id = $(this).closest('tr').find('td:eq(0)').text() ;
    nombre = $(this).closest('tr').find('td:eq(1)').text() ;
    estado = $(this).closest('tr').find('td:eq(8)').text() ;
    let action = estado == '1' ? 'borrar_persona' : 'habilitar_persona';
    let confirmMessage = estado == '1' ? "¿Está seguro de Desactivar el registro de "+nombre+"?" : "¿Quieres activar el registro de  "+nombre+"?"  ;
    let respuesta = confirm(confirmMessage);
    console.log("funciona")
    if (respuesta) {            
        $.ajax({
          url: "../controller/controllerO.php?op=borrar_organizacion",
          type: "POST",
          datatype:"json",    
            data: { user_id:user_id, estado:estado,nombre:nombre},
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
    nombre = $(this).closest('tr').find('td:eq(1)').text() ;
    checkHabilitado = $(this).closest('tr').find('td:eq(7)').text() ;
    let action = checkHabilitado == '1' ? 'borrar_persona' : 'habilitar_persona';
    let confirmMessage =  checkHabilitado== '1' ? "¿Está seguro que desesa deshabilitar el registro de la organizacion "+nombre+"?" : "¿Quieres habilitar el registro de la organizacion "+nombre+"?"  ;
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

function mostrarBoton() {
    const selectedYear = document.getElementById('select_periodo').value;
    const botonInforme = document.getElementById('botonInforme');
    
    botonInforme.innerHTML = `
        <button type="button" class="btn btn-warning me-2 btnAnular text-light" id="btnInforme${selectedYear}" onclick="imprimirInforme(${selectedYear})">
            <i class='bi bi-filetype-pdf icon-100'></i> ${selectedYear} 
        </button>
    `;
}
function mostrarBoton2() {
    const selectedYear = document.getElementById('select_periodo2').value;
    const botonInforme2 = document.getElementById('botonInforme2');
    
    botonInforme2.innerHTML = `
        <button type="button" class="btn btn-warning me-2 btnAnular text-light" id="btn2Informe${selectedYear}" onclick="imprimirInforme2(${selectedYear})">
            <i class='bi bi-filetype-pdf icon-100'></i> ${selectedYear}
        </button>
    `;
}

// Llamar a la función una vez para inicializar el botón
document.addEventListener('DOMContentLoaded', function() {
    mostrarBoton(); // Opcional, si quieres que se muestre el botón al cargar la página.
});
document.addEventListener('DOMContentLoaded', function() {
    mostrarBoton2();
});


//!PDF DETALLADO
$(document).on('click', '.btnPdf', function () {
    // Capturar los datos del botón
    id1 = $(this).data("id");
    nombre1 = $(this).data("nombre");

    // Mostrar el modal
    $(".modal-header").css("background-color", "#17a2b8");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Informes por año: "+nombre1);		
    $('#imprimirModal').modal('show');
});


//!PDF CON FIRMA Y RUT PARA RETIRO
 $(document).on('click', '.btnPdf2', function () {
        // Capturar los datos del botón
        id1 = $(this).data("id");
        nombre1 = $(this).data("nombre");

        // Mostrar el modal
        $(".modal-header").css("background-color", "#17a2b8");
        $(".modal-header").css("color", "white");
        $(".modal-title").text("Informes por año: "+nombre1);		
        $('#imprimirModal2').modal('show');
    });


 
$('#btnInforme2023').on('click', function() {
    imprimirInforme(2023, id1, nombre1); 
});

$('#btnInforme2024').on('click', function() {
    imprimirInforme(2024, id1, nombre1);
});

$('#btnInforme2025').on('click', function() {
    imprimirInforme(2025, id1, nombre1);
});

$('#btnInforme2026').on('click', function() {
    imprimirInforme(2026, id1, nombre1);
});

$('#btn2Informe2023').on('click', function() {
    imprimirInforme2(2023, id1, nombre1); 
});

$('#btn2Informe2024').on('click', function() {
    imprimirInforme2(2024, id1, nombre1);
});

$('#btn2Informe2025').on('click', function() {
    imprimirInforme2(2025, id1, nombre1);
});

$('#btn2Informe2026').on('click', function() {
    imprimirInforme2(2026, id1, nombre1);
});


function imprimirInforme(anio) {
    if (id1 && nombre1) {
        crearpdf(id1, nombre1, anio);
    }
}
 function imprimirInforme2(anio) {
        if (id1 && nombre1) {
            crearpdf2(id1, nombre1, anio);
        }
    }

function crearpdf(id1, nombre1, anio) {
    window.open("../reportePdfOrganizacion.php?idOrg=" + id1 + "&nombre1=" + nombre1 + "&anio=" + anio);
}

function crearpdf2(id1, nombre1, anio) {
    window.open("../reportePdfOrganizacion2.php?idOrg=" + id1 + "&nombre1=" + nombre1 + "&anio=" + anio);
}



//table.draw();