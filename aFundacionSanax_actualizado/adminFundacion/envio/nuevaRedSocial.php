
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

<div class="modal fade" id="redsocialNew" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-md">
    <div class="modal-content">
      
      <!-- Cabecera del Modal -->
      <div class="modal-header">
        <h5 class="modal-title" style="color:black;" > <i class="fa fa-comments" style=" color: #4B0C0C;"></i>  Nueva Red Social</h5>
        <i class="fa fa-times" onclick="closeNewRedSocial()" style="cursor: pointer; font-size:20px"></i>
      </div>
      <!-- Cuerpo del Modal -->
      <div class="modal-body">   
         <div  id="result-redsocial"></div>     
          <!-- Formulario adaptado limpiamente para ocupar el 100% responsivo -->
          <div class="form-group mb-3">
              <label class="font-weight-bold">Nombre</label>
              <input type="text" class="form-control form-control-sm" name="nombre" id="nombre" placeholder="Ej. Facebook, WhatsApp">
          </div>
          
          <div class="form-group mb-3">
              <label class="font-weight-bold">Icono</label>
              <!-- <select class="form-select form-select-sm" name="icono" id="icono">
                                <option value="" disabled selected>Seleccione un Icono</option>
                                <option value="fa fa-apple">Apple</option>
                                <option value="fa fa-behance">Behance</option>
                                <option value="fa fa-bitcoin">Bitcoin / BTC</option>
                                <option value="fa fa-dropbox">Dropbox</option>
                                <option value="fa fa-facebook">Facebook</option>
                                <option value="fa fa-git">Git</option>
                                <option value="fa fa-github">GitHub</option>
                                <option value="fa fa-google">Google</option>
                                <option value="fa fa-instagram">Instagram</option>
                                <option value="fa fa-linkedin">LinkedIn</option>
                                <option value="fa fa-linux">Linux</option>
                                <option value="fa fa-pinterest">Pinterest</option>
                                <option value="fa fa-reddit">Reddit</option>
                                <option value="fa fa-skype">Skype</option>
                                <option value="fa fa-slack">Slack</option>
                                <option value="fa fa-soundcloud">SoundCloud</option>
                                <option value="fa fa-spotify">Spotify</option>
                                <option value="fa fa-trello">Trello</option>
                                <option value="fa fa-tumblr">Tumblr</option>
                                <option value="fa fa-twitter">Twitter</option>
                                <option value="fa fa-wordpress">WordPress</option>
                                <option value="fa fa-whatsapp">Whatsapp</option>
                                <option value="fa fa-yahoo">Yahoo</option>
                                <option value="fa fa-youtube">YouTube</option>
                    </select> -->

                            <select name="redes_sociales" id="redes_sociales" class="form-control">
                                <option value="" disabled selected>Selecciona una red social</option>
                                <option value="fa fa-apple" data-icon="fa fa-apple">Apple</option>
                                <option value="fa fa-behance" data-icon="fa fa-behance">Behance</option>
                                <option value="fa fa-bitcoin" data-icon="fa fa-bitcoin">Bitcoin / BTC</option>
                                <option value="fa fa-dropbox" data-icon="fa fa-dropbox">Dropbox</option>
                                <option value="fa fa-facebook" data-icon="fa fa-facebook">Facebook</option>
                                <option value="fa fa-git" data-icon="fa fa-git">Git</option>
                                <option value="fa fa-github" data-icon="fa fa-github">GitHub</option>
                                <option value="fa fa-google" data-icon="fa fa-google">Google</option>
                                <option value="fa fa-instagram" data-icon="fa fa-instagram">Instagram</option>
                                <option value="fa fa-linkedin" data-icon="fa fa-linkedin">LinkedIn</option>
                                <option value="fa fa-linux" data-icon="fa fa-linux">Linux</option>
                                <option value="fa fa-pinterest" data-icon="fa fa-pinterest">Pinterest</option>
                                <option value="fa fa-reddit" data-icon="fa fa-reddit">Reddit</option>
                                <option value="fa fa-skype" data-icon="fa fa-skype">Skype</option>
                                <option value="fa fa-slack" data-icon="fa fa-slack">Slack</option>
                                <option value="fa fa-soundcloud" data-icon="fa fa-soundcloud">SoundCloud</option>
                                <option value="fa fa-spotify" data-icon="fa fa-spotify">Spotify</option>
                                <option value="fa fa-trello" data-icon="fa fa-trello">Trello</option>
                                <option value="fa fa-tumblr" data-icon="fa fa-tumblr">Tumblr</option>
                                <option value="fa fa-twitter" data-icon="fa fa-twitter">Twitter</option>
                                <option value="fa fa-wordpress" data-icon="fa fa-wordpress">WordPress</option>
                                <option value="fa fa-whatsapp" data-icon="fa fa-whatsapp">Whatsapp</option>
                                <option value="fa fa-yahoo" data-icon="fa fa-yahoo">Yahoo</option>
                                <option value="fa fa-youtube" data-icon="fa fa-youtube">YouTube</option>
                            </select>
          </div>
          
          <div class="form-group mb-1">
              <label class="font-weight-bold">Enlace</label>
              <input type="text" class="form-control form-control-sm" name="enlace" id="enlace" placeholder="https://...">
          </div>
      </div>

      <!-- Pie del Modal con botones de Purple Admin -->
      <div class="modal-footer">
        <button type="button" class="btn btn-light btn-sm" onclick="closeNewRedSocial()">Cerrar</button>
        <button type="button" class="btn btn-sm  px-4 py-2" style="background-color: #6A1919;color:white;" onclick="validaRegistroRedSocial()">   <i class="fa fa-save"></i>  Guardar</button>     
      </div>

    </div>
  </div>
</div>