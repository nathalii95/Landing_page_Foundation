toastr.options = {
    "closeButton": true,
    "debug": false,
    "newestOnTop": false,
    "progressBar": true,
    "positionClass": "toast-top-center",
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": "1000",
    "hideDuration": "1000",
    "timeOut": "4000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut",
};

// 1. Inicializaciones al cargar la página 
$(document).ready(function() {
    cargarempcolaboradora();

});


function newColaboracion() {
    $('#colaboracionNew').modal('show');
}

function closenewColaboracion() {
    $('#colaboracionNew').modal('hide');
    console.log("se hixo click");
    limpiarDatosguard();
}

function editcolaborador(idempresacolab){
 $('#modalEditColaborador').modal('show');
   editPresentaInfo(idempresacolab);
   
}

function closeEditColaboracion(){
  $('#modalEditColaborador').modal('hide');
}

function limpiarDatosguard(){
    var nombre = $("#nombre").val('');
    var inputLogo = $("#inputLogo").val('');
   
}

function editPresentaInfo(idempresacolab){
        var idempresacolab = idempresacolab;
        $.ajax({
            type: "POST",
            method: "POST",
            dataType: 'JSON',
            url: 'phpEnvioData/validadato.php?dato=' + 7,
            data: 'idempresacolab=' + idempresacolab,
            success: function(data) {
 
            // Como PHP devuelve un array con un objeto dentro, usamos data[0]
                if(data && data.length > 0) {
                    var item = data[0];               
                    $('#idEditsocialM').val(item.id_empresa_colaboradoras );
                    $('#nombreedit').val(item.nombre_empresa);

                                        // Si existe el logo en la base de datos, lo mostramos en la miniatura
                    if(item.logo_empresa) {
                        // Ajusta la ruta '../' o la que corresponda según dónde esté tu vista respecto a la carpeta imagenes
                        $("#imgLogoPreviewecolab").attr("src", "/aFundacionSanax/adminFundacion/envio/imagenesadmin/" + item.logo_empresa);
                    } else {
                        $("#imgLogoPreviewecolab").attr("src", "/aFundacionSanax/adminFundacion/envio/imagenesadmin/" + item.logo_empresa); // Imagen por defecto si no hay
                    }
                }
            }
        });
   
}



function cargarempcolaboradora() {
    $.ajax({
        type: "POST",
        dataType: 'JSON',
        url: 'phpEnvioData/validadato.php?dato=5',
        success: function(response) {
            console.log(response.data);
            let html = '';
            if(response.statusCode == 200) {
                let datos = response.data;
                // Recorremos cada red social encontrada en la base de datos
                datos.forEach(function(item) {
                    html += `<tr  >
                        <td style="text-align: left">${item.nombre_empresa}</td>
                        <td style="text-align: center"><i class="${item.logo_empresa}" style="font-size: 1.5rem;"></i>
                         <img id="imgLogoColab" src="/aFundacionSanax/adminFundacion/envio/imagenesadmin/${item.logo_empresa}" alt="Logo Actual" style="width: 50px; 
                         height: 50px; object-fit: contain; background: #fff; border: 1px solid #ddd;
                          padding: 3px; border-radius: 4px;">
                        
                        </td>
                        <td style="text-align: center">
                            <button type="button" class="btn btn-outline-dark btn-sm" onclick="editcolaborador(${item.id_empresa_colaboradoras })" style="color:black;">
                                <i class="fa fa-pencil"></i> Editar
                            </button>
                        </td>
                    </tr>`;
                });
            } else {
               html = '<tr><td colspan="4" class="text-center">No hay redes sociales registradas</td></tr>';
            }
            // 1. Inyectamos el HTML dentro del tbody (o la tabla)
            $('#tablaColaboradores').html(html);

            // 2. Inicializamos/Actualizamos DataTable con los nuevos datos cargados
            inicializarTabla();
        },
        error: function(error) {
            console.log("Error al cargar las redes sociales");
        }
    });
}



async function validaRegistroColaboracion() {
console.log("hice click");
    await this.validaRegistrosDatos(0).then(resp => {
        if (resp) {
            setTimeout(function() {
                envioDators();
            }, 1500);
        }
    });
}

function validaRegistrosDatos(action) {
    var nombre = $("#nombre").val();
    var logo = $("#inputLogo").val();

    return new Promise((resolve, reject) => {

        if (nombre == "" || nombre == null) {
            $("#nombre").focus();
            toastr.error("Ingrese el nombre de la Empresa Colaboradora");
            return resolve(false);
        } 
        else if (logo == "" || logo == null) {
            $("#inputLogo").focus();
            toastr.error("Ingrese el Logo de la Empresa Colaboradora");
            return resolve(false);
        } 
        else {
            return resolve(true);
        }

    });
}


function envioDators() {
    swal({
        title: "Atención!!",
        text: "Seguro desea guardar información?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((result) => {
        if (result) {
            saveecolaboradores();
        } else {
         swal("Operación cancelada", "Los datos no se han guardado", "info");
        }
    });
}


function saveecolaboradores() {

/*     var nombre = $("#nombre").val();
    var icono = $("#redes_sociales").val();
    var enlace = $("#enlace").val();

    $.ajax({
        type: "POST",
        method: "POST",
        url: "phpEnvioData/guardarRedSocial.php",
        data: 'nombre=' + nombre + '&icono=' + icono  + '&enlace=' + enlace,
        success: function(data) {
            $('#result-ecolaboracion').fadeIn(1000).html(data);
            closenewColaboracion(); 
            cargarempcolaboradora(); 
        },
        error: function(error) {
            swal("Guardada!", "Error al Guardar Red Social", "error");
        }
    }); */


        var formData = new FormData($("#formColaboracion")[0]);
    console.log("Enviando datos con archivos via AJAX EMMPRESA...");
    
    $.ajax({
        type: "POST",
        dataType: 'JSON',
        url: 'phpEnvioData/validadato.php?dato=6',
        data: formData,
        contentType: false, 
        processData: false, 
        success: function(data) {
            console.log("Respuesta recibida:", data);
            if(data.statusCode == 200){
                // Validamos si PHP nos avisó que el archivo fue renombrado por repetición
                if(data.renombrado) {
                    swal("¡Aviso importante!", "Ya existía un archivo con ese nombre en la carpeta. Por seguridad se guardó automáticamente como: " + data.nombre_nuevo, "info");
                } else {
                    swal("¡Éxito!", "Datos Actualizados Correctamente", "success");
                }
                
                // ELIMINADO: Ya no se recarga la página automáticamente aquí.
                // Si deseas actualizar la miniatura visualmente al instante sin recargar, 
                // puedes llamar a cargarDatosConfiguracion() aquí abajo:
                cargarempcolaboradora();

            } else {
                // Si hubo un error controlado (como fallo al mover archivo) se muestra por swal
                let mensajeError = data.error || data.error_sql || "No se pudo Guardar en la base de datos";
                swal({
                    title: "Error",
                    text: mensajeError,
                    type: "error",
                    timer: 5000, 
                    showConfirmButton: false 
                });
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            swal("Error crítico", "Error en la petición AJAX", "error");
        }
    });

}

function inicializarTabla() {
    // Verificamos si ya existe para destruirla de forma segura o usamos destroy: true
    if ($.fn.DataTable.isDataTable('#myTablecol')) {
        $('#myTablecol').DataTable().destroy();
    }

    $('#myTablecol').DataTable({
        pageLength: 5,
        lengthMenu: [[5, 10, 25, 50, -1], [5, 10, 25, 50, "Todos"]],
        responsive: true,
        destroy: true, // <-- Esto permite recrear la tabla sin que se rompa al actualizar por AJAX
        pagingType: "full_numbers",
        
        order: [],

        language: {
            "processing": "Procesando...",
            "lengthMenu": "Mostrar _MENU_ registros",
            "zeroRecords": "No se encontraron resultados",
            "emptyTable": "Ningún dato disponible en esta tabla",
            "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
            "search": "Buscar:",
            "loadingRecords": "Cargando...",
            "paginate": {
                "first": "«",
                "last": "»",
                "next": ">",
                "previous": "<"
            },
            "aria": {
                "sortAscending": ": Activar para ordenar la columna de manera ascendente",
                "sortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        }
    });
}

//EDITAR Colaboradores

/* 
async function validaEditarRedSocial() {
console.log("hice click EDIT");
    await this.validaeditDatos(0).then(resp => {
        if (resp) {
            setTimeout(function() {
                envioeditDators();
            }, 1500);
        }
    });
}

function validaeditDatos(action) {
    var nombre = $("#nombreedit").val();
    var icono = $("#redes_socialesedit").val();
    var enlace = $("#enlaceedit").val();

    return new Promise((resolve, reject) => {

        if (nombre == "" || nombre == null) {
            $("#nombreedit").focus();
            toastr.error("Ingrese el nombre de la red social");
            return resolve(false);
        } 
        else if (icono == "" || icono == null) {
           
            $('#redes_socialesedit').select2('open'); 
            toastr.error("Seleccione un icono");
            return resolve(false);
        } 
        else if (enlace == "" || enlace == null) {
            $("#enlaceedit").focus();
            toastr.error("Ingrese el enlace web");
            return resolve(false);
        } 
        else {
            return resolve(true);
        }

    });
}


function envioeditDators() {
    swal({
        title: "Atención!!",
        text: "Seguro deseas editar la información?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((result) => {
        if (result) {
            editRedSocialenvio();
        } else {
         swal("Operación cancelada", "Los datos no se han guardado", "info");
        }
    });
}


function editRedSocialenvio() {
    var id = $("#idEditsocialM").val();
    var nombre = $("#nombreedit").val();
    var icono = $("#redes_socialesedit").val();
    var enlace = $("#enlaceedit").val();

    $.ajax({
        type: "POST",
        method: "POST",
        url: "phpEnvioData/editarRedSocial.php",
        data: 'nombre=' + nombre + '&icono=' + icono  + '&enlace=' + enlace + '&id=' + id,
        success: function(data) {
            $('#result-redsocialEdit').fadeIn(1000).html(data);
           
            closeEditRedSocial(); 
            cargarempcolaboradora();
        },
        error: function(error) {
            swal("Editada!", "Error al Editar Red Social", "error");
        }
    });

} */