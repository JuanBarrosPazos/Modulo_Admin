<?php
session_start();

	//require '../Inclu/error_hidden.php';
	require '../Inclu/Admin_Inclu_01b.php';
	require '../Inclu/mydni.php';

	require '../Conections/conection.php';
	require '../Conections/conect.php';

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

if /*(*/($_SESSION['Nivel'] == 'admin')/* || ($_SESSION['Nivel'] == 'plus'))*/{

		master_index();

		if ($_POST['oculto2']){ show_form();
								info_01();
								}
		elseif($_POST['borrar']){	process_form();
									Feedback();
									info_02();
			} else {show_form();}
				} else { print("<table align='center' style=\"margin-top:200px;margin-bottom:200px\">
									<tr align='center'>
										<td>
											<font color='red'>
												<b>
													ACCESO RESTRINGIDO.
												</br></br>
													CONSULTE SUS PERMISOS ADMINISTRATIVOS.
												</b>
											</font>
										</td>
									</tr>
								</table>");
							}

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
				
				<tr>
					<td width=120px>
						ID:
					</td>
					<td width=100px>"
						.$_POST['id'].
					"</td>
					
					<td rowspan=5 width=94px>
<img src='../Users/".$_POST['ref']."/img_admin/".$_POST['myimg']."' height='120px' width='90px' />
					</td>
				</tr>
				
				<tr>
					<td>
						Referencia:
					</td>
					<td>"
						.$_POST['ref'].
					"</td>
				</tr>
				
				<tr>
					<td>
						Nivel:
					</td>
					<td>"
						.$_POST['Nivel'].
					"</td>
				</tr>
				
				<tr>
					<td>
						Nombre:
					</td>
					<td>"
						.$_POST['Nombre'].
					"</td>
				</tr>

				<tr>
					<td>
						Apellidos:
					</td>
					<td>"
						.$_POST['Apellidos'].
					"</td>
				</tr>				
				
				<tr>
					<td>
						Tipo Documento:
					</td>
					<td>"
						.$_POST['doc'].
					"</td>
				</tr>				
				
				<tr>
					<td>
						N&uacute;mero:
					</td>
					<td colspan=2>"
						.$_POST['dni'].
					"</td>
				</tr>				
				
				<tr>
					<td>
						Control:
					</td>
					<td colspan=2>"
						.$_POST['ldni'].
					"</td>
				</tr>				
				
				<tr>
					<td>
						Mail:
					</td>
					<td colspan=2>"
						.$_POST['Email'].
					"</td>
				</tr>
				
				<tr>
					<td>
						Usuario:
					</td>
					<td colspan=2>"
						.$_POST['Usuario'].
					"</td>
				</tr>
				
				<tr>
					<td>
						Password:
					</td>
					<td colspan=2>"
						.$_POST['Password'].
					"</td>
				</tr>
				
				<tr>
					<td>
						Direcci&oacute;n:
					</td>
					<td colspan=2>"
						.$_POST['Direccion'].
					"</td>
				</tr>
				
				<tr>
					<td>
						Tel&eacute;fono 1:
					</td>
					<td colspan=2>"
						.$_POST['Tlf1'].
					"</td>
				</tr>
				
				<tr>
					<td>
						Tel&eacute;fono 2:
					</td>
					<td colspan=2>"
						.$_POST['Tlf2'].
					"</td>
				</tr>
				
				<tr>
					<td>
						Last In:
					</td>
					<td colspan=2>"
						.$_POST['lastin'].
					"</td>
				</tr>
				
				<tr>
					<td>
						Last Out:
					</td>
					<td colspan=2>"
						.$_POST['lastout'].
					"</td>
				</tr>
				
				<tr>
					<td>
						Nº Visitas:
					</td>
					<td colspan=2>"
						.$_POST['visitadmin'].
					"</td>
				</tr>
			</table>");	

	global $db;
	global $db_name;
	
	global $nombre;
	global $apellido;
	$nombre = $_POST['Nombre'];
	$apellido = $_POST['Apellidos'];

	$sql = "DELETE FROM `$db_name`.`admin` WHERE `admin`.`id` = '$_POST[id]' LIMIT 1 ";

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
								'Direccion' => $_POST['Direccion'],
								'Tlf1' => $_POST['Tlf1'],
								'Tlf2' => $_POST['Tlf2'],
								'lastin' => $_POST['lastin'],
								'lastout' => $_POST['lastout'],
								'visitadmin' => $_POST['visitadmin']);
							}

	if($_POST['borrar']){
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
								'Direccion' => $_POST['Direccion'],
								'Tlf1' => $_POST['Tlf1'],
								'Tlf2' => $_POST['Tlf2'],
								'lastin' => $_POST['lastin'],
								'lastout' => $_POST['lastout'],
								'visitadmin' => $_POST['visitadmin']);
							}
								   
	print("<table align='center' style=\"margin-top:10px\">
				<tr>
					<td colspan=3 class='BorderInf' align='center'>
						<font color='#FF0000'>
						SE DARÁ DE BAJA TEMPORAL EN EL REGISTRO.
						</br>
						SE PODRÁN RECUPERAR DESDE FEEDBACK.
						</font>
					</td>
				</tr>
				<tr>
					<td colspan=3 class='BorderInf' style=\"text-align:right\">
							<a href='Admin_Borrar_01.php' >
													CANCELAR
							</a>
						</font>
					</td>
				</tr>
				
	<form name='form_datos' method='post' action='$_SERVER[PHP_SELF]'>
				<input name='id' type='hidden' value='".$defaults['id']."' />					
				<input name='ref' type='hidden' value='".$defaults['ref']."' />					
				<input name='lastin' type='hidden' value='".$defaults['lastin']."' />					
				<input name='lastout' type='hidden' value='".$defaults['lastout']."' />					
				<input name='visitadmin' type='hidden' value='".$defaults['visitadmin']."' />
		<tr>
			<td width=120px>	
					Nivel:
			</td>
			
			<td width=100px>
				".$defaults['Nivel']."
				<input  type='hidden' name='Nivel' value='".$defaults['Nivel']."' />
			</td>
			
			<td rowspan='5' align='center' width='94px'>
<img src='../Users/".$_POST['ref']."/img_admin/".$_POST['myimg']."' height='120px' width='90px' />
						<input name='myimg' type='hidden' value='".$_POST['myimg']."' />
			</td>
		</tr>
					
		<tr>
			<td>	
					Nombre:
			</td>
			
			<td>
				".$defaults['Nombre']."
				<input  type='hidden' name='Nombre' value='".$defaults['Nombre']."' />
			</td>
		</tr>
					
		<tr>
			<td>
					Apellidos:
			</td>
			
			<td>
				".$defaults['Apellidos']."
				<input type='hidden' name='Apellidos' value='".$defaults['Apellidos']."' />
			</td>
		</tr>
				
		<tr>
			<td>
					Tipo Documeno:
			</td>
			
			<td>
				".$defaults['doc']."
				<input type='hidden' name='doc' value='".$defaults['doc']."' />
			</td>
		</tr>
				
		<tr>
			<td>
					N&uacute;mero:
			</td>
			
			<td>
				".$defaults['dni']."
				<input type='hidden' name='dni' value='".$defaults['dni']."' />
			</td>
		</tr>
				
		<tr>
			<td>
					Control:
			</td>
			
			<td colspan='2'>
				".$defaults['ldni']."
				<input type='hidden' name='ldni' value='".$defaults['ldni']."' />
			</td>
		</tr>
				
		<tr>
			<td>
					Mail:
			</td>
			<td colspan='2'>
				".$defaults['Email']."
				<input type='hidden'' name='Email' value='".$defaults['Email']."' />
			</td>
		</tr>	
				
		<tr>
			<td>
					Nombre de Usuario:
			</td>
			<td colspan='2'>
				".$defaults['Usuario']."
				<input type='hidden' name='Usuario' value='".$defaults['Usuario']."' />
			</td>
		</tr>
							
		<tr>
			<td>
					Password:
			</td>
			<td colspan='2'>
				".$defaults['Password']."
				<input type='hidden' name='Password' value='".$defaults['Password']."' />
			</td>
		</tr>

		<tr>
			<td>
					Dirección:
			</td>
			<td colspan='2'>
				".$defaults['Direccion']."
				<input type='hidden' name='Direccion' value='".$defaults['Direccion']."' />
			</td>
		</tr>
				
		<tr>
			<td>
					Teléfono 1:
			</td>
			<td colspan='2'>
				".$defaults['Tlf1']."
				<input type='hidden' name='Tlf1' value='".$defaults['Tlf1']."' />
			</td>
		</tr>
				
		<tr>
			<td class='BorderInf'>
					Teléfono 2:
			</td>
			<td class='BorderInf' colspan='2'>
				".$defaults['Tlf2']."
				<input type='hidden' name='Tlf2' value='".$defaults['Tlf2']."' />
			</td>
		</tr>
				
		<tr align='right'>
			<td colspan='3'>
				<input type='submit' value='CONFIRMAR LA BAJA TEMPORAL' />
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
			
	$sqlf = "INSERT INTO `$db_name`.`feedback` (`ref`, `Nivel`, `Nombre`, `Apellidos`, `myimg`, `doc`, `dni`, `ldni`, `Email`, `Usuario`, `Password`, `Direccion`, `Tlf1`, `Tlf2`, `borrado`, `lastin`, `lastout`, `visitadmin`) VALUES ('$_POST[ref]', '$_POST[Nivel]', '$_POST[Nombre]', '$_POST[Apellidos]', '$_POST[myimg]', '$_POST[doc]', '$_POST[dni]', '$_POST[ldni]', '$_POST[Email]', '$_POST[Usuario]', '$_POST[Password]', '$_POST[Direccion]', '$_POST[Tlf1]', '$_POST[Tlf2]', '$FBaja', '$_POST[lastin]', '$_POST[lastout]', '$_POST[visitadmin]', '$_POST[myqr]')";
	
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
		
				require '../Inclu/Master_Index_Admin.php';
		
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
$text = PHP_EOL."- ADMIN BORRADO ".$ActionTime.PHP_EOL."\t ID: ".$_POST['id'].PHP_EOL."\t Nombre: ".$nombre." ".$apellido.PHP_EOL."\t Ref: ".$rf.". Nivel: ".$_POST['Nivel'].PHP_EOL."\t User: ".$_POST['Usuario'].". Pass: ".$_POST['Password'];

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
	$orden = $_POST['Orden'];	

	$ActionTime = date('H:i:s');

	global $dir;
	$dir = "../Users/".$_SESSION['ref']."/log";

global $text;
$text = PHP_EOL."- ADMIN BORRAR SELECCIONADO ".$ActionTime.PHP_EOL."\t ID:".$_POST['id'].PHP_EOL."\t Nombre: ".$nombre." ".$apellido.PHP_EOL."\t Ref: ".$rf.". Nivel: ".$_POST['Nivel'].PHP_EOL."\t User: ".$_POST['Usuario'].". Pass: ".$_POST['Password'];

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
	
	require '../Inclu/Admin_Inclu_02.php';

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

/* Creado por Juan Barros Pazos 2020 */
?>
