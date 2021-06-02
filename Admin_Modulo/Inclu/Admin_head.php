<!DOCTYPE html>
	
<head>
	
<?php

	if (isset($playinclu)){ global $rutarequir;
							$rutarequir = "";
							global $rutameta;
							$rutameta = "../";
							global $meta2;
							$meta2 = "";
							global $winini;
							$winini = "";
	} elseif (isset($playini)){ 
		global $rutameta;
		$rutameta = "";
		global $rutarequir;
		$rutarequir = "Inclu/";
		global $meta2;
		$meta2 = "<link href='".$rutameta."Inclu/playini.css' rel='stylesheet' type='text/css' />
				  <script src='".$rutameta."Inclu/playhora.js' type='text/javascript'></script>";
		global $winini;
		$winini ="<div id='ventana-flotante'>
		<a class='cerrar' href='javascript:void(0);' onclick='document.getElementById(&apos;ventana-flotante&apos;).className = &apos;oculto&apos;'>X</a>
		<div class='contenido' style=\"text-align:center; padding-top:22px\">
		DOWNLOAD THIS APP FREE AND MORE IN:<br/>
		<a href=\"http://juanbarrospazos.blogspot.com.es/\" target=\"_blank\" >	
		http://juanbarrospazos.blogspot.com.es/</a></div></div>";
	} else { global $rutameta;
			 $rutameta = "../";
			 global $rutarequir;
			 $rutarequir = "../Inclu/";
			 global $meta2;
			 $meta2 = "";
			 global $winini;
			 $winini = ""; }

	if (isset($popup)){
		global $meta3;
		$meta3 = "<script src='".$rutameta."img_change_jscss/jquery-3.4.1.min.js'></script>
		<script src='".$rutameta."img_change_jscss/inputfile-custom.js'></script>
		<link href='".$rutameta."img_change_jscss/inputfile.css' rel='stylesheet' type='text/css'/>";
		}else { global $meta3;
				$meta3 = ""; }
								
	require $rutarequir.'playmeta.php';

?>
	

<!-- CIERRO AUTO LA VENTANA DESPUES DE 3 SEGUNDOS	
	
	<script type="text/javascript">
		
		setTimeout("window.self.close();", 3000);
		
	</script>

 -->
	
</head>
	
	<?php
		if (isset($playini)){ 
			echo "<body topmargin=\"0\" onload=\"hora()\">";
			echo $winini; }
		else { echo "<body topmargin=\"0\" >";
		} 
	?>
	
	<div id="Conte">

	<div id="head"> 
				<span style="font-size:18px">
						JUAN BARROS PAZOS
				</span>
		</br>
				<span style="font-size:12px">
					Design & Programming in Palma de Mallorca
				</span>
	</div>

  <div style="clear:both"></div>
   
   <div style="margin-top:2px; text-align:center" id="TitTut">
   
		<?php
			if (isset($playini)){ 
				echo "<font color=\"#59746A\"><span id=\"hora\">000000</span></font>";
			} else { } 
		?>
    
	</div>
			  <div style="clear:both"></div>

  <div id="Caja2Admin">



