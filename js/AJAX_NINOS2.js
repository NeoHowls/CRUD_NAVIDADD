let table, dataid;

let listarNinos = function(tipoO,Organizacion,periodo){

    alert (tipoO+','+Organizacion+','+periodo);
    
    table = $('#myTable').DataTable( {
        destroy : true,


        pageLength: 50,
        
        //TENGO QUE SEPARAR ESTO EN OTRO ARCHIVO
        "ajax":{
            url: "../controller/controllerN.php?op=ninos",
            dataSrc:"",
            type: "post",
            responsive : true,
            aaSorting:[],
            data: { tipoO: tipoO, Organizacion: Organizacion, periodo: periodo }

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
                        
                    }/* ,
                    {    
                        extend: 'colvis',
                        text: 'COLUMNAS',
                    } */
                ] 
            }
        }
    } );
}

//! --------------cambio de tipo-------------------
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
    let tipo = $('#tipo').val();
    let action = 1;

    listarOrganizacion(tipo);

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

function listarOrganizacion(tipo){
    parametros="tipo="+tipo
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

    $('#tipo').change(function(){
        let tipoS = $('#tipo').val();
        let organizacionS = $('#organizacion_selection').val();
        let periodoS = $('#select_periodo').val();
        // alert(tipoS);
        // table.destroy();
        listarNinos(tipoS,organizacionS,periodoS);
    });
    $('#organizacion_selection').change(function(){
        let tipoS = $('#tipo').val();
        let organizacionS = $('#organizacion_selection').val();
        let periodoS = $('#select_periodo').val();
        // alert(organizacionS);
        // table.destroy();
        listarNinos(tipoS,organizacionS,periodoS);
     });
    $('#select_periodo').change(function(){
        let tipoS = $('#tipo').val();
        let organizacionS = $('#organizacion_selection').val();
        let periodoS = $('#select_periodo').val();
        // alert(periodoS);
        // table.destroy();
        listarNinos(tipoS,organizacionS,periodoS);
    });

/* $(document).ready(function() {
    // table.draw();
    $('#select_periodo').on('change', function(){
        // table.draw();
        // alert("periodo");
        // listarNinos(tipoO,Organizacion,periodo);
        // table.draw();
    })

    $('#organizacion_selection').on('change', function(){
        //table.draw();
        // listarNinos(tipoO,Organizacion,periodo);
        // table.draw();
    })

    $('#tipo').on('change', function(){
        //table.draw();
        // listarNinos(tipoO,Organizacion,periodo);
        // table.draw();
    })




}) */