
 

let table = $('#myTable2').DataTable( {
    // destroy : true,


    pageLength: 50,
    
    //TENGO QUE SEPARAR ESTO EN OTRO ARCHIVO
    "ajax":{
        url: "../controller/controllerU.php?op=usuario",
        dataSrc:"",
        type: "post",
        responsive : true,
        aaSorting:[]

    },
    "columns":[

        {"data": "id"},
        {"data": "perfil"},
        {"data": "tipo"},
        {"data": "checkCreateN"},
        {"data": "checkUpdateN"},
        {"data": "checkReadN"},
        {"data": "checkDeleteN"},

        {"data": "checkCreateO"},
        {"data": "checkUpdateO"},
        {"data": "checkReadO"},
        {"data": "checkDeleteO"},

        {"data": "checkCreateP"},
        {"data": "checkUpdateP"},
        {"data": "checkReadP"},
        {"data": "checkDeleteP"},

        { "data": "checkCreatePer" },
        { "data": "checkUpdatePer" },
        { "data": "checkReadPer" },
        { "data": "checkDeletePer" },

        {"data": "estado"},
        
        
        {"defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btn-sm btnEditar'><i class='material-icons'><svg xmlns=http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil-square' viewBox='0 0 16 16'><path d='M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z'/><path fill-rule='evenodd' d='M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z'/></svg></i>"},

        
       

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
    
    perfil = $.trim($('#perfil').val());
    tipo = $.trim($('#tipo').val());
    Estado = $.trim($('#estado').val());
    
    console.log(CheckNC)
    alert(CheckNC);    
    //console.log(opcion)                            
    //EJECUTA EL AJAX
    $.ajax({
        //Laa URL es similar al AJAX principaal pero en el op= capturaa la opcion del boton para ejecutar la consulta correcta
          url: "../controller/controllerU.php?op="+opcion,
          type: "POST",
          datatype:"json", 
          //La prueba al solo la tabla ETNIA CAPTURA SOLO 2 VALORES, EL ID Y LA ETNIA, el ID es en caso que se quiera editar   
        data: {
            user_id: user_id, perfil: perfil,
            tipo: tipo, Estado: Estado,
            CheckNC: CheckNC, CheckNE: CheckNE,
            CheckNL: CheckNL, CheckNB: CheckNB,
            CheckOC: CheckOC, CheckOE: CheckOE,
            CheckOL: CheckOL, CheckOB: CheckOB,
            CheckPC: CheckPC, CheckPE: CheckPE,
            CheckPL: CheckPL, CheckPB: CheckPB,
            CheckPPC: CheckPPC, CheckPPE: CheckPPE,
            CheckPPL: CheckPPL, CheckPPB: CheckPPB

            




          },    
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
    
    //funciona :D
    CheckNC = "";
    CheckNE = "";
    CheckNL = "";
    CheckNB = "";

    CheckOC = "";
    CheckOE = "";
    CheckOL = "";
    CheckOB = "";

    CheckPC = "";
    CheckPE = "";
    CheckPL = "";
    CheckPB = "";

    CheckPPC = "";
    CheckPPE = "";
    CheckPPL = "";
    CheckPPB = "";
    checkbox = document.getElementById('NC');
    checkbox.addEventListener('change', function () {
        // Verifica si el checkbox está marcado o no
        if (this.checked) {
            console.log('El checkbox está activado.');
            CheckNC = 1;

        } else {
            console.log('El checkbox está desactivado.');
            CheckNC = 0;
        }
    });

    checkboxNE = document.getElementById('NE');
    checkboxNE.addEventListener('change', function () {
        // Verifica si el checkbox está marcado o no
        if (this.checked) {
            console.log('El checkbox está activado.');
            CheckNE = 1;

        } else {
            console.log('El checkbox está desactivado.');
            CheckNE = 0;
        }
    });
    checkboxNL = document.getElementById('NL');
    checkboxNL.addEventListener('change', function () {
        // Verifica si el checkbox está marcado o no
        if (this.checked) {
            console.log('El checkbox está activado.');
            CheckNL = 1;

        } else {
            console.log('El checkbox está desactivado.');
            CheckNL = 0;
        }
    });
    checkboxNB = document.getElementById('NB');
    checkboxNB.addEventListener('change', function () {
        // Verifica si el checkbox está marcado o no
        if (this.checked) {
            console.log('El checkbox está activado.');
            CheckNB = 1;

        } else {
            console.log('El checkbox está desactivado.');
            CheckNB = 0;
        }
    });
    //ORG


    checkboxOC = document.getElementById('OC');
    checkboxOC.addEventListener('change', function () {
        // Verifica si el checkbox está marcado o no
        if (this.checked) {
            console.log('El checkbox está activado.');
            CheckOC = 1;

        } else {
            console.log('El checkbox está desactivado.');
            CheckOC = 0;
        }
    });

    checkboxOE = document.getElementById('OE');
    checkboxOE.addEventListener('change', function () {
        // Verifica si el checkbox está marcado o no
        if (this.checked) {
            console.log('El checkbox está activado.');
            CheckOE = 1;

        } else {
            console.log('El checkbox está desactivado.');
            CheckOE = 0;
        }
    });
    checkboxOL = document.getElementById('OL');
    checkboxOL.addEventListener('change', function () {
        // Verifica si el checkbox está marcado o no
        if (this.checked) {
            console.log('El checkbox está activado.');
            CheckOL = 1;

        } else {
            console.log('El checkbox está desactivado.');
            CheckOL = 0;
        }
    });
    checkboxOB = document.getElementById('OB');
    checkboxOB.addEventListener('change', function () {
        // Verifica si el checkbox está marcado o no
        if (this.checked) {
            console.log('El checkbox está activado.');
            CheckOB = 1;

        } else {
            console.log('El checkbox está desactivado.');
            CheckOB = 0;
        }
    });

    //PERSONA
    

    checkboxPC = document.getElementById('PC');
    checkboxPC.addEventListener('change', function () {
        // Verifica si el checkbox está marcado o no
        if (this.checked) {
            console.log('El checkbox está activado.');
            CheckPC = 1;

        } else {
            console.log('El checkbox está desactivado.');
            CheckPC = 0;
        }
    });

    checkboxPE = document.getElementById('PE');
    checkboxPE.addEventListener('change', function () {
        // Verifica si el checkbox está marcado o no
        if (this.checked) {
            console.log('El checkbox está activado.');
            CheckPE = 1;

        } else {
            console.log('El checkbox está desactivado.');
            CheckPE = 0;
        }
    });
    checkboxPL = document.getElementById('PL');
    checkboxPL.addEventListener('change', function () {
        // Verifica si el checkbox está marcado o no
        if (this.checked) {
            console.log('El checkbox está activado.');
            CheckPL = 1;

        } else {
            console.log('El checkbox está desactivado.');
            CheckPL = 0;
        }
    });
    checkboxPB = document.getElementById('PB');
    checkboxPB.addEventListener('change', function () {
        // Verifica si el checkbox está marcado o no
        if (this.checked) {
            console.log('El checkbox está activado.');
            CheckPB = 1;

        } else {
            console.log('El checkbox está desactivado.');
            CheckPB = 0;
        }
    });

    checkboxPC = document.getElementById('PPC');
    checkboxPC.addEventListener('change', function () {
        // Verifica si el checkbox está marcado o no
        if (this.checked) {
            console.log('El checkbox está activado.');
            CheckPC = 1;

        } else {
            console.log('El checkbox está desactivado.');
            CheckPC = 0;
        }
    });

    checkboxPE = document.getElementById('PPE');
    checkboxPE.addEventListener('change', function () {
        // Verifica si el checkbox está marcado o no
        if (this.checked) {
            console.log('El checkbox está activado.');
            CheckPE = 1;

        } else {
            console.log('El checkbox está desactivado.');
            CheckPE = 0;
        }
    });
    checkboxPL = document.getElementById('PPL');
    checkboxPL.addEventListener('change', function () {
        // Verifica si el checkbox está marcado o no
        if (this.checked) {
            console.log('El checkbox está activado.');
            CheckPL = 1;

        } else {
            console.log('El checkbox está desactivado.');
            CheckPL = 0;
        }
    });
    checkboxPB = document.getElementById('PPB');
    checkboxPB.addEventListener('change', function () {
        // Verifica si el checkbox está marcado o no
        if (this.checked) {
            console.log('El checkbox está activado.');
            CheckPB = 1;

        } else {
            console.log('El checkbox está desactivado.');
            CheckPB = 0;
        }
    });

    $("#formUsuarios").trigger("reset");
    $(".modal-header").css("background-color", "#bd0000");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Añadir Perfil");		
    $('#modalCRUD').modal('show');	    
});

//PERSONA




$(document).on("click", ".btnEditar", function(){		        
    opcion = "edit_persona";//editar
    fila = $(this).closest("tr");	        
    user_id = parseInt(fila.find('td:eq(0)').text()); //capturo el ID		            
    perfil = fila.find('td:eq(1)').text();
    tipo = fila.find('td:eq(2)').text();
    CheckNC = fila.find('td:eq(3)').text();
    CheckNE = fila.find('td:eq(4)').text();
    CheckNL = fila.find('td:eq(5)').text();
    CheckNB = fila.find('td:eq(6)').text();
    //CHECK ORGANIZACION
    CheckOC = fila.find('td:eq(7)').text();
    CheckOE = fila.find('td:eq(8)').text();
    CheckOL = fila.find('td:eq(9)').text();
    CheckOB = fila.find('td:eq(10)').text();

    //CHECK PERSONA
    CheckPC = fila.find('td:eq(11)').text();
    CheckPE = fila.find('td:eq(12)').text();
    CheckPL = fila.find('td:eq(13)').text();
    CheckPB = fila.find('td:eq(14)').text();

    CheckPPC = fila.find('td:eq(15)').text();
    CheckPPE = fila.find('td:eq(16)').text();
    CheckPPL = fila.find('td:eq(17)').text();
    CheckPPB = fila.find('td:eq(18)').text();

    Estado = fila.find('td:eq(19)').text();
    $("#perfil").val(perfil);
    $("#tipo").val(tipo);
    $("#estado").val(Estado);
    //NIÑOS
    if (CheckNC == 1) {
        document.getElementById('NC').checked = true
    }
    else {
        document.getElementById('NC').checked = false;
    }
    checkboxNC = document.getElementById('NC');
    checkboxNC.addEventListener('change', function () {
        // Verifica si el checkbox está marcado o no
        if (this.checked) {
            console.log('El checkbox está activado.');
            CheckNC = 1;

        } else {
            console.log('El checkbox está desactivado.');
            CheckNC = 0;
        }
    });
    //------------------------------
    if (CheckNE == 1) {
        document.getElementById('NE').checked = true
    }
    else {
        document.getElementById('NE').checked = false;
    }

    checkboxNE = document.getElementById('NE');
    checkboxNE.addEventListener('change', function () {
        // Verifica si el checkbox está marcado o no
        if (this.checked) {
            console.log('El checkbox está activado.');
            CheckNE = 1;

        } else {
            console.log('El checkbox está desactivado.');
            CheckNE = 0;
        }
    });
    //------------------------------
    if (CheckNL == 1) {
        document.getElementById('NL').checked = true
    }
    else {
        document.getElementById('NL').checked = false;
    }
    checkboxNL = document.getElementById('NL');
    checkboxNL.addEventListener('change', function () {
        // Verifica si el checkbox está marcado o no
        if (this.checked) {
            console.log('El checkbox está activado.');
            CheckNL = 1;

        } else {
            console.log('El checkbox está desactivado.');
            CheckNL = 0;
        }
    });
    //------------------------------
    if (CheckNB == 1) {
        document.getElementById('NB').checked = true
    }
    else {
        document.getElementById('NB').checked = false;
    }
    checkboxNB = document.getElementById('NB');
    checkboxNB.addEventListener('change', function () {
        // Verifica si el checkbox está marcado o no
        if (this.checked) {
            console.log('El checkbox está activado.');
            CheckNB = 1;

        } else {
            console.log('El checkbox está desactivado.');
            CheckNB = 0;
        }
    });
    //ORGANIZACION
    if (CheckOC == 1) {
        document.getElementById('OC').checked = true
    }
    else {
        document.getElementById('OC').checked = false;
    }
    checkboxOC = document.getElementById('OC');
    checkboxOC.addEventListener('change', function () {
        // Verifica si el checkbox está marcado o no
        if (this.checked) {
            console.log('El checkbox está activado.');
            CheckOC = 1;

        } else {
            console.log('El checkbox está desactivado.');
            CheckOC = 0;
        }
    });
    //------------------------------
    if (CheckOE == 1) {
        document.getElementById('OE').checked = true
    }
    else {
        document.getElementById('OE').checked = false;   
    }
    checkboxOE = document.getElementById('OE');
    checkboxOE.addEventListener('change', function () {
        // Verifica si el checkbox está marcado o no
        if (this.checked) {
            console.log('El checkbox está activado.');
            CheckOE  = 1;

        } else {
            console.log('El checkbox está desactivado.');
            CheckOE = 0;
        }
    });
    if (CheckOL == 1) {
        document.getElementById('OL').checked = true
    }
    else {
        document.getElementById('OL').checked = false;
    }
    checkboxOL = document.getElementById('OL');
    checkboxOL.addEventListener('change', function () {
        // Verifica si el checkbox está marcado o no
        if (this.checked) {
            console.log('El checkbox está activado.');
            CheckOL = 1;

        } else {
            console.log('El checkbox está desactivado.');
            CheckOL = 0;
        }
    });

    if (CheckOB == 1) {
        document.getElementById('OB').checked = true
    }
    else {
        document.getElementById('OB').checked = false;
    }

    checkboxOB = document.getElementById('OB');
    checkboxOB.addEventListener('change', function () {
        // Verifica si el checkbox está marcado o no
        if (this.checked) {
            console.log('El checkbox está activado.');
            CheckOB = 1;

        } else {
            console.log('El checkbox está desactivado.');
            CheckOB = 0;
        }
    });
    //------------------------------
    //PERSONA
    if (CheckPC == 1) {
        document.getElementById('PC').checked = true
    }
    else {
        document.getElementById('PC').checked = false;
    }
    checkboxPC = document.getElementById('PC');
    checkboxPC.addEventListener('change', function () {
        // Verifica si el checkbox está marcado o no
        if (this.checked) {
            console.log('El checkbox está activado.');
            CheckPC = 1;

        } else {
            console.log('El checkbox está desactivado.');
            CheckPC = 0;
        }
    });
    //------------------------------
    if (CheckPE == 1) {
        document.getElementById('PE').checked = true
    }
    else {
        document.getElementById('PE').checked = false;
    }
    checkboxPE = document.getElementById('PE');
    checkboxPE.addEventListener('change', function () {
        // Verifica si el checkbox está marcado o no
        if (this.checked) {
            console.log('El checkbox está activado.');
            CheckPE = 1;

        } else {
            console.log('El checkbox está desactivado.');
            CheckPE = 0;
        }
    });

    if (CheckPL == 1) {
        document.getElementById('PL').checked = true
    }
    else {
        document.getElementById('PL').checked = false;
    }
    checkboxPL = document.getElementById('PL');
    checkboxPL.addEventListener('change', function () {
        // Verifica si el checkbox está marcado o no
        if (this.checked) {
            console.log('El checkbox está activado.');
            CheckPL = 1;

        } else {
            console.log('El checkbox está desactivado.');
            CheckPL = 0;
        }
    });
    if (CheckPB == 1) {
        document.getElementById('PB').checked = true
    }
    else {
        document.getElementById('PB').checked = false;
    }
    checkboxPB = document.getElementById('PB');
    checkboxPB.addEventListener('change', function () {
        // Verifica si el checkbox está marcado o no
        if (this.checked) {
            console.log('El checkbox está activado.');
            CheckPB = 1;

        } else {
            console.log('El checkbox está desactivado.');
            CheckPB = 0;
        }
    });
    //------------------------------
    //PERFILES
    if (CheckPPC == 1) {
        document.getElementById('PPC').checked = true
    }
    else {
        document.getElementById('PPC').checked = false;
    }
    checkboxPPC = document.getElementById('PPC');
    checkboxPPC.addEventListener('change', function () {
        // Verifica si el checkbox está marcado o no
        if (this.checked) {
            console.log('El checkbox está activado.');
            CheckPPC = 1;

        } else {
            console.log('El checkbox está desactivado.');
            CheckPPC = 0;
        }
    });
    //------------------------------
    if (CheckPPE == 1) {
        document.getElementById('PPE').checked = true
    }
    else {
        document.getElementById('PPE').checked = false;
    }
    checkboxPPE = document.getElementById('PPE');
    checkboxPPE.addEventListener('change', function () {
        // Verifica si el checkbox está marcado o no
        if (this.checked) {
            console.log('El checkbox está activado.');
            CheckPPE = 1;

        } else {
            console.log('El checkbox está desactivado.');
            CheckPPE = 0;
        }
    });

    if (CheckPPL == 1) {
        document.getElementById('PPL').checked = true
    }
    else {
        document.getElementById('PPL').checked = false;
    }
    checkboxPPL = document.getElementById('PPL');
    checkboxPPL.addEventListener('change', function () {
        // Verifica si el checkbox está marcado o no
        if (this.checked) {
            console.log('El checkbox está activado.');
            CheckPPL = 1;

        } else {
            console.log('El checkbox está desactivado.');
            CheckPPL = 0;
        }
    });
    if (CheckPPB == 1) {
        document.getElementById('PPB').checked = true
    }
    else {
        document.getElementById('PPB').checked = false;
    }
    checkboxPPB = document.getElementById('PPB');
    checkboxPPB.addEventListener('change', function () {
        // Verifica si el checkbox está marcado o no
        if (this.checked) {
            console.log('El checkbox está activado.');
            CheckPPB = 1;

        } else {
            console.log('El checkbox está desactivado.');
            CheckPPB = 0;
        }
    });
    //------------------------------



    
    $(".modal-header").css("background-color", "#bd0000");
    $(".modal-header").css("color", "white" );
    $(".modal-title").text("Editar Perfil");		
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