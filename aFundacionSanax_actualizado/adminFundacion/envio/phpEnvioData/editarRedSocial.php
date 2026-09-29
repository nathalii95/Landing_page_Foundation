<script>
toastr.options = {
  "closeButton": true,
  "debug": false,
  "newestOnTop": false,
  "progressBar": true,
  "positionClass": "toast-top-center",
  "preventDuplicates": false,
  "onclick": null,
  "showDuration": "300",
  "hideDuration": "1000",
  "timeOut": "5000",
  "extendedTimeOut": "1000",
  "showEasing": "swing",
  "hideEasing": "linear",
  "showMethod": "fadeIn",
  "hideMethod": "fadeOut"
}</script>
<?php

	require "conexion.php";
	
	/* session_start(); */
	
	if($_POST){
		
        $id = $_POST['id'];
		$nombre = $_POST['nombre'];
        $icono = $_POST['icono'];
	    $enlace = $_POST['enlace'];
       
        $data =  mysqli_query($con, "UPDATE social_media set  nombre = '$nombre', enlace = '$enlace', icono = '$icono',  estado = '1'  where id_social_media = '$id'");

if(isset($data)){

                echo '<script>swal("Actualizar", "Actualización Exitosa", "success");
                       setTimeout(function() {
                          window.location.href="redsocial.php"
                      }, 2000);</script> ';
           
    

}else{
    echo '<script>swal("Error!", "Incorrecto, Error Actualizar Cargos", "error");
    setTimeout(function() {
       window.location.href="redsocial.php"
   }, 2000);</script> ';
}

		
	}
	
	
	
?>
