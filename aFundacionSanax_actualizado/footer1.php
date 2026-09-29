<?php
 include_once('conexion.php');
// Consultamos las empresas colaboradoras activas
$resultado_empresas = $con->query("SELECT * FROM empresa_colaboradoras WHERE estado = 1");
// Consultamos los datos de configuración para el footer (ej. ID 1)
$res_config = $con->query("SELECT * FROM header_config WHERE id_header_config = 1");
$config = $res_config->fetch_assoc();
?>
<footer id="idFooter">
        <div class="contenedoCap">
                <div id="contcapc">
                    <div id="contCAP3">
                        <h2>EMPRESAS COLABORADORAS</h2>
                    </div>
                </div>
            
                <div class="contimg5">
                    <ul class="list-group list-group-horizontal">
                        <?php while ($empresa = $resultado_empresas->fetch_assoc()): ?>
                            <li class="list-group-item text-center font-weight-bold">
                                <img src="<?php echo './adminFundacion/envio/imagenesadmin/' . htmlspecialchars($empresa['logo_empresa'], ENT_QUOTES, 'UTF-8'); ?>"  
                                class="card-img-top" height="30" alt="<?php echo htmlspecialchars($empresa['nombre_empresa'], ENT_QUOTES, 'UTF-8'); ?>"> 
                                <?php echo htmlspecialchars($empresa['nombre_empresa'], ENT_QUOTES, 'UTF-8'); ?>
                            </li>
                        <?php endwhile; ?>
                    </ul>
                </div>
        </div>
            <div id="contenedor8">
                <div id="izquierda8">
                    <div class="one8">
                        <h3><?php echo mb_strtoupper(htmlspecialchars($config['titulo'], ENT_QUOTES, 'UTF-8')); ?></h3>
                        <?php if (!empty($config['slogan'])): ?>
                            <h6 class="footerspan"><?php echo htmlspecialchars($config['slogan'], ENT_QUOTES, 'UTF-8'); ?></h6>
                        <?php endif; ?>
                        <?php if (!empty($config['descripcion'])): ?>
                            <p class="footerparref"><?php echo nl2br(htmlspecialchars($config['descripcion'], ENT_QUOTES, 'UTF-8')); ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="two8">
                        <h3>INFORMES:</h3>
                        <?php if (!empty($config['ubicacion'])): ?>
                            <p class="footerparref"><i class="fa-solid fa-thumbtack"></i> <?php echo nl2br(htmlspecialchars($config['ubicacion'], ENT_QUOTES, 'UTF-8')); ?></p>
                        <?php endif; ?>
                        <?php if (!empty($config['telefono'])): ?>
                            <p class="footerparref"><i class="fa-solid fa-phone"></i> <?php echo htmlspecialchars($config['telefono'], ENT_QUOTES, 'UTF-8'); ?></p>
                        <?php endif; ?>
                        <?php if (!empty($config['correo'])): ?>
                            <p class="footerparref"><i class="fa-solid fa-envelope"></i> <?php echo htmlspecialchars($config['correo'], ENT_QUOTES, 'UTF-8'); ?></p>
                        <?php endif; ?>
                    </div>
                </div>
                <div id="abajo8">
                    <div id="izquierda9">
                        <p> © 2024 <?php echo htmlspecialchars($config['titulo'], ENT_QUOTES, 'UTF-8'); ?> Todos los derechos reservados</p>
                    </div>
                    <div id="derecha9">
                        <h1>POWERED BY NATHALY UVIDIA</h1>
                    </div>
                </div>
            </div>
        <a  href="https://api.whatsapp.com/send?phone=593989547363&text=Somos%20Fundaci%C3%B3n%20Sanax%20en%20breve%20un%20asistente%20te%20atendera%2C%20gracias" >
             <img id="scroll-to-top-button2" src="imagenes/whatsapp.png"> </a> 
          <a id="scroll-to-top-button" href="#" ><span> </span></a>
    </footer>
