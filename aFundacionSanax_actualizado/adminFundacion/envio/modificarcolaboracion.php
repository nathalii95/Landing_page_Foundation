
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

<div class="modal fade" id="modalEditColaborador" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-md">
    <div class="modal-content">
      
      <!-- Cabecera del Modal -->
      <div class="modal-header">
        <h5 class="modal-title" style="color:black;" > <i class="fa fa-comments" style=" color: #4B0C0C;"></i>  Editar Empresa Colaboradora</h5>
        <i class="fa fa-times" onclick="closeEditColaboracion()" style="cursor: pointer; font-size:20px"></i>
      </div>
      <!-- Cuerpo del Modal -->
      <div class="modal-body">   
         <div  id="result-redsocialEdit"></div>     
          <!-- Formulario adaptado limpiamente para ocupar el 100% responsivo -->
           <input type="hidden" id="idEditsocialM" >
          <div class="form-group mb-3">
              <label class="font-weight-bold">Nombre de la Empresa</label>
              <input type="text" class="form-control" name="nombreedit" id="nombreedit" placeholder="Escriba el nombre de la Empresa">
          </div>
          
          <div class="form-group mb-3">
              <label class="font-weight-bold">Ligo de la Empresa</label>
                        <div class="mb-5" >
                            <div class="mb-3" >
                              <img id="imgLogoPreviewecolab" src="" alt="Logo Actual" style="width: 200px; height: 200px; object-fit: contain; background: #fff; border: 1px solid #ddd; padding: 3px; border-radius: 4px;">
                            </div>
                            <div style="flex-grow: 1;" class="mb-3">
                              <p style="margin-bottom: 4px; font-size: 12px; color: #64748b;">Selecciona un nuevo archivo para reemplazar el logo:</p>
                              <input type="file" class="form-control-file" name="logo" id="inputLogo" accept="image/*">
                            </div>
                          </div>
                            
          </div>
      </div>

      <!-- Pie del Modal con botones de Purple Admin -->
      <div class="modal-footer">
        <button type="button" class="btn btn-light btn-sm" onclick="closeEditColaboracion()">Cerrar</button>
        <button type="button" class="btn btn-sm px-4 py-2" style="background-color: #6A1919;color:white;" onclick="validaEditarRedSocial()"> <i class="fa fa-save"></i> Modificar</button>
      </div>

    </div>
  </div>
</div>    