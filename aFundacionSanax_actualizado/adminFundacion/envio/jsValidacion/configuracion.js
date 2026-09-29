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
    "timeOut": "1000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut",
};

// Al cargar la página, traemos los datos actuales de la BD
$(document).ready(function() {
    cargarDatosConfiguracion();
});



function cargarDatosConfiguracion() {

    $.ajax({
        type: "Post",
        dataType: 'JSON',
        url:/* '/aFundacionSanax/adminFundacion/envio/phpEnvioData/validadato.php?dato=34', */
        'phpEnvioData/validadato.php?dato=' + 2,
        
        success: function(response) {
            if(response.statusCode == 200) {
                let d = response.data;
                // Rellenamos los inputs con lo que viene de la BD
                $("#inputTitulo").val(d.titulo);
                $("#inputSlogan").val(d.slogan);
                $("#inputCorreo").val(d.correo);
                $("#inputTelefono").val(d.telefono);
                $("#inputUbicacion").val(d.ubicacion);
                $("#inputDescripcion").val(d.descripcion);
                
                // Si existe el logo en la base de datos, lo mostramos en la miniatura
                if(d.logo) {
                    // Ajusta la ruta '../' o la que corresponda según dónde esté tu vista respecto a la carpeta imagenes
                    $("#imgLogoPreview").attr("src", "/aFundacionSanax/adminFundacion/envio/imagenesadmin/" + d.logo);
                } else {
                    $("#imgLogoPreview").attr("src", "/aFundacionSanax/adminFundacion/envio/imagenesadmin/" + d.logo); // Imagen por defecto si no hay
                }
            }
        },
        error: function(error) {
            console.log("Error al cargar la configuración");
        }
    });
}

async function validaRegistroConfig() {
       console.log("hice click");
    await this.validaRegistrosConfigDatos(0).then(resp => {
        if (resp) {
            setTimeout(function() {
                envioConfigDato();
            }, 500);
        }
    });
}

function validaRegistrosConfigDatos(action) {
    var titulo = $("#inputTitulo").val();
    var ubicacion = $("#inputUbicacion").val();

    return new Promise((resolve, reject) => {
        if (titulo == "") {
            $("#inputTitulo").focus();
            toastr.error("Ingrese el Título");
            return resolve(false);
        } else if (ubicacion == "") {
            $("#inputUbicacion").focus();
            toastr.error("Ingrese la Ubicación");
            return resolve(false);
        } else {
            return resolve(true);
        }
    });
}

function envioConfigDato() {
    swal({
        title: "¡Atención!",
        text: "¿Seguro desea actualizar la Información?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((result) => {
        if (result) {
            saveConfig();
        }
    });
}

function saveConfig() {
    var formData = new FormData($("#formConfiguracion")[0]);
    console.log("Enviando datos con archivos via AJAX...");
    
    $.ajax({
        type: "POST",
        dataType: 'JSON',
        url: 'phpEnvioData/validadato.php?dato=1',
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
                cargarDatosConfiguracion();

            } else {
                // Si hubo un error controlado (como fallo al mover archivo) se muestra por swal
                let mensajeError = data.error || data.error_sql || "No se pudo actualizar en la base de datos";
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