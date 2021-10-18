<?php

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
					<th style='text-align:center;' colspan=3  class='BorderInf'>
						NUEVOS DATOS DEL USUARIO
					</th>
				</tr>");

		global $rutaimg;
		$rutaimg = "src='../Users/".$_SESSION['sref']."/img_admin/".$_SESSION['new_name']."'";
		global $vertabla;
		$vertabla = 1;
		require 'table_data_resum.php';
												
		print("<tr>
					<td style='text-align:right !important;' colspan=3 class='BorderSup'>
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
	
	global $array_c;
	$array_c = 1;
	require 'admin_array_total.php';

	} elseif($_POST['imagenmodif']){ global $array_c;
									 $array_c = 1;
									 require 'admin_array_total.php'; }
	
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

		print("</td></tr></table>");

		}
		
	print("<table align='center'  border=0 style='margin-top:20px; width:95.5%'>
				<tr>
					<th colspan=2 class='BorderInf'>SELECCIONE UNA NUEVA IMAGEN.</th>
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
	<form name='form_datos' method='post' action='$_SERVER[PHP_SELF]' enctype='multipart/form-data'>
		<input type='file' name='myimg' id='myimg' value='".$defaults['myimg']."' class='inputfile custom' />
		<label for='myimg'><span id='file_name'>SELECCIONE UNA IMAGEN</span></label>
			</td>
				</tr>

				<tr align='center' height=30px>
					<td></td>
					<td>
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
					<td class='BorderSup'></td>
					<td align='right' class='BorderSup'></td>
				</tr>
				
				<tr>
					<td class='BorderSup'></td>
					<td align='right' class='BorderSup'>
			<form name='closewindow' action='$_SERVER[PHP_SELF]'  onsubmit=\"window.close()\">
						<input type='submit' value='CERRAR VENTANA' class='botonrojo' />
						<input type='hidden' name='oculto2' value=1 />
			</form>
					</td></tr></table>");

	}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////
	
	function master_index(){
		
		require '../Inclu_Menu/rutaadmin.php';
		require '../Inclu_Menu/Master_Index.php';
		
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

	require 'log_write.php';

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

	require 'log_write.php';

	}

?>