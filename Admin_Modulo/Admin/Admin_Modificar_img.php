<?php
session_start();

	require '../Inclu/error_hidden.php';
	require '../Inclu/Admin_Inclu_popup.php';
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

if (($_SESSION['Nivel'] == 'admin')||($_SESSION['Nivel'] == 'user') || ($_SESSION['Nivel'] == 'plus')){

 		//print("Hello ".$_SESSION['Nombre']." ".$_SESSION['Apellidos'].".</br>");
				
			if (isset($_POST['oculto2'])){ show_form();
										   info_01();
									}
							elseif($_POST['imagenmodif']){
									if($form_errors = validate_form()){
										show_form($form_errors);
											} else { process_form();
													 info_02();
														}
								} else { show_form(); }
			} else { require '../Inclu/table_permisos.php'; }

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function validate_form(){
	
	$errors = array();

	$limite = 500 * 1024;
	
	$ext_permitidas = array('jpg','JPG','gif','GIF','png','PNG','bmp','BMP');
	$extension = substr($_FILES['myimg']['name'],-3);
	// print($extension);
	// $extension = end(explode('.', $_FILES['myimg']['name']) );
	$ext_correcta = in_array($extension, $ext_permitidas);

	// $tipo_correcto = preg_match('/^image\/(gif|png|jpg|bmp)$/', $_FILES['myimg']['type']);

		if($_FILES['myimg']['size'] == 0){
			$errors [] = "Ha de seleccionar una fotograf&iacute;a.";
			global $img2;
			$img2 = 'untitled.png';
		}
		 
		elseif(!$ext_correcta){
			$errors [] = "La extension no esta admitida: ".$_FILES['myimg']['name'];
			global $img2;
			$img2 = 'untitled.png';
			}
	/*
		elseif(!$tipo_correcto){
			$errors [] = "Este tipo de archivo no esta admitido: ".$_FILES['myimg']['name'];
			global $img2;
			$img2 = 'untitled.png';
			}
	*/
		elseif ($_FILES['myimg']['size'] > $limite){
		$tamanho = $_FILES['myimg']['size'] / 1024;
		$errors [] = "El archivo".$_FILES['myimg']['name']." es mayor de 500 KBytes. ".$tamanho." KB";
		global $img2;
		$img2 = 'untitled.png';
			}
		
			elseif ($_FILES['myimg']['error'] == UPLOAD_ERR_PARTIAL){
				$errors [] = "La carga del archivo se ha interrumpido.";
				global $img2;
				$img2 = 'untitled.png';
				}
				
				elseif ($_FILES['myimg']['error'] == UPLOAD_ERR_NO_FILE){
					$errors [] = "Es archivo no se ha cargado.";
					global $img2;
					$img2 = 'untitled.png';
					}
					
		return $errors;

		} 

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function process_form(){
	
	global $db;
	global $safe_filename;
	
	$safe_filename = trim(str_replace('/', '', $_FILES['myimg']['name']));
	$safe_filename = trim(str_replace('..', '', $safe_filename));

	$nombre = $_FILES['myimg']['name'];
	//$nombre_tmp = $_FILES['myimg']['tmp_name'];
	//$tipo = $_FILES['myimg']['type'];
	//$tamano = $_FILES['myimg']['size'];
		  
	global $destination_file;
	$destination_file = '../Users/'.$_SESSION['sref'].'/img_admin/'.$safe_filename;
	

	if( file_exists( '../Users/'.$_SESSION['sref'].'/img_admin/'.$safe_filename) ){
		unlink('../Users/'.$_SESSION['sref'].'/img_admin/'.$safe_filename);
			}
			
	elseif (move_uploaded_file($_FILES['myimg']['tmp_name'], $destination_file)){
		
	if( file_exists( '../Users/'.$_SESSION['sref'].'/img_admin/'.$_SESSION['smyimg']) ){
			unlink('../Users/'.$_SESSION['sref'].'/img_admin/'.$_SESSION['smyimg']);
		}else{}
	
		// Renombrar el archivo:
		$extension = substr($_FILES['myimg']['name'],-3);
		// print($extension);
		// Presuntamente deprecated
		// $extension = end(explode('.', $_FILES['myimg']['name']) );
		date('H:i:s');
		date('Y_m_d');
		$dt = date('is');
		global $new_name;
		$nn = $_SESSION['sref'];
		$new_name = $nn."_".$dt.".".$extension;
		global $rename_filename;
		$rename_filename = "../Users/".$_SESSION['sref']."/img_admin/".$new_name;	
		rename($destination_file, $rename_filename);
		$_SESSION['new_name'] = $new_name;

	global $db;
	global $db_name;
	global $nombre;
	global $apellido;

	global $table_name_a;
	$table_name_a = "`".$_SESSION['clave']."admin`";

	$nombre = $_POST['Nombre'];
	$apellido = $_POST['Apellidos'];
	
	$sqlc = "UPDATE `$db_name`.$table_name_a SET `myimg` = '$new_name' WHERE $table_name_a.`id` = '$_POST[id]' LIMIT 1 ";

	if(mysqli_query($db, $sqlc)){

		if ($_SESSION['sref'] == $_SESSION['ref']){ $_SESSION['myimg'] = $new_name;  }
		else { }

		print( "<table align='center' style=\"margin-top:20px\">
				<tr>
					<th colspan=3  class='BorderInf'>
						Estos son los nuevos datos de registro.
					</th>
				</tr>
				
				<tr>
					<td width=150px>
						Nombre:
					</td>
					<td width=200px>"
						.$_POST['Nombre'].
					"</td>
					<td rowspan='5' align='center'>
	<img src='../Users/".$_SESSION['sref']."/img_admin/".$_SESSION['new_name']."' height='120px' width='90px' />
					</td>
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
					<td>"
						.$_POST['dni'].
					"</td>
				</tr>				
				
				<tr>
					<td>
						Control:
					</td>
					<td>"
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
						Tipo Usuario
					</td>
					<td colspan=2>"
						.$_POST['Nivel'].
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
						.$_POST['Pass'].
					"</td>
				</tr>
				
				<tr>
					<td>
						Dirección:
					</td>
					<td colspan=2>"
						.$_POST['Direccion'].
					"</td>
				</tr>
				
				<tr>
					<td>
						Teléfono 1:
					</td>
					<td colspan=2>"
						.$_POST['Tlf1'].
					"</td>
				</tr>
				
				<tr>
					<td>
						Teléfono 2:
					</td>
					<td colspan=2>"
						.$_POST['Tlf2'].
					"</td>
				</tr>
												
				<tr>
					<td colspan=3 align='right' class='BorderSup'>
		<form name='closewindow' action='$_SERVER[PHP_SELF]'  onsubmit=\"window.close()\">
						<input type='submit' value='CERRAR VENTANA' class='botonrojo' />
						<input type='hidden' name='oculto2' value=1 />
		</form>
					</td>
				</tr>
			</table>" );
				} else {
				print("<font color='#FF0000'>
						* ESTOS DATOS NO SON VALIDOS, MODIFIQUE ESTA ENTRADA: </font>
						</br>
						&nbsp;&nbsp;&nbsp;".mysqli_error($db))."
						</br>";
						show_form ();
							}
					// print("El archivo se ha guardado en: ".$destination_file);
			}else {
					print("No se ha podido guardar el archivo en el direcctorio img_admin/");
					}

	} // FIN PROCESS FORM

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function show_form($errors=[]){
	
	global $dt;

	$id = $_POST['id'];
	$img = 	isset($_POST['myimg']);
	$dt = $_POST['doc'];

	if(isset($_POST['oculto2'])){

	$_SESSION['smyimg'] = $_POST['myimg'];
	$_SESSION['sref'] = $_POST['ref'];
	$_SESSION['sid'] = $_POST['id'];
	$_SESSION['sdni'] = $_POST['dni'];
	
				$defaults = array ( 'id' => $_POST['id'],
									'Nombre' => $_POST['Nombre'],
									'Apellidos' => $_POST['Apellidos'],
									'myimg' => $img,
									'ref' =>  $_SESSION['sref'],
									'Nivel' => $_POST['Nivel'],
								    'doc' => $_POST['doc'],
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
									'Tlf2' => $_POST['Tlf2']);
								   		}
								   
		elseif($_POST['imagenmodif']){

				$defaults = array ( 'id' => $_POST['id'],
									'Nombre' => $_POST['Nombre'],
									'Apellidos' => $_POST['Apellidos'],
									'ref' => $_SESSION['sref'],
									'myimg' => isset($_POST['myimg']),
									'Nivel' => $_POST['Nivel'],
								    'doc' => $_POST['doc'],
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
									'Tlf2' => $_POST['Tlf2']);
										}
	
	if ($errors){
		print("	<table align='center'>
					<tr>
						<th style='text-align:center'>
							<font color='#FF0000'>* SOLUCIONE ESTOS ERRORES:</font><br/>
						</th>
					</tr>
					<tr>
						<td style='text-align:left'>");
					
			for($a=0; $c=count($errors), $a<$c; $a++){
						print("<font color='#FF0000'>**</font>  ".$errors [$a]."<br/>");
						}

		print("</td>
				</tr>
				 </table>");
				}
		
	print("<table align='center'  border=0 style='margin-top:20px; width:95.5%'>
				<tr>
					<th colspan=2 class='BorderInf'>
						SELECCIONE UNA NUEVA IMAGEN.
					</th>
				</tr>
				
				<tr>
					<th class='BorderInf'>
				LA IMAGEN ACTUAL DE : </br>".$defaults['Nombre']." ".$defaults['Apellidos'].".
					</th>
					<th class='BorderInf'>
<img src='../Users/".$_SESSION['sref']."/img_admin/".$_SESSION['smyimg']."' height='120px' width='90px' />
					</th>
				</tr>
				
				<tr align='center'>
					<td colspan=2>
	<form name='form_datos' method='post' action='$_SERVER[PHP_SELF]'  enctype='multipart/form-data'>
		<input type='file' name='myimg' id='myimg' value='".$defaults['myimg']."' class='inputfile custom' />
		<label for='myimg'><span id='file_name'>SELECCIONE UNA IMAGEN</span></label>
			</td>
				</tr>

				<tr align='center' height=30px>
					<td>
					</td>
					<td >
						<input type='hidden' name='id' value='".$defaults['id']."' />					
						<input type='hidden' name='ref' value='".$_SESSION['sref']."' />					
						<input type='hidden' name='Nombre' value='".$defaults['Nombre']."' />
						<input type='hidden' name='Apellidos' value='".$defaults['Apellidos']."' />
						<input type='hidden' name='doc' value='".$defaults['doc']."' />
						<input type='hidden' name='dni' value='".$defaults['dni']."' />
						<input type='hidden' name='ldni' value='".$defaults['ldni']."' />
						<input type='hidden' name='Email' value='".$defaults['Email']."' />
						<input type='hidden' name='Nivel' value='".$defaults['Nivel']."' />
						<input type='hidden' name='Usuario' value='".$defaults['Usuario']."' />
						<input type='hidden' name='Usuario2' value='".$defaults['Usuario2']."' />
						<input type='hidden' name='Password' value='".$defaults['Password']."' />
						<input type='hidden' name='Password2' value='".$defaults['Password2']."' />
						<input type='hidden' name='Pass' value='".$defaults['Pass']."' />
						<input type='hidden' name='Direccion' value='".$defaults['Direccion']."' />
						<input type='hidden' name='Tlf1' value='".$defaults['Tlf1']."' />
						<input type='hidden' name='Tlf2' value='".$defaults['Tlf2']."' />

						<input type='submit' value='MODIFICAR IMAGEN' class='botonnaranja' />
						<input type='hidden' name='imagenmodif' value=1 />
		</form>																				
					</td>
				</tr>
			
				<tr>
					<td class='BorderSup'>
					</td>
					<td align='right' class='BorderSup'>
					</td>
				</tr>
				
				<tr>
					<td class='BorderSup'>
					</td>
					<td align='right' class='BorderSup'>
			<form name='closewindow' action='$_SERVER[PHP_SELF]'  onsubmit=\"window.close()\">
											<input type='submit' value='CERRAR VENTANA' class='botonrojo' />
											<input type='hidden' name='oculto2' value=1 />
			</form>
					</td>
				</tr>
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
	global $destination_file;	
	global $rename_filename;

	$ActionTime = date('H:i:s');

	$rf = $_POST['ref'];

	global $dir;
	$dir = "../Users/".$_SESSION['ref']."/log";

	global $text;
	$text = PHP_EOL."- ADMIN MODIFICAR IMG MODIFICADA ".$ActionTime.PHP_EOL."\t ID:".$_POST['id'].PHP_EOL."\t Nombre: ".$nombre." ".$apellido.PHP_EOL."\t Ref: ".$rf.PHP_EOL."\t Upload Imagen: ".$destination_file.PHP_EOL."\t Rename Imagen: ".$rename_filename;

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

	$ActionTime = date('H:i:s');

	$rf = $_POST['ref'];
	$nombre = $_POST['Nombre'];
	$apellido = $_POST['Apellidos'];

	global $dir;
	$dir = "../Users/".$_SESSION['ref']."/log";

	global $text;
	$text = PHP_EOL."- ADMIN MODIFICAR IMG SELECCIONADA ".$ActionTime.PHP_EOL."\t ID:".$_POST['id'].PHP_EOL."\t Nombre: ".$nombre." ".$apellido.PHP_EOL."\t Ref: ".$rf.PHP_EOL."\t Imagen: ".$_POST['myimg'];

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