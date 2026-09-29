<?php 
    include_once('conexion.php');    
    // Consultamos la configuración única
    $row = [];
    $query = "SELECT * FROM `header_config` WHERE estado = '1' LIMIT 1";
    $resultado = $con->query($query);

    if ($resultado && $resultado->num_rows > 0) {
        $row = $resultado->fetch_assoc();
    }

    $query_social = "SELECT * FROM `social_media` WHERE estado = '1'";
    $resultado_social = $con->query($query_social);

    // 1. Traemos todo lo que NO sea Contacto (Inicio, Nosotros, Servicios y opciones nuevas)
    $query_principal = "SELECT * FROM `menu_principal` WHERE LOWER(nombre_menu) != 'contacto' ORDER BY id_menu_principal ASC";
    $resultado_principal = $con->query($query_principal);

    // 2. Traemos exclusivamente a Contacto para garantizar que SIEMPRE sea el último
    $query_contacto = "SELECT * FROM `menu_principal` WHERE LOWER(nombre_menu) = 'contacto' LIMIT 1";
    $resultado_contacto = $con->query($query_contacto);

    $resultado_servicios = $con->query("SELECT * FROM servicios");

    // Consultamos el contenido del inicio usando los nombres de tus columnas
    $resultado_hero = $con->query("SELECT * FROM contenido_inicio WHERE estado = 1 LIMIT 1");
    $hero = $resultado_hero->fetch_assoc();

    // 1. Consultar sección NOSOTROS (ID 1)
    $res_nosotros = $con->query("SELECT * FROM quienes_somos WHERE id_quienes_somos = 1 AND estado = 1");
    $nosotros = $res_nosotros->fetch_assoc();

    // 2. Consultar sección MISIÓN (ID 2)
    $res_mision = $con->query("SELECT * FROM quienes_somos WHERE id_quienes_somos = 2 AND estado = 1");
    $mision = $res_mision->fetch_assoc();

    // 3. Consultar sección VISIÓN (ID 3)
    $res_vision = $con->query("SELECT * FROM quienes_somos WHERE id_quienes_somos = 3 AND estado = 1");
    $vision = $res_vision->fetch_assoc();

    // 4. Consultar sección OBJETIVOS (ID 4)
    $res_objetivos = $con->query("SELECT * FROM quienes_somos WHERE id_quienes_somos = 4 AND estado = 1");
    $objetivos = $res_objetivos->fetch_assoc();

    $res_estrcontacto = $con->query("SELECT * FROM contacto_estructura WHERE estado = 1 LIMIT 1");
    $estructurac = $res_estrcontacto->fetch_assoc();

?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include 'head1.php'; ?>
</head>
<body>
<?php include 'menuLateralVertical.php'; ?>
<?php include 'modalDonar.php'; ?>
<?php include 'modalHazteSocio.php'; ?>

    <header id="inicio">
        <div id="contenedor">
            <div id="izquierda">
                <img class="imglogo" src="<?php echo './adminFundacion/envio/imagenesadmin/' . htmlspecialchars($row['logo'], ENT_QUOTES, 'UTF-8'); ?>" width="65">
                <h1><?php echo htmlspecialchars($row['titulo']); ?></h1>
            </div>
            <div id="derecha">
                <ul class="lista2">
                    <?php 
                    if ($resultado_principal && $resultado_principal->num_rows > 0) {
                        while ($menu = $resultado_principal->fetch_assoc()) {
                            ?>
                            <li>
                                <a href="<?php echo htmlspecialchars($menu['enlace_ancla']); ?>">
                                    <?php echo htmlspecialchars($menu['nombre_menu']); ?>
                                </a>
                            </li>
                            <?php
                        }
                    }
                    
                    if ($resultado_contacto && $resultado_contacto->num_rows > 0) {
                        $contacto = $resultado_contacto->fetch_assoc();
                        ?>
                        <li>
                            <a href="<?php echo htmlspecialchars($contacto['enlace_ancla']); ?>">
                                <?php echo htmlspecialchars($contacto['nombre_menu']); ?>
                            </a>
                        </li>
                        <?php
                    }
                    ?>
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

<!--INICIO PRINCIPAL SECCION 1-->
        <div id="contenedor2" style="background-image: url('<?php echo htmlspecialchars($hero['imagen_fondo'], ENT_QUOTES, 'UTF-8'); ?>');">
            <div id="contpri3">
                <h2 class="contprimero"><?php echo htmlspecialchars($hero['eslogan'], ENT_QUOTES, 'UTF-8'); ?></h2>
                <p class="parraf"><?php echo htmlspecialchars($hero['subtitulo'], ENT_QUOTES, 'UTF-8'); ?></p>
                <span class="text-separation2">
                    <?php echo nl2br(htmlspecialchars($hero['descripcion'], ENT_QUOTES, 'UTF-8')); ?>
                </span>  
            </div> 
        </div>
        <svg id="svg-container" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#ffffff" fill-opacity="1" d="M0,160L40,181.3C80,203,160,245,240,234.7C320,224,400,160,480,160C560,160,640,224,720,229.3C800,235,880,181,960,181.3C1040,181,1120,235,1200,229.3C1280,224,1360,160,1400,128L1440,96L1440,320L1400,320C1360,320,1280,320,1200,320C1120,320,1040,320,960,320C880,320,800,320,720,320C640,320,560,320,480,320C400,320,320,320,240,320C160,320,80,320,40,320L0,320Z"></path></svg>
    </header>       
    <div id="quinessomos">
        <div id="contUl3">
            <h2><?php echo htmlspecialchars($nosotros['titulo'], ENT_QUOTES, 'UTF-8'); ?></h2>
            <span class="text-separation"><?php echo nl2br(htmlspecialchars($nosotros['descripcion'], ENT_QUOTES, 'UTF-8')); ?></span>
        </div>
    </div>

    <div id="contenedor5">
        <div id="contUl52">
            
            <!-- Misión -->
            <div class="contimg5">
                <?php if (!empty($mision['imagen_centro'])): ?>
                    <div class="imgdiv5">
                        <img src="<?php echo htmlspecialchars($mision['imagen_centro'], ENT_QUOTES, 'UTF-8'); ?>" alt="Misión">
                    </div>
                <?php endif; ?>
                <div class="divgallery">
                    <h2><?php echo htmlspecialchars($mision['titulo'], ENT_QUOTES, 'UTF-8'); ?></h2>
                    <span class="text-separation txet-mision"><?php echo nl2br(htmlspecialchars($mision['descripcion'], ENT_QUOTES, 'UTF-8')); ?></span>
                </div> 
            </div>

            <!-- Visión -->
            <div class="contimg5 top-salt">
                <?php if (!empty($vision['imagen_centro'])): ?>
                    <div class="imgdiv5">
                        <img src="<?php echo htmlspecialchars($vision['imagen_centro'], ENT_QUOTES, 'UTF-8'); ?>" alt="Visión">
                    </div>
                <?php endif; ?>
                <div class="divgallery">
                    <h2><?php echo htmlspecialchars($vision['titulo'], ENT_QUOTES, 'UTF-8'); ?></h2>
                    <span class="text-separation"><?php echo nl2br(htmlspecialchars($vision['descripcion'], ENT_QUOTES, 'UTF-8')); ?></span>
                </div> 
            </div>

        </div>
    </div>

    <div id="contenedor4" style="<?php echo !empty($objetivos['imagen_fondo']) ? "background-image:url('" . htmlspecialchars($objetivos['imagen_fondo'], ENT_QUOTES, 'UTF-8') . "');" : ""; ?>">
        <h2><?php echo htmlspecialchars($objetivos['titulo'], ENT_QUOTES, 'UTF-8'); ?></h2>
        <div id="contUl4">
            <span class="cont4span text-separation"><?php echo nl2br(htmlspecialchars($objetivos['descripcion'], ENT_QUOTES, 'UTF-8')); ?></span> 
        </div>
    </div>

    <section class="sectionbackindex">
        <p>&nbsp;&nbsp;</p>
    </section>

    <div id="servicios">
        <div id="contUl6">
            <h2>SERVICIOS</h2>
        </div>
        <div id="contUl62">
            <?php
            while($serv = $resultado_servicios->fetch_assoc()):
            ?>
                <div class="contimg5">
                    <div class="imgdiv5">
                        <img class="imgserv" src="<?php echo htmlspecialchars($serv['imagen_servicio'], ENT_QUOTES, 'UTF-8'); ?>" alt="Servicio">
                    </div>
                    <div class="divgallery">
                        <h6><?php echo htmlspecialchars($serv['nombre_servicio'], ENT_QUOTES, 'UTF-8'); ?></h6>
                    </div> 
                </div>
            <?php endwhile; ?>
        </div>
    </div>

    <div id="contenedor9">
        <div class="divgallery">
            <h2>Nuestro equipo está compuesto por profesionales comprometidos y voluntarios dedicados que trabajan con pasión y empeño para lograr nuestros objetivos y hacer una diferencia positiva en la vida de las personas más necesitadas.</h2>
        </div> 
    </div>

    <!-- SECCIONES EXTRAS CREADAS DESDE LA BASE DE DATOS -->
    <?php
    $query_extras_secciones = "
        SELECT m.enlace_ancla, s.* 
        FROM `menu_principal` m 
        INNER JOIN `secciones_contenido` s ON m.id_menu_principal = s.id_menu_principal 
        WHERE s.estado = 1 ";
    $res_extras = $con->query($query_extras_secciones);
    if ($res_extras && $res_extras->num_rows > 0) {
        while($extra = $res_extras->fetch_assoc()) {
            $idHtml = ltrim($extra['enlace_ancla'], '#');
            ?>
            <section id="<?php echo htmlspecialchars($idHtml); ?>" class="seccion-dinamica">
                <div class="contenedor" style="text-align: center; padding: 60px 20px;">
                    <h2><?php echo htmlspecialchars($extra['titulo_seccion']); ?></h2>
                    <h3><?php echo htmlspecialchars($extra['subtitulo']); ?></h3>
                    <p><?php echo nl2br(htmlspecialchars($extra['texto_principal'])); ?></p>
                    <div class="img-dinamica-container" style="max-width: 600px; margin: 20px auto;">
                        <img src="<?php echo htmlspecialchars($extra['imagen_centro']); ?>" style="width: 100%; height: auto; border-radius: 12px; display: block;" alt="Imagen de sección">
                    </div>
                </div>
            </section>
            <div class="contenedor9-separador">
                <div class="divgallery">
                </div> 
            </div>
            <?php
        }
    }
    ?>

    <div id="contacto">
        <div class="diccontfot"></div>
        <div class="diccontent">
            <div id="izquierda7">
                    <img src="<?php echo 'imagenes/' . htmlspecialchars($estructurac['logo'], ENT_QUOTES, 'UTF-8'); ?>" alt="Logo Fundación">
            </div>      
            <form action="fundacionsanax2021@gmail.com" method="POST"><br>
            <div id="derecha7">
                    <h2><?php echo htmlspecialchars($estructurac['titulo'] ?? '', ENT_QUOTES, 'UTF-8'); ?></h2><br><br>
                    <h6><?php echo htmlspecialchars($estructurac['descripcion'] ?? '', ENT_QUOTES, 'UTF-8'); ?></h6><br>
                    <input type="text" name="nombre" class="inputcontc" id="nombre" placeholder="Ingrese Nombre" required><br>
                    <input type="text" name="telefono" id="telefono" class="inputcontc" placeholder="Ingrese Teléfono" required><br>
                    <input type="email" name="email" id="email" class="inputcontc" placeholder="Ingrese Email" required><br>
                    <textarea class="inputcontc" name="mensaje" id="mensaje" placeholder="Ingrese Mensaje"></textarea><br>
                    <input type="submit" class="buttoncontact" value="Enviar" id="limpiarBtn"> 
                    <input type="hidden" name="_next" value="http://localhost/Landing_page_Foundation-master/index.html"> 
                    <input type="hidden" name="_captcha" value="false"> 
                </div> 
            </form> 
        </div>
    </div>

    <?php include 'footer1.php'; ?>
    <?php include 'scripstsPrincipales.php'; ?>
    
    <script>
    document.getElementById('telefono').addEventListener('input', function(event) {
        this.value = this.value.replace(/[^0-9]/g, '');
    });

    document.getElementById('limpiarBtn').addEventListener('click', function() {
        document.getElementById('contactForm').reset(); 
    });
    </script>
</body>    
</html>