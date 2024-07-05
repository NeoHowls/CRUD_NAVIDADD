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
 
window.addEventListener('DOMContentLoaded', (evento) => {
    /* Obtenemos la fecha de hoy en formato ISO */
    const hoy_fecha = new Date().toISOString().substring(0, 10);
    
    /* Calculamos la fecha hace 11 años */
    const fecha_hace_11_anios = new Date();
    fecha_hace_11_anios.setFullYear(fecha_hace_11_anios.getFullYear() - 11);
    const anio_hace_11_anios = fecha_hace_11_anios.getFullYear();
    
    /* Establecemos la fecha mínima desde enero de hace 11 años */
    const fecha_minima = `${anio_hace_11_anios}-01-01`;
    
    /* Buscamos la etiqueta del input por su selector */
    // document.querySelector("input[name='fecha']").max = hoy_fecha;
    // document.querySelector("input[name='fecha']").min = fecha_minima;
});


function calcularEdad(fecha, periodo) {
    var hoy = new Date
    hoy.setFullYear(periodo);
    hoy.setMonth(11); // 11 representa diciembre (los meses son indexados desde 0)
    hoy.setDate(30);
    console.log(hoy)
    var cumpleanos = new Date(fecha);
    var edad = hoy.getFullYear() - cumpleanos.getFullYear();
    var m = hoy.getMonth() - cumpleanos.getMonth();

    if (m < 0 || (m === 0 && hoy.getDate() < cumpleanos.getDate())) {
        edad--;
    }

    return edad;
}
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

        {"data": "id"}, //0
        {"data": "dni"}, //1
        {"data": "nombre"}, //2
        {"data": "sexo"}, //3
        {"data": "sexo_vista"}, //4
        {"data": "edad"}, //5
        {"data": "fechaNacimiento"},//6
        {"data": "periodo"},//7

        {"data": "fechaRegistro"},//8
        {"data": "idNacionalidad"},//9
        {"data": "checkExtranjero"},//10
        
        {"data": "checkCeguera"},//11
        {"data": "checkSordera"},//12
        {"data": "checkMudez"},//13
        {"data": "checkFisica"},//14
        {"data": "checkMental"},//15
        {"data": "checkPsiquica"},//16

        {"data": "idOrganizacion"},//17
        {"data": "idPersonalRegistro"},//18
        {"data": "checkDiscapacitado"},//19

        {"data": "porcentajeCeguera"},//20
        {"data": "porcentajeSordera"},//21
        {"data": "porcentajeMudez"},//22
        {"data": "porcentajeFisica"},//23
        {"data": "porcentajeMental"},//24
        {"data": "porcentajePsiquica"},//25
        {"data": "descripcion"},//26
        {"data": "etnia"},//27
        {"data": "nacionalidad"},//28
        {"data": "NOMBRE_ORGANIZACION"},//29
        {"data": "tipo"},//30
        {"data": "tipo_org"},//31
        {"data": "idEtnia"},//32
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

//! --------------cambio de areas-------------------
$("#tipo").change(function(){

    $('#organizacion_selection').attr('disabled', false);
/*     $('#departamentos').attr('disabled', true);
    $('#secciones').attr('disabled', true); */

   /*  $('#btnDepartamento').attr('disabled', true);
    $('#btnSeccion').attr('disabled', true); */

/*     $("#departamentos").empty();
    $("#departamentos").html("<option selected disabled>Sin Departamentos</option>")
    $("#secciones").empty();
    $("#secciones").html("<option selected disabled>Sin Secciones</option>") */
    let carea = $('#tipo').val();
    let action = 1;

    listarDireccion(carea);

    /* parametros="codigo_area="+carea;
    $.ajax({
        data: parametros,
        url: 'ajax_direcciones.php',
        type: 'POST',
        beforeSend: function(){
            // alert("enviado")
        },
        success: function(response){
            $("#direcciones").html(response);
        },
        error:function(){
            alert("error")
        }
    });//fin ajax */

  })//fin change

function listarDireccion(carea){
    parametros="codigo_area="+carea
    //  parametros="codigo_area="+carea;
//  console.log(parametros);
    $.ajax({
        data: parametros,
        url: '../controller/controller_filtrar_organizacion.php',
        type: 'POST',
        beforeSend: function(){
           // alert("enviado")
        },
        success: function(response){
            $("#organizacion_selection").html(response);
            // console.log(response);
        },
        error:function(){
            alert("error")
        }
    });//fin ajax
}


$(document).ready(function() {

    $('#select_periodo').on('change', function(){
        table.draw();

    })

    $('#organizacion_selection').on('change', function(){
        table.draw();

    })

    $('#tipo').on('change', function(){
        table.draw();

    })




})

const hoy = new Date();
const anioActual = hoy.getFullYear();
$('#select_periodo').val(anioActual);
$.fn.dataTableExt.afnFiltering.push(
    function(setting, data, index){
        var select_periodo = $('select#select_periodo option:selected').val();
        var periodo_columna = data[7]
        var select_org = $('select#organizacion_selection option:selected').val();
        var select_tipo = $('select#tipo option:selected').val();
        var org_columna = data[17]
        console.log(select_org)
        console.log(org_columna)
        if (select_org || select_tipo == 0) {
            if (select_periodo == periodo_columna & select_org <= org_columna) {
                return true;
            }
            
        }
        else if (select_periodo == periodo_columna & select_org == org_columna)  {
            return true;
            
        }
        return false
    
    }


);


var fila; //captura la fila, para editar o eliminar
//submit para el Alta y Actualización
$('#formUsuarios').submit(function(e){                         
    e.preventDefault(); //evita el comportambiento normal del submit, es decir, recarga total de la página
    //CAPTURA EL DATO DEL FORMULARIO


    dni = $.trim($('#dni').val());
    nombre = $.trim($('#nombre').val());
    sexo = $.trim($('#sexo').val());
    periodo = $.trim($('#periodo').val());
    descripcion = $.trim($('#descripcion').val());
    naciemiento = $.trim($('#Naciemiento').val());
    habilitado = $.trim($('#habilitado').val());
    nacion = $.trim($('#nacion').val());
    comuna = $.trim($('#comuna').val());
    // check_dis = $.trim($('#comuna').val());
 /*    ceguera = $.trim($('#ceguera').val());
    sordera = $.trim($('#sordera').val());
    mudez = $.trim($('#mudez').val());
    fisica = $.trim($('#fisica').val());
    mental = $.trim($('#mental').val());
    psiquica = $.trim($('#psiquica').val()); */
    // check_nac = $.trim($('#check_nac').val());


    ceguera_p = $.trim($('#ceguera_percil').val());
    sordera_p = $.trim($('#sordera_percil').val());
    mudez_p= $.trim($('#mudez_percil').val());
    fisica_p = $.trim($('#fisica_percil').val());
    mental_p = $.trim($('#mental_percil').val());
    psiquica_p = $.trim($('#psiquica_percil').val());
    // check_nac = $.trim($('#check_nac').val());
    // edad = $.trim($('#edad').val());
    etnia = $.trim($('#etnia').val());
    edad = calcularEdad(naciemiento, periodo)
    usuario_id = id_usuario;
    organizacion = $.trim($('#O_ID').val());
    // window.alert(ceguera_p+" "+sordera_p+" "+mudez_p+" "+fisica_p+" "+mental_p+" "+psiquica_p )
    window.alert (periodo)                        
    //EJECUTA EL AJAX
    $.ajax({
        //Laa URL es similar al AJAX principaal pero en el op= capturaa la opcion del boton para ejecutar la consulta correcta
          url: "../controller/controllerN.php?op="+opcion,
          type: "POST",
          datatype:"json", 
          //La prueba al solo la tabla ETNIA CAPTURA SOLO 2 VALORES, EL ID Y LA ETNIA, el ID es en caso que se quiera editar   
          data:  {user_id:user_id, dni:dni, nombre:nombre, sexo:sexo, edad:edad, periodo:periodo, descripcion:descripcion, 
            naciemiento:naciemiento, etnia:etnia, nacion:nacion,comuna:comuna,check_dis:check_dis, 
            ceguera:ceguera, sordera:sordera, mudez:mudez, fisica:fisica,
             mental:mental, psiquica:psiquica, 
             ceguera_p:ceguera_p,sordera_p:sordera_p,mudez_p:mudez_p, 
             fisica_p:fisica_p,mental_p:mental_p, psiquica_p:psiquica_p, 
             check_nac:check_nac, id_usuario:id_usuario, organizacion:organizacion},    
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

    
    const periodo_fecha = document.getElementById("periodo").value
    const fecha_hace_11_anios = new Date();
    fecha_hace_11_anios.setFullYear(fecha_hace_11_anios.getFullYear() - 10);
    const anio_hace_11_anios = fecha_hace_11_anios.getFullYear();

    const fecha_hace_120_anios = new Date();
    fecha_hace_120_anios.setFullYear(fecha_hace_120_anios.getFullYear() - 120);
    const anio_hace_120_anios = fecha_hace_120_anios.getFullYear();
    
    /* Establecemos la fecha mínima desde enero de hace 11 años */
    const fecha_minima = `${anio_hace_11_anios}-01-01`;

    const fecha_minima120 = `${anio_hace_120_anios}-01-01`;

    

 
    

    opcion = "add_etnia"; //alta           
    user_id=null;
    check_nac = 0;
    check_dis = 0;
    ceguera = 0;
    sordera = 0;
    mudez = 0;
    fisica = 0;
    mental= 0;
    psiquica = 0;
     if (check_nac == 1) {
        document.getElementById('more_infos').checked = true
        $("#conditional_parts").show();

    }
    else {
        document.getElementById('more_infos').checked = false
        $("#conditional_parts").hide();
    }
    checkboxNAC = document.getElementById('more_infos');
    checkboxNAC.addEventListener('change', function () {
        // Verifica si el checkbox está marcado o no
        if (this.checked) {
            console.log('El checkbox está activado.');
            check_nac = 1;

        } else {
            console.log('El checkbox está desactivado.');
            check_nac = 0;
            $("#nacion").val('1')
            
        }
    });

    if (check_dis == 1) {
        document.getElementById('more_info').checked = true
        $("#conditional_part").show();
        document.getElementById("Naciemiento").min = fecha_minima120
    }
    else {
        document.getElementById('more_info').checked = false
        $("#conditional_part").hide();
        document.getElementById("Naciemiento").min = fecha_minima
    } 
    checkboxDIS = document.getElementById('more_info');
    checkboxDIS.addEventListener('change', function () {
        // Verifica si el checkbox está marcado o no
        if (this.checked) {
            console.log(fecha_minima120);
            check_dis = 1;
            document.getElementById("Naciemiento").min = fecha_minima120

        } else {
            console.log('El checkbox está desactivado.');
            check_dis = 0;
            document.getElementById("Naciemiento").min = fecha_minima
            
        }
    });

    
    
    

    let fecha = new Date();
	let anio = fecha.getFullYear();
 
    selections = document.getElementById('Naciemiento');
    select_periodo = document.getElementById('periodo');
    selections.addEventListener('change', function () {
        edad = calcularEdad(selections.value, select_periodo.value)
    
            document.getElementById('edad').value = edad

    })

    usuario_id = id_usuario
    
    $("#formUsuarios").trigger("reset");
    

    $('#periodo').val(anio);
    if(userTipo==2){
        $("#periodo").prop('disabled', true);
    }else{
        $("#periodo").prop('disabled', false);
    }
    const hoy_fecha = `${anio}-12-30`
    document.getElementById("Naciemiento").max = hoy_fecha
    $("#periodo").on("change", function() {
        const periodo_fecha = document.getElementById("periodo").value
        const hoy_fecha = `${periodo_fecha}-12-30`;
        document.getElementById("Naciemiento").max = hoy_fecha
        edad = calcularEdad(selections.value, select_periodo.value)
    
            document.getElementById('edad').value = edad
        
    });
    document.getElementById("ceguera_percil").disabled = true;
    checkboxCeguera = document.getElementById('ceguera');
    checkboxCeguera.addEventListener('change', function () {
        // Verifica si el checkbox está marcado o no
        if (this.checked) {
            console.log('El checkbox está activado.');
            ceguera = 1;
            document.getElementById("ceguera_percil").disabled = false;

        } else {
            console.log('El checkbox está desactivado.');
            ceguera = 0;
            document.getElementById("ceguera_percil").disabled = true;
            document.getElementById("ceguera_percil").value = 0;

        }
    });
    document.getElementById("sordera_percil").disabled = true;
    checkboxSordera= document.getElementById('sordera');
    checkboxSordera.addEventListener('change', function () {
        // Verifica si el checkbox está marcado o no
        if (this.checked) {
            console.log('El checkbox está activado.');
            sordera = 1;
            document.getElementById("sordera_percil").disabled = false;

        } else {
            console.log('El checkbox está desactivado.');
            document.getElementById("sordera_percil").disabled = true;
            sordera = 0;
            document.getElementById("sordera_percil").value = 0;
        }
    });

    document.getElementById("mudez_percil").disabled = true;
    checkboxMudez= document.getElementById('mudez');
    checkboxMudez.addEventListener('change', function () {
        // Verifica si el checkbox está marcado o no
        if (this.checked) {
            console.log('El checkbox está activado.');
            mudez = 1;
            document.getElementById("mudez_percil").disabled = false;

        } else {
            console.log('El checkbox está desactivado.');
            document.getElementById("mudez_percil").disabled = true;
            mudez = 0;
            document.getElementById("mudez_percil").value = 0;
        }
    });

    document.getElementById("fisica_percil").disabled = true;
    checkboxFisica= document.getElementById('fisica');
    checkboxFisica.addEventListener('change', function () {
        // Verifica si el checkbox está marcado o no
        if (this.checked) {
            console.log('El checkbox está activado.');
            document.getElementById("fisica_percil").disabled = false;
            fisica = 1;

        } else {
            console.log('El checkbox está desactivado.');
            document.getElementById("fisica_percil").disabled = true;
            fisica = 0;
            document.getElementById("fisica_percil").value = 0;
        }
    });

    document.getElementById("mental_percil").disabled = true;
    checkboxMental= document.getElementById('mental');
    checkboxMental.addEventListener('change', function () {
        // Verifica si el checkbox está marcado o no
        if (this.checked) {
            console.log('El checkbox está activado.');
            document.getElementById("mental_percil").disabled = false;
            mental = 1;

        } else {
            console.log('El checkbox está desactivado.');
            document.getElementById("mental_percil").disabled = true;
            mental = 0;
            document.getElementById("mental_percil").value = 0;
        }
    });

    document.getElementById("psiquica_percil").disabled = true;
    checkboxPsiquica= document.getElementById('psiquica');
    checkboxPsiquica.addEventListener('change', function () {
        // Verifica si el checkbox está marcado o no
        if (this.checked) {
            console.log('El checkbox está activado.');
            psiquica = 1;
            document.getElementById("psiquica_percil").disabled = false;

        } else {
            console.log('El checkbox está desactivado.');
            document.getElementById("psiquica_percil").disabled = true;
            psiquica = 0;
            document.getElementById("psiquica_percil").value = 0;
        }
    });

    selections = document.getElementById('Naciemiento');
    select_periodo = document.getElementById('periodo');
    selections.addEventListener('change', function () {
        edad = calcularEdad(selections.value, select_periodo.value)
    
            document.getElementById('edad').value = edad

    })

    document.getElementById('edad').disabled = true
    
    $(".modal-header").css( "background-color", "#17a2b8");
    
    $(".modal-header").css( "color", "white" );
    $(".modal-title").text("Añadir Niño");
    $('#modalCRUD').modal('show');	    
});

//Editar       

$(document).on("click", ".btnEditar", function(){	
    const periodo_fecha = document.getElementById("periodo").value
    const fecha_hace_11_anios = new Date();
    fecha_hace_11_anios.setFullYear(fecha_hace_11_anios.getFullYear() - 10);
    const anio_hace_11_anios = fecha_hace_11_anios.getFullYear();

    const fecha_hace_120_anios = new Date();
    fecha_hace_120_anios.setFullYear(fecha_hace_120_anios.getFullYear() - 120);
    const anio_hace_120_anios = fecha_hace_120_anios.getFullYear();
    
    /* Establecemos la fecha mínima desde enero de hace 11 años */
    const fecha_minima = `${anio_hace_11_anios}-01-01`;

    const fecha_minima120 = `${anio_hace_120_anios}-01-01`;
    opcion = "edit_etnia";//editar
    fila = $(this).closest("tr");	        
    user_id = parseInt(fila.find('td:eq(0)').text()); //capturo el ID		            

    dni = fila.find('td:eq(1)').text();
    nombre = fila.find('td:eq(2)').text();
    sexo = fila.find('td:eq(3)').text();
    edad = fila.find('td:eq(5)').text();
    periodo = fila.find('td:eq(7)').text();
    descripcion = fila.find('td:eq(26)').text();
    naciemiento = fila.find('td:eq(6)').text();
    etnia = fila.find('td:eq(32)').text();
    nacion = fila.find('td:eq(9)').text();
    comuna = fila.find('td:eq(29)').text();
    check_nac = fila.find('td:eq(10)').text();


    //CHECK DISCAPACIDAD
    check_dis = fila.find('td:eq(19)').text();
    ceguera = fila.find('td:eq(11)').text();
    sordera = fila.find('td:eq(12)').text();
    mudez = fila.find('td:eq(13)').text();
    fisica = fila.find('td:eq(14)').text();
    mental = fila.find('td:eq(15)').text();
    psiquica = fila.find('td:eq(16)').text();

    ceguera_p = fila.find('td:eq(20)').text();
    sordera_p = fila.find('td:eq(21)').text();
    mudez_p = fila.find('td:eq(22)').text();
    fisica_p = fila.find('td:eq(23)').text();
    mental_p = fila.find('td:eq(24)').text();
    psiquica_p = fila.find('td:eq(25)').text();
    // window.alert(etnia)
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

    //discapacidad
    $("#more_info").val(check_dis);
    $("#ceguera").val(ceguera);
    $("#sordera").val(sordera);
    $("#mudez").val(mudez);
    $("#fisica").val(fisica);
    $("#mental").val(mental);
    $("#psiquica").val(psiquica);

    //discapacidad

    $("#ceguera_percil").val(ceguera_p);
    $("#sordera_percil").val(sordera_p);
    $("#mudez_percil").val(mudez_p);
    $("#fisica_percil").val(fisica_p);
    $("#mental_percil").val(mental_p);
    $("#psiquica_percil").val(psiquica_p);
    if (check_nac == 1) {
        document.getElementById('more_infos').checked = true
        $("#conditional_parts").show();
        // window.alert("holsssa")

    }
    else {
        document.getElementById('more_infos').checked = false
        $("#conditional_parts").hide();
        // window.alert("hola")
    }
    checkboxNAC = document.getElementById('more_infos');
    checkboxNAC.addEventListener('change', function () {
        // Verifica si el checkbox está marcado o no
        if (this.checked) {
            console.log('El checkbox está activado.');
            check_nac = 1;

        } else {
            console.log('El checkbox está desactivado.');
            check_nac = 0;
            $("#nacion").val('1')
            
            
        }
    });

    if (check_dis == 1) {
        document.getElementById('more_info').checked = true
        $("#conditional_part").show();
        document.getElementById("Naciemiento").min = fecha_minima120
    }
    else {
        document.getElementById('more_info').checked = false
        $("#conditional_part").hide();
        document.getElementById("Naciemiento").min = fecha_minima
    } 
    checkboxDIS = document.getElementById('more_info');
    checkboxDIS.addEventListener('change', function () {
        // Verifica si el checkbox está marcado o no
        if (this.checked) {
            console.log(fecha_minima120);
            check_dis = 1;
            document.getElementById("Naciemiento").min = fecha_minima120

        } else {
            console.log('El checkbox está desactivado.');
            check_dis = 0;
            document.getElementById("Naciemiento").min = fecha_minima
            
        }
    });
    if(userTipo==2){
        $("#periodo").prop('disabled', true);
    }else{
        $("#periodo").prop('disabled', false);
    }
    const hoy_fecha = `${periodo_fecha}-12-30`
    document.getElementById("Naciemiento").max = hoy_fecha
    $("#periodo").on("change", function() {
        const periodo_fecha = document.getElementById("periodo").value
        const hoy_fecha = `${periodo_fecha}-12-30`;
        document.getElementById("Naciemiento").max = hoy_fecha
        edad = calcularEdad(selections.value, select_periodo.value)
    
            document.getElementById('edad').value = edad
        
    });

    if (ceguera == 1) {
        document.getElementById('ceguera').checked = true
    
        document.getElementById("ceguera_percil").disabled = false

    }
    else {
        document.getElementById('ceguera').checked = false
    
        document.getElementById("ceguera_percil").disabled = true
    }
    checkboxceguera = document.getElementById('ceguera');
    checkboxceguera.addEventListener('change', function () {
        // Verifica si el checkbox está marcado o no
        if (this.checked) {
            console.log('El checkbox está activado.');
            document.getElementById("ceguera_percil").disabled = false
            ceguera = 1;

        } else {
            console.log('El checkbox está desactivado.');
            ceguera = 0;
            document.getElementById("ceguera_percil").disabled = true;
            document.getElementById("ceguera_percil").value = 0;
            
            
        }
    });

    if (sordera == 1) {
        document.getElementById('sordera').checked = true
      
        document.getElementById("sordera_percil").disabled = false

    }
    else {
        document.getElementById('sordera').checked = false
     
        document.getElementById("sordera_percil").disabled = true;
    }
    checkboxsordera = document.getElementById('sordera');
    checkboxsordera.addEventListener('change', function () {
        // Verifica si el checkbox está marcado o no
        if (this.checked) {
            console.log('El checkbox está activado.');
            sordera = 1;

        } else {
            console.log('El checkbox está desactivado.');
            sordera = 0;
            document.getElementById("sordera_percil").disabled = true;
            document.getElementById("sordera_percil").value = 0;
            
        }
    });

    if (mudez == 1) {
        document.getElementById('mudez').checked = true
    
        document.getElementById("mudez_percil").disabled = false

    }
    else {
        document.getElementById('mudez').checked = false

        document.getElementById("mudez_percil").disabled = true;

    }
    checkboxmudez = document.getElementById('mudez');
    checkboxmudez.addEventListener('change', function () {
        // Verifica si el checkbox está marcado o no
        if (this.checked) {
            console.log('El checkbox está activado.');
            mudez = 1;

        } else {
            console.log('El checkbox está desactivado.');
            mudez = 0;
            document.getElementById("mudez_percil").disabled = true;
            document.getElementById("mudez_percil").value = 0;
            
            
        }
    });

    if (fisica == 1) {
        document.getElementById('fisica').checked = true

        document.getElementById("fisica_percil").disabled = false;


    }
    else {
        document.getElementById('fisica').checked = false

        document.getElementById("fisica_percil").disabled = true;

    }
    checkboxfisica = document.getElementById('fisica');
    checkboxfisica.addEventListener('change', function () {
        // Verifica si el checkbox está marcado o no
        if (this.checked) {
            console.log('El checkbox está activado.');
            fisica = 1;

        } else {
            console.log('El checkbox está desactivado.');
            fisica = 0;
            document.getElementById("fisica_percil").disabled = true;
            document.getElementById("fisica_percil").value = 0;
            
            
        }
    });


    if (mental == 1) {
        document.getElementById('mental').checked = true

        document.getElementById("mental_percil").disabled = false;


    }
    else {
        document.getElementById('mental').checked = false

        document.getElementById("mental_percil").disabled = true;

    }
    checkboxmental = document.getElementById('mental');
    checkboxmental.addEventListener('change', function () {
        // Verifica si el checkbox está marcado o no
        if (this.checked) {
            console.log('El checkbox está activado.');
            mental = 1;

        } else {
            console.log('El checkbox está desactivado.');
            mental = 0;
            document.getElementById("mental_percil").disabled = true;
            document.getElementById("mental_percil").value = 0;
            
            
        }
    });


    if (psiquica == 1) {
        document.getElementById('psiquica').checked = true
   
        document.getElementById("psiquica_percil").disabled = false

    }
    else {
        document.getElementById('psiquica').checked = false
   
        document.getElementById("psiquica_percil").disabled = true;

    }
    checkboxpsiquica = document.getElementById('psiquica');
    checkboxpsiquica.addEventListener('change', function () {
        // Verifica si el checkbox está marcado o no
        if (this.checked) {
            console.log('El checkbox está activado.');
            psiquica = 1;

        } else {
            console.log('El checkbox está desactivado.');
            document.getElementById("psiquica_percil").disabled = true;
            psiquica = 0;
            document.getElementById("psiquica_percil").value = 0;
            
            
        }
    });
    selections = document.getElementById('Naciemiento');
    select_periodo = document.getElementById('periodo');
    selections.addEventListener('change', function () {
        edad = calcularEdad(selections.value, select_periodo.value)
    
            document.getElementById('edad').value = edad

    })

    document.getElementById('edad').disabled = true
  
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

