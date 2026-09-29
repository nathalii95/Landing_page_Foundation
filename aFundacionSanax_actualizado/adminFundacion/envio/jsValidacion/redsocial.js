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

// 1. Inicializaciones al cargar la página (¡Aquí va Select2 una sola vez!)
$(document).ready(function() {
    cargarRedSociales();

    // Función auxiliar para renderizar los iconos de Font Awesome en las opciones
    function formatesIcons(option) {
        if (!option.id) {
            return option.text;
        }
        var $iconSpan =$('<span><i class="' + option.id + '"></i> ' + option.text + '</span>');
        return $iconSpan;
    }

    // Inicializar Select2 para el modal de "Nueva Red Social"
    $('#redes_sociales').select2({
        dropdownParent: $('#redsocialNew'),
        templateResult: formatesIcons,
        templateSelection: formatesIcons
    });

    // Inicializar Select2 para el modal de "Editar Red Social"
    $('#redes_socialesedit').select2({
        dropdownParent: $('#modalEditRedSocial'),
        templateResult: formatesIcons,
        templateSelection: formatesIcons
    });
});

// Al cargar la página, traemos los datos actuales de la BD
/* $(document).ready(function() {
    cargarRedSociales();
}); */

function newRedSocial() {
    $('#redsocialNew').modal('show');

}

function closeNewRedSocial() {
    $('#redsocialNew').modal('hide');
    limpiarDatosguard();
}

function closeEditRedSocial() {
    $('#modalEditRedSocial').modal('hide');
}


function editRedSocial(idRedSocial){
 $('#modalEditRedSocial').modal('show');
   editPresentaInfo(idRedSocial);
   
}

function limpiarDatosguard(){
    var nombre = $("#nombre").val('');
    var enlace = $("#enlace").val('');
    $('#redes_sociales').val('').trigger('change');
}

function editPresentaInfo(idRedSocial){
        var idSocial = idRedSocial;
        $.ajax({
            type: "POST",
            method: "POST",
            dataType: 'JSON',
            url: 'phpEnvioData/validadato.php?dato=' + 4,
            data: 'idSocial=' + idSocial,
            success: function(data) {
 
            // Como PHP devuelve un array con un objeto dentro, usamos data[0]
                if(data && data.length > 0) {
                    var item = data[0];               
                    $('#idEditsocialM').val(item.id_social_media);
                    $('#nombreedit').val(item.nombre);
                    // Asignamos el valor al select y disparamos el evento change para que Select2 lo detecte
                    $('#redes_socialesedit').val(item.icono).trigger('change');
                    $('#enlaceedit').val(item.enlace);
                }
            }
        });
   
}



function cargarRedSociales() {
    $.ajax({
        type: "POST",
        dataType: 'JSON',
        url: 'phpEnvioData/validadato.php?dato=3',
        success: function(response) {
            let html = '';
            if(response.statusCode == 200) {
                let datos = response.data;

                // Recorremos cada red social encontrada en la base de datos
                datos.forEach(function(item) {
                    html += `<tr  >
                        <td style="text-align: left">${item.nombre}</td>
                        <td style="text-align: center"><i class="${item.icono}" style="font-size: 1.5rem;"></i></td>
                        <td style="max-width: 250px; word-break: break-all; white-space: normal;text-align: left">
                            <a href="${item.enlace}" target="_blank" style="font-size: 0.85rem;">${item.enlace}</a>
                        </td>
                        <td style="text-align: center">
                            <button type="button" class="btn btn-outline-dark btn-sm" onclick="editRedSocial(${item.id_social_media})" style="color:black;">
                                <i class="fa fa-pencil"></i> Editar
                            </button>
                        </td>
                    </tr>`;
                });
            } else {
               html = '<tr><td colspan="4" class="text-center">No hay redes sociales registradas</td></tr>';
            }
            // 1. Inyectamos el HTML dentro del tbody (o la tabla)
            $('#tablaRedesSociales').html(html);

            // 2. Inicializamos/Actualizamos DataTable con los nuevos datos cargados
            inicializarTabla();
        },
        error: function(error) {
            console.log("Error al cargar las redes sociales");
        }
    });
}



async function validaRegistroRedSocial() {
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
    var icono = $("#redes_sociales").val(); // Usando el ID correcto del select con Select2
    var enlace = $("#enlace").val();

    return new Promise((resolve, reject) => {

        if (nombre == "" || nombre == null) {
            $("#nombre").focus();
            toastr.error("Ingrese el nombre de la red social");
            return resolve(false);
        } 
        else if (icono == "" || icono == null) {
            // Para Select2 enfocamos el contenedor visual o abrimos el dropdown
            $('#redes_sociales').select2('open'); 
            toastr.error("Seleccione un icono");
            return resolve(false);
        } 
        else if (enlace == "" || enlace == null) {
            $("#enlace").focus();
            toastr.error("Ingrese el enlace web");
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
            saveRedSocial();
        } else {
         swal("Operación cancelada", "Los datos no se han guardado", "info");
         /*    location.reload(); */
        }
    });
}


function saveRedSocial() {

    var nombre = $("#nombre").val();
    var icono = $("#redes_sociales").val();
    var enlace = $("#enlace").val();

    $.ajax({
        type: "POST",
        method: "POST",
        url: "phpEnvioData/guardarRedSocial.php",
        data: 'nombre=' + nombre + '&icono=' + icono  + '&enlace=' + enlace,
        success: function(data) {
            $('#result-redsocial').fadeIn(1000).html(data);
            /* cargarRedSociales(); */
            closeNewRedSocial(); // Opcional: cierra el modal tras guardar
            cargarRedSociales(); // Recarga la tabla con los nuevos datos
        },
        error: function(error) {
            swal("Guardada!", "Error al Guardar Red Social", "error");
        }
    });

}

function inicializarTabla() {
    // Verificamos si ya existe para destruirla de forma segura o usamos destroy: true
    if ($.fn.DataTable.isDataTable('#myTable')) {
        $('#myTable').DataTable().destroy();
    }

    $('#myTable').DataTable({
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

//EDITAR RED SOCIALES


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
    var icono = $("#redes_socialesedit").val(); // Usando el ID correcto del select con Select2
    var enlace = $("#enlaceedit").val();

    return new Promise((resolve, reject) => {

        if (nombre == "" || nombre == null) {
            $("#nombreedit").focus();
            toastr.error("Ingrese el nombre de la red social");
            return resolve(false);
        } 
        else if (icono == "" || icono == null) {
            // Para Select2 enfocamos el contenedor visual o abrimos el dropdown
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
         /*    location.reload(); */
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
            /* cargarRedSociales(); */
            closeEditRedSocial(); // Opcional: cierra el modal tras editar
            cargarRedSociales(); // Recarga la tabla con los nuevos datos
        },
        error: function(error) {
            swal("Editada!", "Error al Editar Red Social", "error");
        }
    });

}