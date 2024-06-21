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
 

let table = $('#myTable').DataTable( {
    // destroy : true,


    pageLength: 50,
    
    //TENGO QUE SEPARAR ESTO EN OTRO ARCHIVO
    "ajax":{
        url: "../controller/controllerN.php?op=ninos",
        dataSrc:"",
        type: "post",
        responsive : true,
        aaSorting:[]

    },
    "columns":[

        {"data": "id"},
        {"data": "correlativo"},
        {"data": "dni"},
        {"data": "nombre"},
        {"data": "sexo"},

        {"data": "edad"},
        {"data": "periodo"},
        {"data": "descripcion"},
        {"data": "fechaRegistro"},
        {"data": "fechaNacimiento"},
        
        
        {"data": "etnia"},
        {"data": "nacionalidad"},
        {"data": "COMUNA"},
        {"data": "tipo"},
        { "data": "idNacionalidad"},
        {"data": "checkExtranjero"},
        
        {"defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btn-sm btnEditar'><i class='material-icons'><svg xmlns=http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil-square' viewBox='0 0 16 16'><path d='M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z'/><path fill-rule='evenodd' d='M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z'/></svg></i>"}

        
       

    ] , 

    //ESTO DEBERIA INVOCARSE EN BASE A UN ID
    language : idioma_espanol,
    //autoWidth: false,
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

    correlativo = $.trim($('#correlativo').val());
    dni = $.trim($('#dni').val());
    nombre = $.trim($('#nombre').val());
    sexo = $.trim($('#sexo').val());
    periodo = $.trim($('#periodo').val());
    descripcion = $.trim($('#mail').val());
    idPerfil = $.trim($('#descripcion').val());
    naciemiento = $.trim($('#Naciemiento').val());
    habilitado = $.trim($('#habilitado').val());
    nacion = $.trim($('#nacion').val());
    comuna = $.trim($('#comuna').val());
    check_dis = $.trim($('#comuna').val());
    ceguera = $.trim($('#ceguera').val());
    sordera = $.trim($('#sordera').val());
    mudez = $.trim($('#mudez').val());
    fisica = $.trim($('#fisica').val());
    mental = $.trim($('#mental').val());
    psiquica = $.trim($('#psiquica').val());
    check_nac = $.trim($('#check_nac').val());
    edad = $.trim($('#edad').val());
    etnia = $.trim($('#etnia').val());
   
    
    //console.log(opcion)                            
    //EJECUTA EL AJAX
    $.ajax({
        //Laa URL es similar al AJAX principaal pero en el op= capturaa la opcion del boton para ejecutar la consulta correcta
          url: "../controller/controllerN.php?op="+opcion,
          type: "POST",
          datatype:"json", 
          //La prueba al solo la tabla ETNIA CAPTURA SOLO 2 VALORES, EL ID Y LA ETNIA, el ID es en caso que se quiera editar   
          data:  {user_id:user_id, dni:dni, nombre:nombre, sexo:sexo, edad:edad, periodo:periodo, descripcion:descripcion, 
            naciemiento:naciemiento, etnia:etnia, nacion:nacion,comuna:comuna, check_dis:check_dis, ceguera:ceguera, 
              sordera: sordera, mudez: mudez, fisica: fisica, mental: mental, psiquica: psiquica, check_nac: check_nac, correlativo: correlativo},    
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
    
    opcion = "add_etnia"; //alta           
    user_id=null;
    check_nac = 0;
    if (check_nac == 1) {
        document.getElementById('more_infos').checked = true
        $("#conditional_parts").show();

    }
    else {
        document.getElementById('more_infos').checked = false
        $("#conditional_parts").hide();
    }

    if (check_nac == 1) {
        document.getElementById('more_info').checked = true
        $("#conditional_part").show();
    }
    else {
        document.getElementById('more_info').checked = false
        $("#conditional_part").hide();
    }

    let fecha = new Date();
	let anio = fecha.getFullYear();
    // alert(userTipo);
    
    
    $("#formUsuarios").trigger("reset");

    $('#periodo').val(anio);
    if(userTipo==2){
        $("#periodo").prop('disabled', true);
    }else{
        $("#periodo").prop('disabled', false);
    }

    $(".modal-header").css( "background-color", "#17a2b8");
    $(".modal-header").css( "color", "white" );
    $(".modal-title").text("Añadir Niño");
    $('#modalCRUD').modal('show');	    
});

//Editar       

$(document).on("click", ".btnEditar", function(){		        
    opcion = "edit_etnia";//editar
    fila = $(this).closest("tr");	        
    user_id = parseInt(fila.find('td:eq(0)').text()); //capturo el ID		            
    correlativo = fila.find('td:eq(1)').text();
    dni = fila.find('td:eq(2)').text();
    nombre = fila.find('td:eq(3)').text();
    sexo = fila.find('td:eq(4)').text();
    edad = fila.find('td:eq(5)').text();
    periodo = fila.find('td:eq(6)').text();
    descripcion = fila.find('td:eq(7)').text();
    naciemiento = fila.find('td:eq(9)').text();
    etnia = fila.find('td:eq(10)').text();
    nacion = fila.find('td:eq(14)').text();
    comuna = fila.find('td:eq(12)').text();
    check_nac = fila.find('td:eq(15)').text();
    $("#correlativo").val(correlativo);
    $("#dni").val(dni);
    $("#nombre").val(nombre);
    $("#sexo").val(sexo);
    $("#edad").val(edad);
    $("#periodo").val(periodo);
    $("#descripcion").val(descripcion);
    $("#Naciemiento").val(naciemiento);
    $("#etnia").val(etnia);
    $("#nacion").val(nacion);
    $("#comuna").val(comuna);

    if (check_nac == 1) {
        document.getElementById('more_infos').checked = true
        $("#conditional_parts").show();
        
    }
    else{
        document.getElementById('more_infos').checked = false
        $("#conditional_parts").hide();
    }
  
    if (check_nac == 1) {
        document.getElementById('more_info').checked = true
        $("#conditional_part").show();
    }
    else{
        document.getElementById('more_info').checked = false
        $("#conditional_part").hide();
    }
  
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

