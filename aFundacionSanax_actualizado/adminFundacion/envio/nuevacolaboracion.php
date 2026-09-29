
<style type="text/css">
 

@media (min-width: 1500px) {
     .modal-dialog {
       max-width: 70%;
     }
}

.l{
     font-weight: bold;
 }

 /* Forzar que Select2 ocupe todo el ancho y se muestre correctamente sobre el modal */
.select2-container {
    width: 100% !important;
    z-index: 99999 !important;
}
.select2-dropdown {
    z-index: 99999 !important;
}

</style>

<div class="modal fade" id="colaboracionNew" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-md">
    <div class="modal-content">
      
      <!-- Cabecera del Modal -->
      <div class="modal-header">
        <h5 class="modal-title" style="color:black;" > <i class="fa fa-building" style=" color: #4B0C0C;"></i>Nueva Empresa</h5>
        <i class="fa fa-times" onclick="closenewColaboracion()" style="cursor: pointer; font-size:20px"></i>
      </div>
      <!-- Cuerpo del Modal -->
      <div class="modal-body">   
          
        <form class="forms-sample" id="formColaboracion" enctype="multipart/form-data">   
          <div class="form-group mb-3">
              <label class="font-weight-bold">Nombre de la Empresa</label>
              <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Escriba el nombre de la Empresa">
          </div>
          
          <div class="form-group mb-3">
              <label class="font-weight-bold">Logo de la Empresa</label>
                    <input type="file" class="form-control" name="inputLogo" id="inputLogo" accept="image/*">
          </div>
        </form>
      </div>

      <!-- Pie del Modal con botones de Purple Admin -->
      <div class="modal-footer">
        <button type="button" class="btn btn-light btn-sm" onclick="closenewColaboracion()">Cerrar</button>
        <button type="button" class="btn btn-sm  px-4 py-2" style="background-color: #6A1919;color:white;" onclick="validaRegistroColaboracion()">   <i class="fa fa-save"></i>  Guardar</button>     
      </div>

    </div>
  </div>
</div>