<?php

session_start();

	global $playini;
	$playini = 1;

	//require 'Inclu/error_hidden.php';
	require 'Inclu/Admin_head.php';
	require 'Inclu/mydni.php';

	require 'Conections/conection.php';
	require 'Conections/conect.php';
	require 'Inclu/my_bbdd_clave.php';

	unset($_SESSION['usuarios']);

	
				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////


				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////


				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	?>
	
 					<!-- *************************** -->
<!-- *************************** -->		<!-- *************************** -->
					<!-- *************************** -->
	
 <div id="Caja2Admin" style="text-align: center">
	  
   	<div style="margin-top:4px; margin-bottom: 4px; text-align:center">
		<a href="index.php">CANCELAR Y VOLVER AL INICIO.</a>
	</div>
	
					<!-- *************************** -->
<!-- *************************** -->		<!-- *************************** -->
					<!-- *************************** -->
	
	
					<!-- *************************** -->
<!-- *************************** -->		<!-- *************************** -->
					<!-- *************************** -->
	
	
	<div>
		<!-- IMPRIME EL VALOR DEL ESCANEO PERO
			LO PASAMOS GET EN EL METODO WINDOW.LOCATION.HREF -->
		<span id="dbr"></span>
	</div>
	
  <div class="select" style="padding-bottom: 4px">
    	<label for="videoSource">V. SOURCE: </label>
	  	<select id="videoSource"></select>
  </div>
	 
	<div style="clear:both"></div>	
	 
  <button id="go" style="font-size: 14px;">PLAY SCANNER QR CODE</button>
	 
	<div style="clear:both"></div>
	 
  <div >
   <!-- <video class='camara' muted autoplay id="video" playsinline="true"></video>
	-->
    <video muted autoplay id="video" playsinline="true"  style="width: 433px; height: 324px; padding-top: 8px"></video>
	
	<!-- DEFINIENDO EL VALOR A 0 OCULTO LA VENTANA DE CAPTURA -->
   	<!-- <canvas id="pcCanvas" width="640" height="480" style="display: none; float: bottom;"></canvas> -->
   	<canvas id="pcCanvas" width="0" height="0" style="display: none; float: bottom;"></canvas>
   	<!-- <canvas id="mobileCanvas" width="240" height="320" style="display: none; float: bottom;"></canvas> -->
	<canvas id="mobileCanvas" width="0" height="0" style="display: none; float: bottom;"></canvas>
  </div>

	  
					<!-- *************************** -->
<!-- *************************** -->		<!-- *************************** -->
					<!-- *************************** -->
	
	
					<!-- *************************** -->
<!-- *************************** -->		<!-- *************************** -->
					<!-- *************************** -->
	
	  
</div>
  
<div style="clear:both"></div>

</div>


</body>


					<!-- *************************** -->
<!-- *************************** -->		<!-- *************************** -->
					<!-- *************************** -->
	
	
					<!-- *************************** -->
<!-- *************************** -->		<!-- *************************** -->
					<!-- *************************** -->
	


<script async src="cam/zxing.js"></script>
<script src="cam/video.js"></script>

					<!-- *************************** -->
<!-- *************************** -->		<!-- *************************** -->
					<!-- *************************** -->
	
	
					<!-- *************************** -->
<!-- *************************** -->		<!-- *************************** -->
					<!-- *************************** -->
	
<?php	
					////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	require 'Inclu/Admin_Inclu_footer.php';
	
				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

/* Creado por Juan Barros Pazos 2021 */
?>

</html>
