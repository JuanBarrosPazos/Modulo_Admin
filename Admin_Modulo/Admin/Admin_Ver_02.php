<?php
session_start();

	require '../Inclu/error_hidden.php';
	require '../Inclu/Admin_Inclu_popup.php';
	require '../Conections/conection.php';
	require '../Conections/conect.php';
	require '../Inclu/my_bbdd_clave.php';

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

if (($_SESSION['Nivel'] == 'admin')||($_SESSION['Nivel'] == 'user') || ($_SESSION['Nivel'] == 'plus')){
				
	global $nombre;
	global $apellido;
	$nombre = $_POST['Nombre'];
	$apellido = $_POST['Apellidos'];
							
				if($_POST['oculto2']){	process_form();
										info();
											} 
				} else { require '../Inclu/table_permisos.php'; }

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function process_form(){
	
	global $nombre;
	global $apellido;
	$nombre = $_POST['Nombre'];
	$apellido = $_POST['Apellidos'];
	
	print("<table align='center' width='auto'>
				<tr>
					<th colspan=3  class='BorderInf'>
						DATOS DEL USUARIO
					</th>
				</tr>
				
				<tr>
					<td width=110px>ID:</td>
					<td>".$_POST['id']."</td>
					<td rowspan='5' align='right' width='120px'>
	<img src='../Users/".$_POST['ref']."/img_admin/".$_POST['myimg']."' height='120px' width='90px' />
					</td>
				</tr>
				
				<tr>
					<td>Nivel:</td>
					<td>".$_POST['Nivel']."</td>
				</tr>
				
				<tr>
					<td>Referencia:</td>
					<td>".$_POST['ref']."</td>
				</tr>
				
				<tr>
					<td>Nombre:</td>
					<td>".$_POST['Nombre']."</td>
				</tr>
				
				<tr>
					<td>Apellidos:</td>
					<td>".$_POST['Apellidos']."</td>
				</tr>				
				
				<tr>
					<td>Documento:</td>
					<td>".$_POST['doc']."</td>
				</tr>				
				
				<tr>
					<td>N&uacute;mero:</td>
					<td colspan='2'>".$_POST['dni']."</td>
				</tr>				
				
				<tr>
					<td>Control:</td>
					<td colspan='2'>".$_POST['ldni']."</td>
				</tr>				
				
				<tr>
					<td>Mail:</td>
					<td colspan='2'>".$_POST['Email']."</td>
				</tr>
				
				<tr>
					<td>Usuario:</td>
					<td colspan='2'>".$_POST['Usuario']."</td>
				</tr>
				
				<tr>
					<td>Password:</td>
					<td colspan='2'>".$_POST['Pass']."</td>
				</tr>
				
				<tr>
					<td>Direcci&oacute;n:</td>
					<td colspan='2'>".$_POST['Direccion']."</td>
				</tr>
				
				<tr>
					<td>Tel&eacute;fono 1:</td>
					<td colspan='2'>".$_POST['Tlf1']."</td>
				</tr>
				
				<tr>
					<td>Tel&eacute;fono 2:</td>
					<td colspan='2'>".$_POST['Tlf2']."</td>
				</tr>
				
				<tr>
					<td>Last IN:</td>
					<td colspan='2'>".$_POST['lastin']."</td>
				</tr>
				
				<tr>
					<td>Last Out:</td>
					<td colspan='2'>".$_POST['lastout']."</td>
				</tr>
				
				<tr>
					<td>Nº Visitas:</td>
					<td colspan='2'>".$_POST['visitadmin']."</td>
				</tr>
				
				<tr>
					<td colspan=3 align='right' class='BorderSup'>
	<form name='closewindow' action='$_SERVER[PHP_SELF]'  onsubmit=\"window.close()\">
											<input type='submit' value='CERRAR VENTANA' />
											<input type='hidden' name='oculto2' value=1 />
			</form>
					</td>
				</tr>
			</table>"); 

		}
			
				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function info(){

	global $nombre;
	global $apellido;
		
	$rf = $_POST['ref'];
	$nombre = $_POST['Nombre'];
	$apellido = $_POST['Apellidos'];
		
	$ActionTime = date('H:i:s');
	
	global $dir;
	$dir = "../Users/".$_SESSION['ref']."/log";
	
	global $text;
	$text = PHP_EOL."- USERS VER DETALLES ".$ActionTime.PHP_EOL."\t Nombre: ".$nombre." ".$apellido;

	$logdocu = $_SESSION['ref'];
	$logdate = date('Y_m_d');
	$logtext = $text.PHP_EOL;
	$filename = $dir."/".$logdate."_".$logdocu.".log";
	$log = fopen($filename, 'ab+');
	fwrite($log, $logtext);
	fclose($log);

	}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	require '../Inclu/Admin_Inclu_footer.php';

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

/* Creado por Juan Barros Pazos 2021 */
?>
