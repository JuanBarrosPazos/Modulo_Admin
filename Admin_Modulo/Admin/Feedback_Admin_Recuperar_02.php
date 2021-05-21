
<?php
session_start();

	require '../Inclu/error_hidden.php';
	require '../Inclu/Admin_Inclu_head.php';

	require '../Conections/conection.php';
	require '../Conections/conect.php';
	require '../Inclu/my_bbdd_clave.php';

/*
global $table_name_a;
$table_name_a = "`".$_SESSION['clave']."admin`";
$sqld =  "SELECT * FROM $table_name_a WHERE `ref` = '$_SESSION[ref]' AND `Usuario` = '$_SESSION[Usuario]'";
$qd = mysqli_query($db, $sqld);
$rowd = mysqli_fetch_assoc($qd);
*/

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

if ($_SESSION['Nivel'] == 'admin'){

		master_index();

		if (@$_POST['oculto2']){ show_form();
								info_01();
								}
		elseif($_POST['modifica']){ process_form();
									info_02();
						} else {show_form();}
		} else { require '../Inclu/table_permisos.php'; }

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function process_form(){
	
	global $db;
	global $db_name;
	
	global $nombre;
	global $apellido;
	$nombre = $_POST['Nombre'];
	$apellido = $_POST['Apellidos'];

	global $table_name_a;
	$table_name_a = "`".$_SESSION['clave']."admin`";

	$sqlc = "INSERT INTO `$db_name`.$table_name_a SET `ref` = '$_POST[ref]', `Nivel` = '$_POST[Nivel]', `Nombre` = '$_POST[Nombre]', `Apellidos` = '$_POST[Apellidos]', `myimg` = '$_POST[myimg]', `doc` = '$_POST[doc]', `dni` = '$_POST[dni]', `ldni` = '$_POST[ldni]', `Email` = '$_POST[Email]', `Usuario` = '$_POST[Usuario]', `Password` = '$_POST[Password]',`Pass` = '$_POST[Pass]', `Direccion` = '$_POST[Direccion]', `Tlf1` = '$_POST[Tlf1]', `Tlf2` = '$_POST[Tlf2]', `lastin` = '$_POST[lastin]', `lastout` = '$_POST[lastout]', `visitadmin` = '$_POST[visitadmin]' ";

	if(mysqli_query($db, $sqlc)){
			print("<table align='center'>
						<tr>
							<td colspan=3 class='BorderInf' align='center'>
								DATOS USER RECUPERADOS
							</td>
						</tr>");
							
			global $rutaimg;
			$rutaimg = "src='../Users/".$_POST['ref']."/img_admin/".$_POST['myimg']."'";
			require 'table_data_resum.php';
			require 'table_data_resum_feed.php';
				
			print("	<tr>
						<td>Vista Admin:</td>
							<td colspan=2>".$_POST['visitadmin']."</td>
						</tr>
						<tr>
							<form name='closewindow' action='Feedback_Ver.php'>
							<td colspan=3 align='right' class='BorderSup'>
								<input type='submit' value='GESTION BAJAS VOLVER' class='botonverde' />
								<input type='hidden' name='volver' value=1 />
							</td>
								</form>
					</tr>
				</table>");

	} else {print("<font color='#FF0000'>
						* ESTOS DATOS NO SON VALIDOS, MODIFIQUE ESTA ENTRADA: </font>
						</br>
						&nbsp;&nbsp;&nbsp;".mysqli_error($db))."
						</br>";
						show_form ();
						global $texerror;
						$texerror = "\n\t ".mysqli_error($db);
							}

	global $table_name_f;
	$table_name_f = "`".$_SESSION['clave']."feedback`";
						
	$sqlc2 = "DELETE FROM `$db_name`.$table_name_f WHERE $table_name_f.`id` = '$_POST[id]' LIMIT 1 ";

	if(mysqli_query($db, $sqlc2)){
					//print("HA RECUPERADO FEEDBACK ADMIN");
				} else {
				print("<font color='#FF0000'>
						SE HA PRODUCIDO UN ERROR: </font>
						</br>
						&nbsp;&nbsp;&nbsp;".mysqli_error($db))."
						</br>";
							}

			}	

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////
			
function show_form(){
	
	global $dt;
	$dt = $_POST['doc'];
	
	global $img;
	$img = 	$_POST['myimg'];

	if($_POST['oculto2']){
		
	$_SESSION['sref'] = $_POST['ref'];
	
				$defaults = array ( 'id' => $_POST['id'],
									'ref' => $_POST['ref'],
									'Nombre' => $_POST['Nombre'],
									'Apellidos' => $_POST['Apellidos'],
									'myimg' => $_POST['myimg'],
									'Nivel' => $_POST['Nivel'],
								   	'doc' => $dt,
									'dni' => $_POST['dni'],
									'ldni' => $_POST['ldni'],
									'Email' => $_POST['Email'],
									'Usuario' => $_POST['Usuario'],
									'Usuario2' => $_POST['Usuario'],
									'Password' => $_POST['Password'],
									'Password2' => $_POST['Password'],
									'Pass' => $_POST['Pass'],
									'Direccion' => $_POST['Direccion'],
									'Tlf1' => $_POST['Tlf1'],
									'Tlf2' => $_POST['Tlf2'],
									'lastin' => $_POST['lastin'],
									'lastout' => $_POST['lastout'],
									'visitadmin' => $_POST['visitadmin']);
							}
	
	print("<table align='center'>
				<tr>
					<td colspan=3 class='BorderInf' align='center'>
						DATOS DEL USER A RECUPERAR.
					</td>
				</tr>
				<tr>
					<th colspan=3 class='BorderInf' style=\"text-align:right\">
							<a href='Feedback_Ver.php' >
													CANCELAR Y VOLVER
							</a>
						</font>
					</th>
				</tr>
				
		<form name='form_datos' method='post' action='$_SERVER[PHP_SELF]'>
			
		<input name='id' type='hidden' value='".$defaults['id']."' />					
		<input name='myimg' type='hidden' value='".$defaults['myimg']."' />	
		<input type='hidden' name='Password' value='".$defaults['Password']."' />

				<tr>
					<td width=120px>	
						<font color='#FF0000'>*</font>
						Ref. User:
					</td>
					<td width=100px>
						".$defaults['ref']."
						<input name='ref' type='hidden' value='".$defaults['ref']."' />
					</td>
					<td rowspan=5 width=94px>
<img src='../Users/".$_SESSION['sref']."/img_admin/".$defaults['myimg']."' height='120px' width='90px' />
					</td>
				</tr>
					
				<tr>
					<td>	
						<font color='#FF0000'>*</font>
						Nombre:
					</td>
					<td>
						".$defaults['Nombre']."
						<input type='hidden' name='Nombre' value='".$defaults['Nombre']."' />
					</td>
				</tr>
					
				<tr>
					<td>
						<font color='#FF0000'>*</font>
						Apellidos:
					</td>
					<td>
						".$defaults['Apellidos']."
						<input type='hidden' name='Apellidos' value='".$defaults['Apellidos']."' />
					</td>
				</tr>

				<tr>
					<td>
						<font color='#FF0000'>*</font>
						Documento:
					</td>
					<td>
						".$defaults['doc']."
						<input type='hidden' name='doc' value='".$defaults['doc']."' />
					</td>
				</tr>
					
				<tr>
					<td>
						<font color='#FF0000'>*</font>
						N&uacute;mero:
					</td>
					<td>
						".$defaults['dni']."
						<input type='hidden' name='dni' value='".$defaults['dni']."' />
					</td>
				</tr>
				
				<tr>
					<td>
						<font color='#FF0000'>*</font>
						Control:
					</td>
					<td colspan=2>
						".$defaults['ldni']."
						<input type='hidden' name='ldni' value='".$defaults['ldni']."' />
					</td>
				</tr>
				
				<tr>
					<td>
						<font color='#FF0000'>*</font>
						Mail:
					</td>
					<td colspan=2>
						".$defaults['Email']."
						<input type='hidden' name='Email' value='".$defaults['Email']."' />
					</td>
				</tr>	
				
				<tr>
					<td>
						<font color='#FF0000'>*</font>
						Nivel:
					</td>
					<td colspan=2>
						".$defaults['Nivel']."
						<input type='hidden' name='Nivel' value='".$defaults['Nivel']."' />
					</td>
				</tr>
					
				<tr>
					<td>
						<font color='#FF0000'>*</font>
						Usuario:
					</td>
					<td colspan=2>
						".$defaults['Usuario']."
						<input type='hidden' name='Usuario' value='".$defaults['Usuario']."' />
					</td>
				</tr>
							
				<tr>
					<td>
						<font color='#FF0000'>*</font>
						Password:
					</td>
					<td colspan=2>
						".$defaults['Pass']."
						<input type='hidden' name='Pass' value='".$defaults['Pass']."' />
					</td>
				</tr>

				<tr>
					<td>
						<font color='#FF0000'>*</font>
						Dirección:
					</td>
					<td colspan=2>
						".$defaults['Direccion']."
						<input type='hidden' name='Direccion' value='".$defaults['Direccion']."' />
					</td>
				</tr>
				
				<tr>
					<td>
						<font color='#FF0000'>*</font>
						Teléfono 1:
					</td>
					<td colspan=2>
						".$defaults['Tlf1']."
						<input type='hidden' name='Tlf1' value='".$defaults['Tlf1']."' />
					</td>
				</tr>
				
				<tr>
					<td>
						<font color='#FF0000'>*</font>
						Teléfono 2:
					</td>
					<td colspan=2>
						".$defaults['Tlf2']."
						<input type='hidden' name='Tlf2' value='".$defaults['Tlf2']."' />
					</td>
				</tr>
				
				<tr>
					<td>
						<font color='#FF0000'>*</font>
						Last In:
					</td>
					<td colspan=2>
						".$defaults['lastin']."
						<input type='hidden' name='lastin' value='".$defaults['lastin']."' />
					</td>
				</tr>
				
				<tr>
					<td>
						<font color='#FF0000'>*</font>
						Last Out:
					</td>
					<td colspan=2>
						".$defaults['lastout']."
						<input type='hidden' name='lastout' value='".$defaults['lastout']."' />
					</td>
				</tr>
				
				<tr>
					<td>
						<font color='#FF0000'>*</font>
						Visitas:
					</td>
					<td colspan=2>
						".$defaults['visitadmin']."
						<input name='visitadmin' type='hidden' value='".$defaults['visitadmin']."' />
					</td>
				</tr>
				
				<tr height=40px>
					<td colspan='3' align='right' class='BorderSup'>
						<input type='submit' value='CONFIRME RECUPERAR USER' class='botonverde' />
						<input type='hidden' name='modifica' value=1 />
					</td>
				</tr>
		</form>														
			</table>"); 

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
	global $texerror;
	global $rf;

	$nombre = $_POST['Nombre'];
	$apellido = $_POST['Apellidos'];
		
	$ActionTime = date('H:i:s');

	global $dir;
	$dir = "../Users/".$_SESSION['ref']."/log";

global $text;
$text = PHP_EOL."- ADMIN FEEDBACK RECUPERADO ".$ActionTime.PHP_EOL."\t Nombre: ".$nombre." ".$apellido.PHP_EOL."\t Ref: ".$rf.". Nivel: ".$_POST['Nivel'].PHP_EOL."\t User: ".$_POST['Usuario'].". Pass: ".$_POST['Pass'];

	$logdocu = $_SESSION['ref'];
	$logdate = date('Y_m_d');
	$logtext = $text.$texerror.PHP_EOL;
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
$text = PHP_EOL."- ADMIN FEEDBACK RECUPERAR SELECCIONADO ".$ActionTime.PHP_EOL."\t Nombre: ".$nombre." ".$apellido.PHP_EOL."\t Ref: ".$rf.". Nivel: ".$_POST['Nivel'].PHP_EOL."\t User: ".$_POST['Usuario'].". Pass: ".$_POST['Pass'];

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