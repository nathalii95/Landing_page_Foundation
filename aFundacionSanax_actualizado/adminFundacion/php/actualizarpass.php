<?php
require "conexion.php";

// Generamos el hash seguro de forma automática en el servidor
$password_nueva = "admin";
$hash_seguro = password_hash($password_nueva, PASSWORD_DEFAULT);

// Actualizamos la base de datos para el usuario admin
$sql = "UPDATE empleado SET contrasena = '$hash_seguro' WHERE usuario = 'admin'";

if ($con->query($sql) === TRUE) {
    echo "<h2 style='color: green; font-family: Arial;'>¡Contraseña actualizada con éxito!</h2>";
    echo "<p>Ya puedes <a href='index.php'>ir al login</a> e ingresar con:</p>";
    echo "<ul><li><b>Usuario:</b> admin</li><li><b>Contraseña:</b> admin</li></ul>";
} else {
    echo "Error al actualizar: " . $con->error;
}

$con->close();
?>