<?php
 include_once('conexion.php');
    $row = [];
    $query = "SELECT * FROM `header_config` WHERE estado = '1' LIMIT 1";
    $resultado = $con->query($query);

    if ($resultado && $resultado->num_rows > 0) {
        $row = $resultado->fetch_assoc();
    }

    $query_social = "SELECT * FROM `social_media` WHERE estado = '1'";
    $resultado_social = $con->query($query_social);
?>
  <header id="inicio">
        <div id="contenedor">
          <div id="izquierda">
            <img class="imglogo" src="<?php echo './imagenes/' . htmlspecialchars($row['logo'], ENT_QUOTES, 'UTF-8'); ?>" width="65">
            <h1><?php echo htmlspecialchars($row['titulo']); ?></h1>
          </div>
            <div id="derecha">
                
                <ul class="lista2">
                    <li><a href="index.php">Regresar al Inicio</a></li>
                </ul>
            </div>
            <div id="final">
                <ul class="lista3">
                    <?php 
                    if ($resultado_social && $resultado_social->num_rows > 0) {
                        while ($row_social = $resultado_social->fetch_assoc()) {
                            ?>
                            <li>
                                <a href="<?php echo htmlspecialchars($row_social['enlace']); ?>" target="_blank">
                                <i class="<?php echo htmlspecialchars($row_social['icono']); ?>" 
                                title="<?php echo htmlspecialchars($row_social['nombre']); ?>"></i>
                                </a>
                            </li>
                            <?php 
                        }
                    } 
                    ?>
                </ul>
            </div>
        </div>
    </header>