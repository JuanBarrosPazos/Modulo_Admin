
<?php
session_start();

	require '../Inclu/error_hidden.php';
	require '../Inclu/Admin_head.php';

	require '../Conections/conection.php';
	require '../Conections/conect.php';
	require '../Inclu/my_bbdd_clave.php';

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
				
	require 'Admin_Botonera.php';

	print("	<tr>
				<td colspan=3 align='right' class='BorderSup'>
					".$inicioadmin.$inciobajas."
				</td>
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

	if($_POST['oculto2']){ 	$_SESSION['sref'] = $_POST['ref'];
							global $array_a;
							$array_a = 1;
							require 'admin_array_total.php'; 
								}
	
	print("<table style=\"margin-top:2px\">
				<tr>
					<td colspan=3 class='BorderInf'>
						DATOS DEL USER A RECUPERAR.
					</td>
				</tr>
				<tr>
					<th colspan=3 class='BorderInf' style=\"text-align:right\">
							<a href='Feedback_Ver.php' >CANCELAR Y VOLVER</a>
						</font>
					</th>
				</tr>
				
		<form name='form_datos' method='post' action='$_SERVER[PHP_SELF]'>");
			
			require 'admin_input_default_a.php';
			require 'feedback_table_show_form.php';
				
		print("<tr height=40px>
					<td style='text-align:right !important;' colspan='3' class='BorderSup'>
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
		
		require '../Inclu_Menu/rutaadmin.php';
		require '../Inclu_Menu/Master_Index.php';
		
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
	$text = PHP_EOL."- ADMIN FEEDBACK RECUPERADO ".$ActionTime.PHP_EOL."\t Nombre: ".$nombre." ".$apellido.PHP_EOL."\t Ref: ".$rf.". Nivel: ".$_POST['Nivel'].PHP_EOL."\t User: ".$_POST['Usuario'].". Pass: ".$_POST['Pass'].$texerror;

	require 'log_write.php';

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

	require 'log_write.php';

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