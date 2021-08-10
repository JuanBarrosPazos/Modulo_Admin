<?php

function process_form(){
	
	global $db;
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

	print ("<table align='center'>
				<tr>
					<td colspan=3  class='BorderInf'>
						SE HAN BORRADO TODOS LOS DATOS.
					</td>
				</tr>");
	
		global $rutaimg;
		$rutaimg = "src='../Users/temp/".$_POST['myimg']."'";
		require 'table_data_resum.php';
		require 'table_data_resum_feed.php';

	print("	<tr>
				<td colspan=3 class='BorderSup'>
					<form name='closewindow' action='Feedback_Ver.php'>
						<input type='submit' value='ADMIN BAJAS VOLVER' class='botonverde' />
						<input type='hidden' name='volver' value=1 />
					</form>
				</td>
			</tr>
		</table>"); // SE IMPRIME LA TABLA DE CONFIRMACION

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

	if($_POST['oculto2']){	$_SESSION['sref'] = $_POST['ref'];
							global $array_a;
							$array_a = 1;
							require 'admin_array_total.php'; 
				}

	if(@$_POST['borrar']){  global $array_a;
							$array_a = 1;
							require 'admin_array_total.php'; }
								   
	print("<table style=\"margin-top:2px\">
				<tr>
					<th colspan=3 class='BorderInf'>
						<font color='#FF0000'>
						SE BORRARÁN Y NO SE PODRÁN VOLVER A RECUPERAR.
						</font>
					</th>
				</tr>

				<tr>
					<th colspan=3 class='BorderInf' style=\"text-align:right\">
							<a href='Feedback_Ver.php' >CANCELAR Y VOLVER</a>
					</th>
				</tr>
				
		<form name='form_datos' method='post' action='$_SERVER[PHP_SELF]'>");
			
			require 'admin_input_default_a.php';
			require 'feedback_table_show_form.php';

		 print("<tr>
					<td colspan='3' class='BorderSup'>
		<input type='submit' value='BORRAR DATOS PERMANENTEMENTE' class='botonrojo' />
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
		
		require '../Inclu_Menu/rutaadmin.php';
		require '../Inclu_Menu/Master_Index.php';
		
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
	$text = PHP_EOL."- USER BAJAS BORRARDO ".$ActionTime.PHP_EOL."\t Nombre: ".$nombre." ".$apellido.PHP_EOL."\t Ref: ".$rf.". Nivel: ".$_POST['Nivel'].PHP_EOL."\t User: ".$_POST['Usuario'].". Pass: ".$_POST['Pass'].$deletet.PHP_EOL.$ddr;

	require 'log_write.php';

	}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function info_01(){

		
	global $rf;
	$rf = @$_POST['ref'];
	global $nombre;
	$nombre = @$_POST['Nombre'];
	global $apellido;
	$apellido = @$_POST['Apellidos'];
		
	global $orden;
	$orden = @$_POST['Orden'];
		
	$ActionTime = date('H:i:s');
	
	global $dir;
	$dir = "../Users/".$_SESSION['ref']."/log";

	global $text;
	$text = PHP_EOL."- USER BAJAS BORRAR SELECCIONADO ".$ActionTime.PHP_EOL."\t Nombre: ".$nombre." ".$apellido.PHP_EOL."\t Ref: ".$rf.". Nivel: ".$_POST['Nivel'].PHP_EOL."\t User: ".$_POST['Usuario'].". Pass: ".$_POST['Pass'];

	require 'log_write.php';

	}

?>