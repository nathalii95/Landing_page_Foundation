<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include 'head.php'; ?>
  </head>
  <body>
    <div class="container-scroller">
      <?php include 'nav.php'; ?>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
        <?php include 'nav2.php'; ?>
        <div class="main-panel">
          <div class="content-wrapper" style="padding: 0.8rem 1.5rem;">
            <div class="row">
              <div class="col-lg-12 grid-margin stretch-card">
                <div class="card" style="margin-bottom: 5px;">
                  <div class="card-body" style="padding: 1rem 1.5rem;">
                    <h4 class="card-title mb-3" style="font-size: 1.1rem;"><i class="fa fa-building" style=" color: #b66dff;"></i> Datos Generales De La Fundación</h4>
                    
                    <form class="forms-sample" id="formConfiguracion" enctype="multipart/form-data">
                      <!-- Fila 1: Título y Eslogan -->
                      <div class="row">
                        <div class="col-md-6 form-group mb-3">  
                          <label for="inputTitulo" class="mb-2">Nombre de la Fundación</label>
                          <input type="text" class="form-control" id="inputTitulo" name="titulo">
                        </div>
                        <div class="col-md-6 form-group mb-3">
                          <label for="inputSlogan" class="mb-2">Eslogan o Frase Destacada:</label>
                          <input type="text" class="form-control" id="inputSlogan" name="slogan">
                        </div>
                      </div>

                      <!-- Fila 2: Correo y Teléfono -->
                      <div class="row">
                        <div class="col-md-6 form-group mb-3">
                          <label for="inputCorreo" class="mb-2">Correo electrónico:</label>
                          <input type="email" class="form-control" id="inputCorreo" name="correo" placeholder="Correo">
                        </div>
                        <div class="col-md-6 form-group mb-3">
                          <label for="inputTelefono" class="mb-2">Teléfono:</label>
                          <input type="text" class="form-control" id="inputTelefono" name="telefono" placeholder="Teléfono">
                        </div>
                      </div>

                      <!-- Fila 3: Ubicación y Descripción (Tamaño cómodo con rows="3") -->
                      <div class="row">
                        <div class="col-md-6 form-group mb-3">
                          <label for="inputUbicacion" class="mb-2">Ubicación / Ciudad:</label>
                          <textarea class="form-control" id="inputUbicacion" name="ubicacion" rows="4" style="padding: 8px 12px;"></textarea>
                        </div>
                        <div class="col-md-6 form-group mb-3">
                          <label for="inputDescripcion" class="mb-2">Descripción / Resumen:</label>
                          <textarea class="form-control" id="inputDescripcion" name="descripcion" rows="4" style="padding: 8px 12px;"></textarea>
                        </div>
                      </div>
                        
                      <!-- Fila 4: Logotipo y Botón Guardar -->
                      <div class="row align-items-center">  
                        <div class="col-md-8 form-group mb-1">
                          <label class="mb-1">Logotipo Actual:</label>
                          <!-- Se usa flex sin wrap para forzar que la imagen y el input vayan estrictamente lado a lado -->
                          <div style="border: 2px dashed #cbd5e1; padding: 10px 15px; border-radius: 6px; background-color: #f8fafc; display: flex; flex-wrap: nowrap; align-items: center; gap: 15px;">
                            <div style="flex-shrink: 0;">
                              <img id="imgLogoPreview" src="" alt="Logo Actual" style="width: 50px; height: 50px; object-fit: contain; background: #fff; border: 1px solid #ddd; padding: 3px; border-radius: 4px;">
                            </div>
                            <div style="flex-grow: 1;">
                              <p style="margin-bottom: 4px; font-size: 12px; color: #64748b;">Selecciona un nuevo archivo para reemplazar el logo:</p>
                              <input type="file" class="form-control-file" name="logo" id="inputLogo" accept="image/*">
                            </div>
                          </div>
                        </div>
                        
                        <div class="col-md-4 form-group mb-2 text-end d-flex align-items-right justify-content-end" style="min-height: 75px;">
                          <!-- Botón de Guardar -->
                          <button type="button" class="btn btn px-4 py-2" style="background-color: #6A1919;color:white;"  onclick="validaRegistroConfig()">
                            <i class="fa fa-save"></i> Guardar Cambios
                          </button>
                        </div>
                      </div>
                    </form>
                  </div>
                   <!-- partial:../../partials/_footer.html -->
                </div>
              </div>     </div><?php include 'footer.php'; ?>      
            </div>
         
          <!-- partial:../../partials/_footer.html -->
          <?php /* include 'footer.php'; */ ?>
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <?php include 'scripts.php'; ?>
    <script src="jsValidacion/configuracion.js"></script>
  </body>
</html>