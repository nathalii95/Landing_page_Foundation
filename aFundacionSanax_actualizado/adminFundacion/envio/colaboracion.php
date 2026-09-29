<!DOCTYPE html>
<html lang="en">
  <head>
      <!-- CSS de Select2 -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />  
    <?php include 'head.php'; ?>

</head>
  <body>
    <div class="container-scroller">
      <?php include 'nav.php'; ?>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
        <?php include 'nav2.php'; ?>
        <?php include ('nuevacolaboracion.php');?> 
        <?php include ('modificarcolaboracion.php');?> 
        <div class="main-panel">
          <div class="content-wrapper" style="padding: 0.8rem 1.5rem;">
            <div class="row">
              <div class="col-lg-12 grid-margin stretch-card">
                <div class="card" style="margin-bottom: 5px;">
                  <div class="card-body" style="padding: 1rem 1.5rem;">
                    <h4 class="card-title mb-3" style="font-size: 1.1rem;"><i class="fa fa-building" style=" color: #4B0C0C;"></i> Empresas Colaboradoras Con La Fundación</h4>
                    <p class="card-description"><button type="button" class="btn btn-gradient-warning"  onclick="newColaboracion()" > <i class="fa fa-plus"></i>&nbsp;&nbsp;Nuevo Colaborador</button></p>
                    <div class="table-responsive">
                    <table class="table table-striped table-bordered" id="myTablecol" style="width:100%">
                        <thead>
                            <tr style="text-align: center;">
                                <th style="background-color: #6A1919 !important; color: white;"> Nombre Empresa </th>
                                <th style="background-color: #6A1919 !important; color: white;"> Logo Empresa </th>
                                <th style="background-color: #6A1919 !important; color: white;"> Acciones </th> <!-- Opcional: para editar/eliminar cada red -->
                            </tr>
                        </thead>
                        <tbody id="tablaColaboradores">
                       
                        </tbody>
                    </table>
                    </div>

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
    
    <!-- jQuery (necesario para Select2 clásico) y JS de Select2 -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="jsValidacion/colaboradores.js"></script>
<script>
    $(document).ready(function() {
        // Función para renderizar los iconos con formato HTML dentro de Select2
        function formatesIcons(option) {
            if (!option.id) {
                return option.text;
            }
            var $option = $(option.element);
            var iconClass = $option.data('icon');
            if (!iconClass) {
                return option.text;
            }
            // Retorna el icono de Font Awesome junto al texto de la opción
            var $iconSpan = $('<span><i class="' + iconClass + '"></i> ' + option.text + '</span>');
            return $iconSpan;
        }
        
    });
</script>
  </body>
</html>