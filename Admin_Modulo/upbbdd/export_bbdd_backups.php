<?php
session_start();

	//require '../Inclu/error_hidden.php';
	require '../Inclu/Admin_Inclu_head.php';
	require '../Conections/conection.php';
	require '../Conections/conect.php';
	require '../Inclu/my_bbdd_clave.php';

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

if ($_SESSION['Nivel'] == 'admin'){

					master_index();

				if(isset($_POST['delete'])){	delete();
											listfiles();
											info_del();
										}
				elseif(isset($_POST['backupm'])){
											manual_backup();
											listfiles();
											info();
											}
				elseif(isset($_POST['downl'])){
											listfiles();
											red();
											info_downl();
											}
					else {	listfiles();}
								
				} else { require '../Inclu/table_permisos.php'; }

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function red(){

	global $redir;
	$redir = "<script type='text/javascript'>
					function redir(){
					window.location.href='".$_POST['ruta']."' ;
				}
				setTimeout('redir()',1000);
				</script>";
	print ($redir);

}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function manual_backup(){

	require 'bbdd_My_export_tot.php';

}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function listfiles(){

	print ("<table align='center' style='border:1; margin-top:2px' width='auto'>
				<tr>
					<td align='center'>
						<form name='delete' action='$_SERVER[PHP_SELF]' method='post'>
							<input type='submit' value='REALIZA UNA EXPORTACION MANUAL DE BBDD AHORA'  class='botonverde' />
							<input type='hidden' name='backupm' value='1' >
						</form>
					</td>
				</tr>
			</table>");

	if(isset($_SESSION['tablas']) == ''){ $_SESSION['tablas'] = $_SESSION['ref']; }
	//print("*".$_SESSION['tablas'].".</br>");

	global $ruta;
	$ruta ="bbdd_export_tot/";
	//print("RUTA: ".$ruta.".</br>");
	
	global $rutag;
	$rutag = "bbdd_export_tot/{*}";
	//print("RUTA G: ".$rutag.".</br>");
		
	$directorio = opendir($ruta);
	global $num;
	$num=count(glob($rutag,GLOB_BRACE));
	if($num < 1){
		
		print ("<table align='center' style='border:1; margin-top:2px' width='auto'>
				<tr>
				<td align='center'>NO HAY ARCHIVOS PARA DESCARGAR</td>
				</tr>");
	}else{
		
	print ("<table align='center' style='border:1; margin-top:2px' width='auto'>
				<tr>
					<td align='center' colspan='3' class='BorderInf'>
						DESCARGAR BBDD BACKUP AUTO Y MANUAL .SQL
					</td>
				</tr>");

	while($archivo = readdir($directorio)){
		if($archivo != ',' && $archivo != '.' && $archivo != '..'){
			print("<tr>
			<td class='BorderInfDch'>
				<form name='delete' action='$_SERVER[PHP_SELF]' method='POST'>
					<input type='hidden' name='tablas' value='".$_SESSION['tablas']."' />
					<input type='hidden' name='ruta' value='".$ruta.$archivo."'>
					<input type='submit' value='ELIMINAR' class='botonrojo' />
					<input type='hidden' name='delete' value='1' >
				</form>
			</td>
			<td class='BorderInfDch'>
				<form name='archivos' action='$_SERVER[PHP_SELF]' method='POST'>
					<input type='hidden' name='tablas' value='".$_SESSION['tablas']."' />
					<input type='hidden' name='ruta' value='".$ruta.$archivo."'>
					<input type='submit' value='DESCARGAR' class='botonverde' />
					<input type='hidden' name='downl' value='1' >
				</form>
			</td>
			<td class='BorderInf'>".strtoupper($archivo)."</td>
			");
		}else{}
	} // FIN DEL WHILE
	}
	closedir($directorio);
	print("</table>");
}

function delete(){unlink($_POST['ruta']);}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function info(){

	global $datebbddx;
	
	$ActionTime = date('H:i:s');

	global $dir;
	$dir = "../Users/".$_SESSION['ref']."/log";
	
	global $text;
	$text = PHP_EOL."- RESPALDADO CREADO MANUALMENTE BBDD ".$ActionTime.PHP_EOL."\t NOMBRE BBDD: ".$datebbddx.".sql";

	$logdocu = $_SESSION['ref'];
	$logdate = date('Y_m_d');
	$logtext = $text.PHP_EOL;
	$filename = $dir."/".$logdate."_".$logdocu.".log";
	$log = fopen($filename, 'ab+');
	fwrite($log, $logtext);
	fclose($log);

			////////////////////		**********  		////////////////////

	global $dir2;
	$dir2 = "bbdd_log";
	
	global $text2;
	$text2 = PHP_EOL."- RESPALDADO CREADO MANUALMENTE BBDD POR: ".$_SESSION['ref']." ".$ActionTime.PHP_EOL."\t NOMBRE BBDD: ".$datebbddx.".sql";

	$logdate2 = date('Y_m_d');
	$logtext2 = $text2.PHP_EOL;
	$filename2 = $dir2."/".$logdate2.".log";
	$log2 = fopen($filename2, 'ab+');
	fwrite($log2, $logtext2);
	fclose($log2);

	}

					   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function info_del(){

	global $datebbddx;
	
	$ActionTime = date('H:i:s');

	global $dir;
	$dir = "../Users/".$_SESSION['ref']."/log";
	
	global $text;
	$text = PHP_EOL."- RESPALDO BORRADO MANUALMENTE BBDD ".$ActionTime.PHP_EOL."\t NOMBRE BBDD: ".$_POST['ruta'];

	$logdocu = $_SESSION['ref'];
	$logdate = date('Y_m_d');
	$logtext = $text.PHP_EOL;
	$filename = $dir."/".$logdate."_".$logdocu.".log";
	$log = fopen($filename, 'ab+');
	fwrite($log, $logtext);
	fclose($log);

			////////////////////		**********  		////////////////////

	global $dir2;
	$dir2 = "bbdd_log";
	
	global $text2;
	$text2 = PHP_EOL."- RESPALDO BORRADO MANUALMENTE BBDD POR: ".$_SESSION['ref']." ".$ActionTime.PHP_EOL."\t NOMBRE BBDD: ".$_POST['ruta'];

	$logdate2 = date('Y_m_d');
	$logtext2 = $text2.PHP_EOL;
	$filename2 = $dir2."/".$logdate2.".log";
	$log2 = fopen($filename2, 'ab+');
	fwrite($log2, $logtext2);
	fclose($log2);

	}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				 ///////////////////

function info_downl(){

	global $datebbddx;
	
	$ActionTime = date('H:i:s');

	global $dir;
	$dir = "../Users/".$_SESSION['ref']."/log";
	
	global $text;
	$text = PHP_EOL."- RESPALDO DESCARGADO MANUALMENTE BBDD ".$ActionTime.PHP_EOL."\t NOMBRE BBDD: ".$_POST['ruta'];

	$logdocu = $_SESSION['ref'];
	$logdate = date('Y_m_d');
	$logtext = $text.PHP_EOL;
	$filename = $dir."/".$logdate."_".$logdocu.".log";
	$log = fopen($filename, 'ab+');
	fwrite($log, $logtext);
	fclose($log);

			////////////////////		**********  		////////////////////

	global $dir2;
	$dir2 = "bbdd_log";
	
	global $text2;
	$text2 = PHP_EOL."- RESPALDO DESCARGADO MANUALMENTE BBDD POR: ".$_SESSION['ref']." ".$ActionTime.PHP_EOL."\t NOMBRE BBDD: ".$_POST['ruta'];

	$logdate2 = date('Y_m_d');
	$logtext2 = $text2.PHP_EOL;
	$filename2 = $dir2."/".$logdate2.".log";
	$log2 = fopen($filename2, 'ab+');
	fwrite($log2, $logtext2);
	fclose($log2);

	}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////
	
	function master_index(){
		
	require '../'.$_SESSION['menu'].'/rutaupbbdd.php';
	require '../'.$_SESSION['menu'].'/Master_Index.php';
		
		} /* Fin funcion master_index.*/

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	require '../Inclu/Admin_Inclu_02.php';

					   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

/* Creado por Juan Barros Pazos 2021 */
?>
