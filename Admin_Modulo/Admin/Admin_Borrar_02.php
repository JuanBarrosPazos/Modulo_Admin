<?php
session_start();

	require '../Inclu/error_hidden.php';
	require '../Inclu/Admin_Inclu_head.php';
	require '../Inclu/mydni.php';

	require '../Conections/conection.php';
	require '../Conections/conect.php';

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

if /*(*/($_SESSION['Nivel'] == 'admin')/* || ($_SESSION['Nivel'] == 'plus'))*/{

		master_index();

		if (@$_POST['oculto2']){ show_form();
								 info_01();
								}
		elseif($_POST['borrar']){	process_form();
									Feedback();
									info_02();
			} else {show_form();}
				} else { require '../Inclu/table_permisos.php'; }

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function process_form(){
	
	print("<table align='center'>
				<tr>
					<th colspan=3  class='BorderInf'>
						OK BAJA TEMPORAL ESTE USUARIO.
					</th>
				</tr>
			");
				
			global $rutaimg;
			$rutaimg = "src='../Users/".$_POST['ref']."/img_admin/".$_POST['myimg']."'";
			require 'table_data_resum.php';

	print("	<tr>
				<td colspan=3 align='right' class='BorderSup'>
					<form name='closewindow' action='Admin_Ver.php'>
						<input type='submit' value='INICIO GESTION USUARIOS' class='botonverde' />
						<input type='hidden' name='volver' value=1 />
					</form>
				</td>
			</tr>
		</table>");	

	global $db;
	global $db_name;

	global $table_name_a;
	$table_name_a = "`".$_SESSION['clave']."admin`";
	
	global $nombre;
	global $apellido;
	$nombre = $_POST['Nombre'];
	$apellido = $_POST['Apellidos'];

	$sql = "DELETE FROM `$db_name`.$table_name_a WHERE $table_name_a.`id` = '$_POST[id]' LIMIT 1 ";

	if(mysqli_query($db, $sql)){
			//print("* ");
				} else {
				print("<font color='#FF0000'>
						SE HA PRODUCIDO UN ERROR: </font>
						</br>
						&nbsp;&nbsp;&nbsp;".mysqli_error($db))."
						</br>";
						show_form ();
							}

	}	

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////
					
function show_form(){
		
	if($_POST['oculto2']){
			$defaults = array ( 'id' => $_POST['id'],
								'ref' => $_POST['ref'],
								'Nivel' => $_POST['Nivel'],
								'Nombre' => $_POST['Nombre'],
								'Apellidos' => $_POST['Apellidos'],
								'myimg' => $_POST['myimg'],
								'doc' => $_POST['doc'],
								'dni' => $_POST['dni'],
								'ldni' => $_POST['ldni'],
								'Email' => $_POST['Email'],
								'Usuario' => $_POST['Usuario'],
								'Password' => $_POST['Password'],
								'Pass' => $_POST['Pass'],
								'Direccion' => $_POST['Direccion'],
								'Tlf1' => $_POST['Tlf1'],
								'Tlf2' => $_POST['Tlf2'],
								'lastin' => $_POST['lastin'],
								'lastout' => $_POST['lastout'],
								'visitadmin' => $_POST['visitadmin']);
							}

	if(@$_POST['borrar']){
			$defaults = array ( 'id' => $_POST['id'],
								'ref' => $_POST['ref'],
								'Nivel' => $_POST['Nivel'],
								'Nombre' => $_POST['Nombre'],
								'Apellidos' => $_POST['Apellidos'],
								'myimg' => $_POST['myimg'],
								'doc' => $_POST['doc'],
								'dni' => $_POST['dni'],
								'ldni' => $_POST['ldni'],
								'Email' => $_POST['Email'],
								'Usuario' => $_POST['Usuario'],
								'Password' => $_POST['Password'],
								'Pass' => $_POST['Pass'],
								'Direccion' => $_POST['Direccion'],
								'Tlf1' => $_POST['Tlf1'],
								'Tlf2' => $_POST['Tlf2'],
								'lastin' => $_POST['lastin'],
								'lastout' => $_POST['lastout'],
								'visitadmin' => $_POST['visitadmin'],
								'borrado' => $_POST['borrado'],
							);
				}
								   
	print("<table align='center' style=\"margin-top:10px\">
				<tr>
					<td colspan=3 class='BorderInf'>
						<font color='#FF0000'>
						SE DARÁ DE BAJA TEMPORAL EN EL REGISTRO.
						</br>
						SE PODRÁN RECUPERAR DESDE FEEDBACK.
						</font>
					</td>
				</tr>
				<tr>
					<td colspan=3 class='BorderInf' style=\"text-align:right\">
						<a href='Admin_Ver.php' >CANCELAR Y VOLVER</a>
					</td>
				</tr>
				
	<form name='form_datos' method='post' action='$_SERVER[PHP_SELF]'>
				<input name='id' type='hidden' value='".$defaults['id']."' />					
				<input name='ref' type='hidden' value='".$defaults['ref']."' />					
				<input name='lastin' type='hidden' value='".$defaults['lastin']."' />					
				<input name='lastout' type='hidden' value='".$defaults['lastout']."' />					
				<input name='visitadmin' type='hidden' value='".$defaults['visitadmin']."' />
				<input name='Password' type='hidden' value='".$defaults['Password']."' />
				<input type='hidden' name='borrado' value='".$defaults['borrado']."' />
				<tr>
			<td style='text-align:right !important; width:120px;'>Nivel:</td>
			
			<td style='text-align:left !important; width:100px;'>
				".$defaults['Nivel']."
				<input  type='hidden' name='Nivel' value='".$defaults['Nivel']."' />
			</td>
			
			<td rowspan='5' align='center' width='94px'>
<img src='../Users/".$_POST['ref']."/img_admin/".$_POST['myimg']."' height='120px' width='90px' />
						<input name='myimg' type='hidden' value='".$_POST['myimg']."' />
			</td>
		</tr>
					
		<tr>
			<td style='text-align:right !important;'>Nombre:</td>
			<td style='text-align:left !important;'>".$defaults['Nombre']."
				<input  type='hidden' name='Nombre' value='".$defaults['Nombre']."' />
			</td>
		</tr>
					
		<tr>
			<td style='text-align:right !important;'>Apellidos:</td>
			<td style='text-align:left !important;'>".$defaults['Apellidos']."
				<input type='hidden' name='Apellidos' value='".$defaults['Apellidos']."' />
			</td>
		</tr>
				
		<tr>
			<td style='text-align:right !important;'>Tipo Documento: </td>
			<td style='text-align:left !important;'>".$defaults['doc']."
				<input type='hidden' name='doc' value='".$defaults['doc']."' />
			</td>
		</tr>
				
		<tr>
			<td style='text-align:right !important;'>N&uacute;mero: </td>
			<td style='text-align:left !important;'>".$defaults['dni']."
				<input type='hidden' name='dni' value='".$defaults['dni']."' />
			</td>
		</tr>
				
		<tr>
			<td style='text-align:right !important;'>Control: </td>
			<td style='text-align:left !important;' colspan='2'>".$defaults['ldni']."
				<input type='hidden' name='ldni' value='".$defaults['ldni']."' />
			</td>
		</tr>
				
		<tr>
			<td style='text-align:right !important;'>Mail: </td>
			<td style='text-align:left !important;' colspan='2'>".$defaults['Email']."
				<input type='hidden'' name='Email' value='".$defaults['Email']."' />
			</td>
		</tr>	
				
		<tr>
			<td style='text-align:right !important;'>Nombre de Usuario: </td>
			<td style='text-align:left !important;' colspan='2'>".$defaults['Usuario']."
				<input type='hidden' name='Usuario' value='".$defaults['Usuario']."' />
			</td>
		</tr>
							
		<tr>
			<td style='text-align:right !important;'>Password: </td>
			<td style='text-align:left !important;' colspan='2'>".$defaults['Pass']."
				<input type='hidden' name='Pass' value='".$defaults['Pass']."' />
			</td>
		</tr>

		<tr>
			<td style='text-align:right !important;'>Dirección: </td>
			<td style='text-align:left !important;' colspan='2'>".$defaults['Direccion']."
				<input type='hidden' name='Direccion' value='".$defaults['Direccion']."' />
			</td>
		</tr>
				
		<tr>
			<td style='text-align:right !important;'>Teléfono 1: </td>
			<td style='text-align:left !important;' colspan='2'>".$defaults['Tlf1']."
				<input type='hidden' name='Tlf1' value='".$defaults['Tlf1']."' />
			</td>
		</tr>
				
		<tr>
			<td class='BorderInf' style='text-align:right !important;'>Teléfono 2: </td>
			<td class='BorderInf' style='text-align:left !important;' colspan='2'>".$defaults['Tlf2']."
				<input type='hidden' name='Tlf2' value='".$defaults['Tlf2']."' />
			</td>
		</tr>
				
		<tr>
			<td colspan='3'>
				<input type='submit' value='CONFIRMAR LA BAJA TEMPORAL' class='botonrojo' />
				<input type='hidden' name='borrar' value=1 />
			</td>
		</tr>
</form>														
	</table>"); 
	
	}	

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function Feedback(){
	
	$FBaja = date('Y-m-d/H:i:s');
	
	require '../Conections/conection.php';

	$dbf = mysqli_connect($db_host,$db_user,$db_pass,$db_name);
	if (!$dbf){ die ("Es imposible conectar con la bbdd ".$db_name."</br>".mysqli_connect_error());
				}
	
	global $table_name_a;
	$table_name_a = "`".$_SESSION['clave']."feedback`";

	$sqlf = "INSERT INTO `$db_name`.$table_name_a (`ref`, `Nivel`, `Nombre`, `Apellidos`, `myimg`, `doc`, `dni`, `ldni`, `Email`, `Usuario`, `Password`, `Pass`, `Direccion`, `Tlf1`, `Tlf2`,`lastin`, `lastout`, `visitadmin`, `borrado` ) VALUES ('$_POST[ref]', '$_POST[Nivel]', '$_POST[Nombre]', '$_POST[Apellidos]', '$_POST[myimg]', '$_POST[doc]', '$_POST[dni]', '$_POST[ldni]', '$_POST[Email]', '$_POST[Usuario]', '$_POST[Password]','$_POST[Pass]', '$_POST[Direccion]', '$_POST[Tlf1]', '$_POST[Tlf2]', '$_POST[lastin]', '$_POST[lastout]', '$_POST[visitadmin]', '$FBaja')";
	
	if(mysqli_query($dbf, $sqlf)){
			//print("FOK.");
					} else {
				print("<font color='#FF0000'>
						* SE HA PRODUCIDO UN ERROR AL GRABAR FEEDBACK: </font>
						</br>
						&nbsp;&nbsp;&nbsp;".mysqli_error($dbf)).
						"</br>";
					}
	}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////
	
	function master_index(){
		
		require '../'.$_SESSION['menu'].'/rutaadmin.php';
		require '../'.$_SESSION['menu'].'/Master_Index.php';
		
	} 

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function info_02(){

	global $nombre;
	global $apellido;	
	global $rf;
	
	$rf = $_POST['ref'];
	$nombre = $_POST['Nombre'];
	$apellido = $_POST['Apellidos'];
		
	$ActionTime = date('H:i:s');

	global $dir;
	$dir = "../Users/".$_SESSION['ref']."/log";

global $text;
$text = PHP_EOL."- ADMIN BORRADO ".$ActionTime.PHP_EOL."\t ID: ".$_POST['id'].PHP_EOL."\t Nombre: ".$nombre." ".$apellido.PHP_EOL."\t Ref: ".$rf.". Nivel: ".$_POST['Nivel'].PHP_EOL."\t User: ".$_POST['Usuario'].". Pass: ".$_POST['Pass'];

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

function info_01(){

	global $nombre;
	global $apellido;
	global $rf;
	
	$rf = $_POST['ref'];
	$nombre = $_POST['Nombre'];
	$apellido = $_POST['Apellidos'];
		
	global $orden;
	$orden = @$_POST['Orden'];	

	$ActionTime = date('H:i:s');

	global $dir;
	$dir = "../Users/".$_SESSION['ref']."/log";

global $text;
$text = PHP_EOL."- ADMIN BORRAR SELECCIONADO ".$ActionTime.PHP_EOL."\t ID:".$_POST['id'].PHP_EOL."\t Nombre: ".$nombre." ".$apellido.PHP_EOL."\t Ref: ".$rf.". Nivel: ".$_POST['Nivel'].PHP_EOL."\t User: ".$_POST['Usuario'].". Pass: ".$_POST['Pass'];

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
