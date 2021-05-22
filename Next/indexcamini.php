<?php

session_start();

	//require 'Inclu/error_hidden.php';
	require 'Inclu/Inclu_Menu_qr.php';
	require 'Inclu/misdatos.php';
	require 'Inclu/mydni.php';

	require 'Conections/conection.php';
	require 'Conections/conect.php';
	require 'Inclu/my_bbdd_clave.php';

	unset($_SESSION['usuarios']);

	
				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////
	/*
	require '$_SESSION['menu'].'/rutaindex.php';
	require '$_SESSION['menu'].'/Master_Index.php';
	*/

if(isset($_POST['ocultop'])){
		if($form_errorsp = validate_formp()){
							show_form2($form_errorsp);
								} else {process_pin();
										} 
						}
	else{show_form2();}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function process_pin(){
	
	global $phppin;
	$phppin = $_POST['pin'];
	global $redir;
	$redir = "<script type='text/javascript'>
					function redir(){
					window.location.href='indexqr.php?pin='+$phppin;
				}
				setTimeout('redir()',1000);
			</script>";
	print ($redir);
}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function validate_formp(){
	
	global $db;
	global $db_name;

	global $table_name_a;
	$table_name_a = "`".$_SESSION['clave']."admin`";

	$sqlp =  "SELECT * FROM `$db_name`.$table_name_a WHERE $table_name_a.`dni` = '$_POST[pin]' ";
	$qp = mysqli_query($db, $sqlp);
	$cp = mysqli_num_rows($qp);
	
	$errorsp = array();
	
	if (strlen(trim($_POST['pin'])) == 0){
		$errorsp [] = "PIN: Campo obligatorio.";
		}

	elseif (strlen(trim($_POST['pin'])) < 8){
		$errorsp [] = "PIN: Incorrecto.";
		}

	elseif (strlen(trim($_POST['pin'])) > 8){
		$errorsp [] = "PIN: Incorrecto.";
		}

	elseif (!preg_match('/^[A-Z\d]+$/',$_POST['pin'])){
		$errorsp [] = "PIN: Incorrecto.";
		}
	
	/*
	elseif (!preg_match('/^[^a-z@´`\'áéíóú#$&%<>:"·\(\)=¿?!¡\[\]\{\};,\/:\.\*]+$/',$_POST['pin'])){
		$errors [] = "PIN: Incorrecto.";
		}

	elseif (!preg_match('/^[^a-z]+$/',$_POST['pin'])){
		$errors [] = "PIN: Incorrecto.";
		}*/
	
	elseif($cp == 0){
		$errorsp [] = "PIN: Incorrecto.";
		}

	return $errorsp;

		}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function show_form2($errorsp=''){
	
	if(isset($_POST['pin'])){
		$defaults = $_POST;
		} else {$defaults = array ('pin' => '');}
	
	if ($errorsp){
		
		print("<table align='center'>
		<embed src='audi/pin_error.mp3' autostart='true' loop='false' width='0' height='0' hidden='true'>
		</embed>
			<tr>
				<td style='text-align:center'>
					<!--
					<font color='#FF0000'>* SOLUCIONE ESTOS ERRORES:</font><br/>
					-->
					<font color='#FF0000'>ERROR ACCESO PIN</font>
				</td>
			</tr>
					<!--
			<tr>
				<td style='text-align:left'>
					-->");
		/*	
		for($a=0; $c=count($errorsp), $a<$c; $a++){
			print("<font color='#FF0000'>**</font>  ".$errorsp [$a]."<br/>");
			}
		*/
		print("<!--</td>
					</tr>-->
						</table>");
				}
	
	print("<table align='center' style=\"margin-top:2px; margin-bottom:2px\" >
				<tr>
					<td>	
						SU PIN
					</td>
					
		<form name='pin' method='post' action='$_SERVER[PHP_SELF]'>	
		
					<td valign='middle'>
		<input type='Password' name='pin' size=12 maxlength=9 value='".$defaults['pin']."' />
					</td>
					<td valign='middle' align='right' colspan='2'>
						<input type='submit' value='FICHAR CON PIN' class='botonverde' />
						<input type='hidden' name='ocultop' value=1 />
		</form>	
					</td>
				</tr>
			</table>"); 
	
	}

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

<!-- Inicio footer -->
<div id="footer"><?php print($head_footer);?></div>
<!-- Fin footer -->

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
	

</html>
