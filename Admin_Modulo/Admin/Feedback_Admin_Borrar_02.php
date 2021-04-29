<?php
session_start();

	//require '../Inclu/error_hidden.php';
	require '../Inclu/Admin_Inclu_01b.php';

	require '../Conections/conection.php';
	require '../Conections/conect.php';
	require '../Inclu/my_bbdd_clave.php';

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

if ($_SESSION['Nivel'] == 'admin'){

	master_index();

	if ($_POST['oculto2']){ show_form();
							info_01();
							}
	elseif($_POST['borrar']){	process_form();
								deletedir();
								info_02();
		} else {show_form();}
	} else { require '../Inclu/table_permisos.php'; }

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function process_form(){
	
	global $db;
	
	global $table;
	$table = "<table align='center'>
				<tr>
					<td colspan=3  class='BorderInf'>
						SE HAN BORRADO TODOS LOS DATOS.
					</td>
				</tr>
				
				<tr>
					<td width=120px>
						ID:
					</td>
					<td width=100px>"
						.$_POST['id'].
					"</td>
					<td rowspan=5 width=94px>
		<img src='../Users/temp/".$_POST['myimg']."' height='120px' width='90px' />
					</td>
				</tr>
					
				<tr>
					<td>
						Ref User:
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
						Documento:
					</td>
					<td colspan=2>"
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
				<tr>
					<td colspan=3 align='right' class='BorderSup'>
						<form name='closewindow' action='Feedback_Ver.php'>
							<input type='submit' value='USER BAJAS ELIMINAR VOLVER' />
							<input type='hidden' name='volver' value=1 />
						</form>
					</td>
				</tr>
			</table>";	

	global $db_name;
	
	global $nombre;
	global $apellido;
	$nombre = $_POST['Nombre'];
	$apellido = $_POST['Apellidos'];

	global $table_name_f;
	$table_name_f = "`".$_SESSION['clave']."feedback`";

	$sql = "DELETE FROM `$db_name`.$table_name_f WHERE $table_name_f.`id` = '$_POST[id]' LIMIT 1 ";

	if(mysqli_query($db, $sql)){
			//print("* ");

	print ($table); // SE IMPRIME LA TABLA DE CONFIRMACION

	/*************	BORRAMOS DIRECTORIO DE USUARIO	***************/
	
	$_SESSION['iniref'] = $_POST['ref'];
	
	global $refnorm;
	$refnorm = $_POST['ref'];

	$carpeta1 = "../Users/".$refnorm."/img_admin";
	if(file_exists($carpeta1)){	$dir1 = $carpeta1."/";
								$handle1 = opendir($dir1);
								while ($file1 = readdir($handle1))
										{if (is_file($dir1.$file1))
											{unlink($dir1.$file1);}
										}	
								rmdir (	$carpeta1);
								global $dd1;
								$dd1 = "\t- BORRADA: ".$carpeta1."/ \n";
								} else {print("");}

	$carpeta2 = "../Users/".$refnorm."/log";
	if(file_exists($carpeta2)){	$dir2 = $carpeta2."/";
									$handle2 = opendir($dir2);
									while ($file2 = readdir($handle2))
											{if (is_file($dir2.$file2))
												{unlink($dir2.$file2);}
											}	
									rmdir (	$carpeta2);
									global $dd2;
									$dd2 = "\t- BORRADA: ".$carpeta2."/ \n";
									} else {print("");}

	/*************	BORRAMOS TODAS LAS TABLAS DEL USUARIO 	***************/

	/* Se busca las tablas en la base de datos */
	/* REFERENCIA DEL USUARIO O $_SESSION['iniref'] = $_POST['ref'] */
	/* $nom PARA LA CLAVE USUARIO ACOMPAÑANDA DE _ O NO */
	global $db;
	global $db_name;
	global $nom;
	$nom = strtolower($_POST['ref']);
	$nom = $_SESSION['clave'].$_POST['ref']."%"; // SOLO COINCIDEN AL PRINCIPIO
	$nom = "LIKE '$nom'";
	//$consulta = "SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_NAME $nom ";
	$consulta = "SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$db_name' AND TABLE_NAME $nom ";
	$respuesta = mysqli_query($db, $consulta);
	//$count = mysqli_num_rows($respuesta);
	//print("* NUMERO TABLAS: ".$count."<br>");
	//print("* CLAVE TABLA USUARIO: ".$nom."<br>");

	//global $fila;
	//$fila = mysqli_fetch_row($respuesta);

if(!$respuesta){
print("<font color='#FF0000'>293 Se ha producido un error: </font></br>".mysqli_error($db)."</br>");
	} else { 
		while ($fila = mysqli_fetch_row($respuesta)) {
			if($fila[0]){
		/* PROCEDEMOS A BORRAR LAS TABLAS DEL USUARIO */
			global $sqlt1;
			$sqlt1 = "DROP TABLE `$db_name`.`$fila[0]` ";
			if(mysqli_query($db, $sqlt1)){
					// SE PASAN PARAMETROS A .LOG
					global $tx1;
					$tx1 = "\t* HA BORRADO LA TABLA ".$fila[0]."\n";
					global $deletet2;
					$deletet2 = $deletet2.$tx1;
				} else {
					global $tx1;
					$tx1 = "\t* ".mysqli_error($db)."\n";
					print ("<font color='#FF0000'>*** </font></br> ".mysqli_error($db).".</br>");
					global $deletet2;
					$deletet2 = $tx1;
							} 
		/* HASTA AQUI BORRA TABLAS Y PASA LOS LOG DE BBDD */
					} // FIN IF $FILA[0]
				} // FIN WHILE

		// SE GRABAN LOS DATOS EN LOG DEL ADMIN
		global $deletet2;
		$deletet1 = $dd1.$dd2."\n";
		global $deletet;
		$deletet = $deletet1.$deletet2;
		
	} // FIN ELSE !$respuesta

	} // FIN PRIMER IF SI SE BORRA EL USER DE LA BBDD
		// FIN BORRADO OK
		// => ELSE BORRADO NO OK PRIMER QUERY
		else {print("<font color='#FF0000'>SE HA PRODUCIDO UN ERROR: </font>
					</br>&nbsp;&nbsp;".mysqli_error($db))."</br>";
					show_form ();
						}

	}	// FIN FUNCTION

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function deletedir(){
	
	global $refnorm;
	$refnorm = $_SESSION['iniref'];

	$carpeta0 = "../Users/".$refnorm;
	if(file_exists($carpeta0)){  $dir0 = $carpeta0."/";
								  $handle0 = opendir($dir0);
								  while ($file0 = readdir($handle0))
										 {if (is_file($dir0.$file0))
											 {unlink($dir0.$file0);}
										 }
								rmdir (	$carpeta0);
								global $dd0;
								$dd0 = "\t- BORRADA: ".$carpeta0."/ \n";
								} else {print("");}
								
	global $ddr;
	$ddr = $dd0;
}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function show_form(){
		
	global $ctemp;
	$ctemp = "../Users/temp";
	global $imgorg;
	$imgorg = "../Users/".$_POST['ref']."/img_admin/".$_POST['myimg'];
				
	if (!file_exists($ctemp)) {
		mkdir($ctemp, 0777, true);
		copy($imgorg, $ctemp."/".$_POST['myimg']);
	}else{
		copy($imgorg, $ctemp."/".$_POST['myimg']);
			}

	if($_POST['oculto2']){
		
		$_SESSION['sref'] = $_POST['ref'];
		
				$defaults = array ( 'id' => $_POST['id'],
									'ref' => $_SESSION['sref'],
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
									'ref' => $_SESSION['sref'],
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
								   
	print("<table align='center' style=\"margin-top:20px\">
				<tr>
					<th colspan=3 class='BorderInf'>
						<font color='#FF0000'>
						SE BORRARÁN ESTOS DATOS DEL REGISTRO.
						</br>
						DIRECTORIOS Y TABLAS DE BBDD.
						</br>
						NO SE PODRÁN VOLVER A RECUPERAR.
						</font>
					</th>
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
<img src='../Users/".$_SESSION['sref']."/img_admin/".$_POST['myimg']."' height='120px' width='90px' />
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
						Documento:
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
						Usuario:
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
				
				<tr align='center'>
					<td colspan='3' align='right'>
	<input type='submit' value='BORRAR DATOS PERMANENTEMENTE' style=\"color:#FF0000;font-weight: bold; \"/>
		<input type='hidden' name='borrar' value=1 />
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
	global $rf;
	
	$rf = $_POST['ref'];
	$nombre = $_POST['Nombre'];
	$apellido = $_POST['Apellidos'];
		
	$ActionTime = date('H:i:s');

	global $dir;
	$dir = "../Users/".$_SESSION['ref']."/log";

global $ddr;
global $deletet;	
global $text;
$text = PHP_EOL."- USER BAJAS BORRARDO ".$ActionTime.PHP_EOL."\t Nombre: ".$nombre." ".$apellido.PHP_EOL."\t Ref: ".$rf.". Nivel: ".$_POST['Nivel'].PHP_EOL."\t User: ".$_POST['Usuario'].". Pass: ".$_POST['Password'];

		$logdocu = $_SESSION['ref'];
		$logdate = date('Y_m_d');
		$logtext = $text.PHP_EOL.$deletet.PHP_EOL.$ddr;
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
$text = PHP_EOL."- USER BAJAS BORRAR SELECCIONADO ".$ActionTime.PHP_EOL."\t Nombre: ".$nombre." ".$apellido.PHP_EOL."\t Ref: ".$rf.". Nivel: ".$_POST['Nivel'].PHP_EOL."\t User: ".$_POST['Usuario'].". Pass: ".$_POST['Password'];

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