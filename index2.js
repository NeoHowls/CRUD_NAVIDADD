let table,dataid;

let listarS = function(mes,anio,userTipo,codigoArea){
    // alert(mes+','+anio+','+userTipo+','+codigoArea);
    dataid=[
    // {"data": "ID"},    
    /* {"data": "CORRELATIVO"}, */
    {"data": null, render: function (data, type, row){
        let $correlativo = data["CORRELATIVO"];
        // asignar ="<button type='button' class='btn btn-outline-success ms-1 p-1 btnAnular' title='Editar'"+
        //         "onclick=\"mostrarAsignarSolicitud('"+$correlativo+"')\">"+
        //         "<i class='bi bi-person-plus'></i>"+
        //         "</button>";
        return $correlativo;

        }
    },
    {"data": "id"},
        {"data": "correlativo"},
        {"data": "dni"},
        {"data": "nombre"},
        {"data": "sexo"},
        {"data": "edad"},
        // {"defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btn-sm btnEditar'><i class='material-icons'><svg xmlns=http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil-square' viewBox='0 0 16 16'><path d='M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z'/><path fill-rule='evenodd' d='M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z'/></svg></i>"},

        {"data": "fechaNacimiento"},
        {"data": "idNacionalidad"},
        {"data": "idEtnia"},
        {"data": "estado"},
        {"data": "periodo"},
        {"data": "checkCeguera"},
        {"data": "checkSordera"},
        {"data": "checkMudez"},
        {"data": "checkFisica"},
        {"data": "checkMental"},
        {"data": "checkPsiquica"},
        {"data": "descripcion"},
        {"data": "idOrganizacion"},
        {"data": "corrRegistro"},
        {"data": "fechaRegistro"},
        {"data": "checkNacional"},
        {"data": "checkDiscapacitado"},
        {"data": "checkRSH"},
    {"data": null, render: function (data, type, row){
        let solicitud = data["SOLICITUD"];
        // let corregido= '';
         /* solicitud = solicitud.replaceAll("\r\n","<br>");
         solicitud = solicitud.replaceAll("\n\r","<br>");
         solicitud = solicitud.replaceAll("\r","<br>");
         solicitud = solicitud.replaceAll("\t","<br>");
         solicitud = solicitud.replaceAll("\n","<br>"); */
         solicitud = solicitud.replaceAll("|","<br>");
         
            return solicitud;
        }
    },
    // {"data": "ESTADO"},var var2=var1..replace(/([^\d])(\d)([^\w]*)/, replacer);
    {"data": null, render: function (data, type, row){
        let $estado = data["ESTADO"];
        let $folio =  data["FOLIO"];


        if($estado==1){
            // return "SIN ASIGNAR";
            return "<span class='badge bg-danger'>Sin Asignar</span>";
        }else if($estado==2){
            // return "ASIGNADO";
            return "<span class='badge bg-info'>Asignado</span>";
        }else if($estado==3){
            // return "CONFIRMADO";
            return "<span class='badge bg-warning text-dark'>En Proceso</span>";
        }else if($estado==4){
            // return "FINALIZADO";
            return "<span class='badge bg-info'>Asistencia Folio "+$folio+"</span>";
        }else if($estado==5){
            // return "FINALIZADO";
            return "<span class='badge bg-success'>Finalizado Folio "+$folio+"</span>";
        }else if($estado==0){
            // return "ANULADO";
            return "<span class='badge bg-secondary'>Anulado</span>";
        }

        }
    },
    {"data": "NOMBRE_PERSONAL"},
    {"data": "FECHA_CIERRE"},
    {"data": null, render: function (data, type, row){
            let correlativo = data["CORRELATIVO"];
            let rut_personal = data["RUT_PERSONAL"];
            let nombre_personal = data["NOMBRE_PERSONAL"];
            let estado = data["ESTADO"];
            let conteoComentario = data["conteoComentario"];
        
            asignar ="<button type='button' class='btn btn-outline-success ms-1 p-1 btnAnular' title='Asignar'"+
                    "onclick=\"mostrarAsignarSolicitud('"+correlativo+"')\">"+
                    "<i class='bi bi-person-plus-fill'></i>"+
                    "</button>";
            quitar ="<button type='button' class='btn btn-outline-danger ms-1 p-1 btnAnular' title='Desasignar'"+
                    "onclick=\"mostrarQuitarSolicitud('"+correlativo+"','"+nombre_personal+"','"+rut_personal+"')\">"+
                    "<i class='bi bi-person-dash-fill'></i>"+
                    "</button>";
            anular = "<button type='button' class='btn btn-outline-danger ms-1 p-1 btnAnular' title='Anular'"+
                    "onclick=\"mostrarAnularSolicitud('"+correlativo+"')\">"+
                    "<i class='bi bi-trash-fill'></i>"+
                    "</button>";
            if(conteoComentario==0){
                comentario = "<button type='button' class='btn btn-outline-warning ms-1 p-1 btnAnular' title='Comentar'"+
                    "onclick=\"mostrarComentario('"+correlativo+"','"+estado+"')\">"+
                    "<i class='bi bi-chat-dots'></i>"+
                    "</button>";
            }else{
                comentario = "<button type='button' class='btn btn-warning ms-1 p-1 btnAnular' title='Comentar'"+
                "onclick=\"mostrarComentario('"+correlativo+"','"+estado+"')\">"+
                "<i class='bi bi-chat-dots'></i>"+
                "</button>";    
            }
                    
            // alert(estado);
            if(estado==1){
                return asignar+anular+comentario;
            }else if(estado==2){
                return quitar+comentario;
            }else if(estado==3){
                return quitar+comentario;
                // return "<span class='badge bg-warning text-dark'>En Proceso</span>";
            }else{
                // return "S/A";
                return comentario;
                // return "<span class='badge bg-secondary'>Sin Acciones</span>";
            }
        }
        
    },
    // {"data": "RECURSOS"},
    {"data": null, render: function (data, type, row){
        let recursos = data["RECURSOS"];
        
        return '<br>'+recursos.replaceAll(",", '<br/>');
        }
    },
    // {"data": "SISTEMAS"},
    {"data": null, render: function (data, type, row){
        let sistemas = data["SISTEMAS"];
        
        return '<br>'+sistemas.replaceAll(",", '<br/>');
        }
    },
    // {"data": "RAYEN"}
    {"data": null, render: function (data, type, row){
        let rayen = data["RAYEN"];
        //console.log ('<br>'+rayen.replace("|", '<br/>'));
        return '<br>'+rayen.replaceAll(",", '<br/>');
        
        }
    }
    ];
        
    table = $('#myTable').DataTable( {
        "destroy" : true,
        "pageLength": 25,
        "language" : idioma_espanol,
        "autoWidth": false,
        "responsive" : true,
        "aaSorting":[],
        "pagingType": "simple",
        // "dom": 't',//'Bfrtilp',
        // "dom": 'Bftilp',//'Bfrtilp', 
        /* "buttons" :botones, */
        "columnDefs": [
            {"className": "dt-center", "targets": "_all"}
        ], 
        "ajax":{
            method: "POST",
            url: "./controller/controller.php?op=ninos",
            data: {"opcion":1,
                    "userTipo":userTipo,
                    "codigoArea":codigoArea,
                    "mes":mes,"anio":anio},
            // "dataSrc":""   
            "dataSrc":""        
        },
        "columns":dataid
    });
    table.draw();

//!://////////////////////////////////////////////////////////////////////////////////////////////////////////////

//!://////////////////////////////////////////////////////////////////////////////////////////////////////////////
}//FIN FUNCION

//! -----------------------------------------------------------------------------------------------------------------------------------------------------------
//! -----------------------------------------------------------LENGUAJE DATATABLA--------------------------------------------------------------------------
//! -----------------------------------------------------------------------------------------------------------------------------------------------------------

let idioma_espanol = {
    "sLengthMenu": "Mostrar MENU registros por pagina",
    /* "sLengthMenu": "Mostrar "+ 
                    "<select class='form-select form-select-sm'>"+
                        "<option value='3'>3</option>"+
                        "<option value='10'>10</option>"+
                        "<option value='25'>25</option>"+
                        "<option value='50'>50</option>"+
                        "<option value='-1'>All</option>"+
                    "</select>"+
                  " registros por pagina", */
    "sZeroRecords": "No se encuentran resultados !",
    "sInfo": "Mostrar registros del START al END de un total de TOTAL registros",
    "sInfoEmpty": "Mostrar registros del 0 al 0 de un total de 0 registros",
    "sInfoFiltered": "(filtrado de un total de MAX regsitros)",
    "sSearch": "Buscar:",
    "sLoadingRecords": "Cargando...",
    "oPaginate": {
        "sFirst": "Primero",
        "sLast": "Ultimo",
        "sNext": "Siguiente",
        "sPrevious": "Anterior"
    },
    "processing": "Procesando..."
};
//! ---------------------------------------------------------------------------------------------------------
function mostrarAsignarSolicitud(correlativo){
    limpiarModalAsignacion();
    $("#correlativo").val(correlativo);
    $('#modalAsignarSolicitud').modal('show');
}

function mostrarQuitarSolicitud(correlativo,nombre_personal,rut_personal){
    /* limpiarModalAsignacion();*/
    $("#qcorrelativo").val(correlativo);
    $("#qrut_personal").val(rut_personal);
    // $("#qnombre_personal").val(nombre_personal);

    $('#m_personal').html(nombre_personal);
    $('#m_correlativo').html(correlativo);
    $('#modalQuitarSolicitud').modal('show'); 
}

function mostrarAnularSolicitud(correlativo){
    // console.log(correlativo);
    $("#aCorrelativo").val(correlativo);
    $('#modalAnularSolicitud').modal('show');
}

function mostrarComentarioSolicitud(correlativo){
    console.log(correlativo);
    $("#ccorrelativo").val(correlativo);
    $('#modalComentarioSolicitud').modal('show');
}

//!:mostrar comentarios en ventana emergente
function mostrarComentario(correlativo,estado){
    // alert("ticket = "+ticket);
    /* $('#hticket').val(ticket);
    $('#modalHistoriaEquipo').modal('show'); */
    // <a href="tHistorial.php" onclick="return popup(this, 'report')"></a>
    url='tComentario.php?correlativo='+correlativo+'&estado='+estado;
    windowName='Comentario solicitud';
    popUp(url,windowName);
}

function popUp(url,windowName) {
    var newWindow=window.open(url,windowName,width=200,height=100);
    if (window.focus) {newWindow.focus()}
    return false;
}