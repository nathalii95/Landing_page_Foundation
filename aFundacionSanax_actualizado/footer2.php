<?php
 include_once('conexion.php');
// Consultamos los datos de configuración para el footer (ej. ID 1)
$res_config = $con->query("SELECT * FROM header_config WHERE id_header_config = 1");
$config = $res_config->fetch_assoc();
?>
   <footer id="idFooter">
        <div id="contenedor8" >
                <div id="izquierda8">
                    <div class="one8">
                        <h3><?php echo mb_strtoupper(htmlspecialchars($config['titulo'], ENT_QUOTES, 'UTF-8')); ?></h3>
                        <h6 class="footerspan"><?php echo htmlspecialchars($config['slogan'], ENT_QUOTES, 'UTF-8'); ?></h6>
                        <p class="footerparref"><?php echo nl2br(htmlspecialchars($config['descripcion'], ENT_QUOTES, 'UTF-8')); ?></p>
                    </div>
                    <div class="two8">
                        <h3>cvcvINFORME:</h3>
                        <p class="footerparref" ><i class="fa-solid fa-thumbtack"></i> <?php echo nl2br(htmlspecialchars($config['ubicacion'], ENT_QUOTES, 'UTF-8')); ?></p>
                        <p class="footerparref"><i class="fa-solid fa-phone"></i>  <?php echo htmlspecialchars($config['telefono'], ENT_QUOTES, 'UTF-8'); ?></p>
                        <p class="footerparref"><i class="fa-solid fa-envelope"></i>  <?php echo htmlspecialchars($config['correo'], ENT_QUOTES, 'UTF-8'); ?></p>
                    </div>
                </div>
                <div id="abajo8">
                  <div id="izquierda9">
                      <p> © 2024 <?php echo mb_strtoupper(htmlspecialchars($config['titulo'], ENT_QUOTES, 'UTF-8')); ?> Todos los derechos reservados</p>
                  </div>
                  <div id="derecha9">
                      <h1>POWERED BY Nathaly Uvidia</h1>
                  </div>
                </div>
          </div>
          <a id="scroll-to-top-button" href="#" ><span></span></a>
    </footer>