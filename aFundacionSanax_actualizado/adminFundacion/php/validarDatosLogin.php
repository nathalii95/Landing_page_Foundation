<script>
toastr.options = {
  "closeButton": true,
  "debug": false,
  "newestOnTop": false,
  "progressBar": true,
  "positionClass": "toast-top-center",
  "preventDuplicates": false,
  "onclick": null,
  "showDuration": "300",
  "hideDuration": "1000",
  "timeOut": "5000",
  "extendedTimeOut": "1000",
  "showEasing": "swing",
  "hideEasing": "linear",
  "showMethod": "fadeIn",
  "hideMethod": "fadeOut"
}
function limpiarCampos(){
    $("#usuario").val('');
	$("#contrasena").val('');
}
</script>
<?php
require "conexion.php";
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    if (!isset($_POST['usuario']) || !isset($_POST['contrasena'])) {
        echo '<script>swal("Error!", "Faltan datos en el formulario", "error");</script>';
        exit();
    }

    $usuario = $con->real_escape_string($_POST['usuario']);
    $password = $_POST['contrasena'];

    $sql = "SELECT e.id_empleado, e.contrasena, e.usuario, e.fk_cargo, c.cargo, e.estado
            FROM empleado e
            LEFT JOIN cargo c ON e.fk_cargo = c.id_cargo
            WHERE e.usuario = '$usuario' AND e.estado = 1";

    $resultado = $con->query($sql);

    if ($resultado && $resultado->num_rows > 0) {
        $row = $resultado->fetch_assoc();
        $password_bd = $row['contrasena']; 

        // Valida mediante hash seguro O mediante texto plano directo por compatibilidad
        $acceso_valido = password_verify($password, $password_bd) || ($password === $password_bd);

        if ($acceso_valido) {
            
            $_SESSION['id_empleado'] = $row['id_empleado'];
            $_SESSION['cargo'] = isset($row['cargo']) ? $row['cargo'] : 'Administrador';
            $_SESSION['usuario'] = $row['usuario'];
            $_SESSION['fk_cargo'] = $row['fk_cargo'];

            echo '<script>   
                swal({
                    title: "Atención!!",
                    text: "Bienvenido al Sistema",
                    icon: "success",
                    button: "Aceptar",
                }).then((value) => {
                    window.location.href = "./envio/index.php";
                });
            </script>';

        } else {
            echo '<script>
                swal("Error!", "Contraseña Incorrecta", "error");
                $("#contrasena").val("");
            </script>';
        }

    } else {
        echo '<script>
            swal("Error!", "Usuario No Existe o Inactivo", "error");
            limpiarCampos();
        </script>';
    }
}
$con->close();
?>