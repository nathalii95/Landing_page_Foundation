<?php
error_reporting(0);
ini_set('display_errors', 0);
$datVariable = $_REQUEST['dato'];
$arreglo = array();

switch ($datVariable) { 
case 1:
    include_once("conexion.php");
    
    $titulo      = isset($_POST['titulo']) ? $con->real_escape_string($_POST['titulo']) : '';
    $slogan      = isset($_POST['slogan']) ? $con->real_escape_string($_POST['slogan']) : '';
    $descripcion = isset($_POST['descripcion']) ? $con->real_escape_string($_POST['descripcion']) : '';
    $ubicacion   = isset($_POST['ubicacion']) ? $con->real_escape_string($_POST['ubicacion']) : '';
    $telefono    = isset($_POST['telefono']) ? $con->real_escape_string($_POST['telefono']) : '';
    $correo      = isset($_POST['correo']) ? $con->real_escape_string($_POST['correo']) : '';

    $logo_sql = "";
    $debug_file = "";
    $error_subida = false;
    $archivo_renombrado = false;
    $nombre_final_archivo = "";

    // Validar si el usuario seleccionó un archivo nuevo
    if (isset($_FILES['logo']) && $_FILES['logo']['error'] !== UPLOAD_ERR_NO_FILE) {
        $error_code = $_FILES['logo']['error'];
        
        if ($error_code === UPLOAD_ERR_OK) {
            $nombre_original = $_FILES['logo']['name'];
            $ruta_temporal   = $_FILES['logo']['tmp_name'];
            $carpeta_destino = "../imagenesadmin/";
            
            // Asegurarse de que la carpeta exista
            if (!is_dir($carpeta_destino)) {
                mkdir($carpeta_destino, 0777, true);
            }
            
            $nombre_archivo = $nombre_original;
            $ruta_final = $carpeta_destino . basename($nombre_archivo);
            
            // SI EL ARCHIVO YA EXISTE, CAMBIAMOS EL NOMBRE AUTOMÁTICAMENTE
            if (file_exists($ruta_final)) {
                $nombre_archivo = time() . "_" . $nombre_original;
                $ruta_final = $carpeta_destino . basename($nombre_archivo);
                $archivo_renombrado = true;
            }
            
            if (move_uploaded_file($ruta_temporal, $ruta_final)) {
                $logo_relativo = $nombre_archivo; 
                $nombre_final_archivo = $nombre_archivo;
                $logo_sql = ", logo = '$logo_relativo'";
            } else {
                $error_subida = true;
                $debug_file = "Fallo al mover el archivo físico a la carpeta imagenesadmin";
            }
        } else {
            $error_subida = true;
            $debug_file = "Error en la subida del archivo, código: " . $error_code;
        }
    }

    // Si hubo un error al subir la imagen
    if ($error_subida) {
        $arreglo = array("statusCode" => 201, "error" => $debug_file);
        echo json_encode($arreglo);
        mysqli_close($con);
        break;
    }

    // Construcción del SQL
    $sql = "UPDATE header_config SET 
                titulo = '$titulo', 
                slogan = '$slogan', 
                descripcion = '$descripcion', 
                ubicacion = '$ubicacion', 
                telefono = '$telefono', 
                correo = '$correo' 
                $logo_sql 
            WHERE id_header_config = 1";

    if (mysqli_query($con, $sql)) {
        $arreglo = array(
            "statusCode" => 200, 
            "renombrado" => $archivo_renombrado, 
            "nombre_nuevo" => $nombre_final_archivo
        );
    } else {
        $arreglo = array("statusCode" => 201, "error_sql" => mysqli_error($con));
    }
    
    echo json_encode($arreglo);
    mysqli_close($con);
break;

case 2:
    include_once("conexion.php");
    $query = "SELECT * FROM header_config WHERE id_header_config = 1";
    
    $res = $con->query($query);
    
    if ($res && $res->num_rows > 0) {
        $row = $res->fetch_assoc();
        echo json_encode(array("statusCode" => 200, "data" => $row));
    } else {
        echo json_encode(array("statusCode" => 201, "error" => "No se encontraron datos"));
    }
    mysqli_close($con);
break;
case 3:
    include_once("conexion.php");
    $query = "SELECT * FROM social_media WHERE estado = 1";
    $res = $con->query($query);
    
    if ($res && $res->num_rows > 0) {
        $rows = $res->fetch_all(MYSQLI_ASSOC);
        echo json_encode(array("statusCode" => 200, "data" => $rows));
    } else {
        echo json_encode(array("statusCode" => 201, "error" => "No se encontraron datos"));
    }
    mysqli_close($con);
break;
        case 4:
            include ('conexion.php');
            $idreds = $_REQUEST['idSocial'];
             $query = "SELECT * from social_media where id_social_media  = '" . $idreds . "'";
             $res=$con->query($query);
             $rows = $res->fetch_all(MYSQLI_ASSOC);
             echo json_encode($rows);
        break;
        case 5:
            include_once("conexion.php");
            $query = "SELECT * FROM empresa_colaboradoras WHERE estado = 1";
            $res = $con->query($query);
            
            if ($res && $res->num_rows > 0) {
                $rows = $res->fetch_all(MYSQLI_ASSOC);
                echo json_encode(array("statusCode" => 200, "data" => $rows));
            } else {
                echo json_encode(array("statusCode" => 201, "error" => "No se encontraron datos"));
            }
            mysqli_close($con);
        break;

case 6:
            include_once("conexion.php");
            
            $nombre       = isset($_POST['nombre']) ? $con->real_escape_string($_POST['nombre']) : '';
            $logo_nombre = "";
            $debug_file = "";
            $error_subida = false;
            $archivo_renombrado = false;
            $nombre_final_archivo = "";

            // Validar si el usuario seleccionó un archivo nuevo
            if (isset($_FILES['inputLogo']) && $_FILES['inputLogo']['error'] !== UPLOAD_ERR_NO_FILE) {
                $error_code = $_FILES['inputLogo']['error'];
                
                if ($error_code === UPLOAD_ERR_OK) {
                    $nombre_original = $_FILES['inputLogo']['name'];
                    $ruta_temporal   = $_FILES['inputLogo']['tmp_name'];
                    $carpeta_destino = "../imagenesadmin/";
                    
                    // Asegurarse de que la carpeta exista
                    if (!is_dir($carpeta_destino)) {
                        mkdir($carpeta_destino, 0777, true);
                    }
                    
                    $nombre_archivo = $nombre_original;
                    $ruta_final = $carpeta_destino . basename($nombre_archivo);
                    
                    // SI EL ARCHIVO YA EXISTE, CAMBIAMOS EL NOMBRE AUTOMÁTICAMENTE
                    if (file_exists($ruta_final)) {
                        $nombre_archivo = time() . "_" . $nombre_original;
                        $ruta_final = $carpeta_destino . basename($nombre_archivo);
                        $archivo_renombrado = true;
                    }
                    
                    if (move_uploaded_file($ruta_temporal, $ruta_final)) {
                        $logo_nombre = $nombre_archivo; 
                        $nombre_final_archivo = $nombre_archivo;
                    } else {
                        $error_subida = true;
                        $debug_file = "Fallo al mover el archivo físico a la carpeta imagenesadmin";
                    }
                } else {
                    $error_subida = true;
                    $debug_file = "Error en la subida del archivo, código: " . $error_code;
                }
            }

            // Si hubo un error al subir la imagen
            if ($error_subida) {
                $arreglo = array("statusCode" => 201, "error" => $debug_file);
                echo json_encode($arreglo);
                mysqli_close($con);
                break;
            }

            // Construcción correcta del SQL para inserción
            $sql = "INSERT INTO empresa_colaboradoras (id_empresa_colaboradoras, nombre_empresa, logo_empresa, estado, created_at, updated_at) 
                    VALUES (NULL, '$nombre', '$logo_nombre', '1', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)";  

            if (mysqli_query($con, $sql)) {
                $arreglo = array(
                    "statusCode" => 200, 
                    "renombrado" => $archivo_renombrado, 
                    "nombre_nuevo" => $nombre_final_archivo
                );
            } else {
                $arreglo = array("statusCode" => 201, "error_sql" => mysqli_error($con));
            }
            
            echo json_encode($arreglo);
            mysqli_close($con);
        break;
        case 7:
            include ('conexion.php');
            $idemp_colab = $_REQUEST['idempresacolab'];
             $query = "SELECT * from empresa_colaboradoras where id_empresa_colaboradoras   = '" . $idemp_colab . "'";
             $res=$con->query($query);
             $rows = $res->fetch_all(MYSQLI_ASSOC);
             echo json_encode($rows);
        break;

        default:
        echo ("no hay datos");
        break;

}


/* 
function guardarDetalleCotizacion($sql){
  include('conexion.php');
  $result = mysqli_query($con,$sql);
  print json_encode($result);
} */
?>

