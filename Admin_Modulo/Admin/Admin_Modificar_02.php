<?php
session_start();

	//require '../Inclu/error_hidden.php';
	require '../Inclu/Admin_Inclu_01b.php';
	require '../Conections/conection.php';
	require '../Conections/conect.php';
	require '../Inclu/my_bbdd_clave.php';

/* OJO SOLO PARA VALIDATE.PHP
global $table_name_a;
$table_name_a = "`".$_SESSION['clave']."admin`";
$sqld =  "SELECT * FROM $table_name_a WHERE `ref` = '$_SESSION[ref]' AND `Usuario` = '$_SESSION[Usuario]'";
$qd = mysqli_query($db, $sqld);
$rowd = mysqli_fetch_assoc($qd);
*/

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

if (($_SESSION['Nivel'] == 'admin') || ($_SESSION['Nivel'] == 'user') || ($_SESSION['Nivel'] == 'plus')){

					master_index();

							if (isset($_POST['oculto2'])){
								show_form();
								info_01();
								}
							elseif($_POST['modifica']){
									if($form_errors = validate_form()){
										show_form($form_errors);
											} else {
												process_form();
												info_02();
												unset($_SESSION['refcl']);
												}
								} else { show_form(); }
				} else { require '../Inclu/table_permisos.php'; }

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function validate_form(){
	
		/*
		global $sqld;
		global $qd;
		global $rowd;
		*/
	
		require '../Inclu/validate.php';	
		
		return $errors;

		} 

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
	
	global $tabla;							 
	$tabla = "<table align='center' style=\"margin-top:20px\">
				<tr>
					<th colspan=3  class='BorderInf'>
						NUEVOS DATOS DEL USUARIO.
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
		<img src='../Users/".$_SESSION['refcl']."/img_admin/".$_SESSION['myimgcl']."' height='120px' width='90px' />
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
						Referencia Usuario
					</td>
					<td colspan=2>"
						.$_SESSION['refcl'].
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
						.$_POST['Tlf2']./*" / ".$_SESSION['dni']." / ".$_SESSION['mydni'].*/
					"</td>
				</tr>
				<tr>
					<td colspan=3 align='right' class='BorderSup'>
						<form name='closewindow' action='Admin_Modificar_01.php'  \">
							<input type='submit' value='VOLVER A ADMIN MODIFICAR' />
							<input type='hidden' name='volver' value=1 />
						</form>
					</td>
				</tr>
			</table>"; 

	global $table_name_a;
	$table_name_a = "`".$_SESSION['clave']."admin`";

	if ($_SESSION['Nivel'] == 'admin') {
		
	$sqlc = "UPDATE `$db_name`.$table_name_a SET `Nivel` = '$_POST[Nivel]', `Nombre` = '$_POST[Nombre]', `Apellidos` = '$_POST[Apellidos]', `doc` = '$_POST[doc]', `dni` = '$_POST[dni]', `ldni` = '$_POST[ldni]', `Email` = '$_POST[Email]', `Usuario` = '$_POST[Usuario]', `Password` = '$_POST[Password]', `Direccion` = '$_POST[Direccion]', `Tlf1` = '$_POST[Tlf1]', `Tlf2` = '$_POST[Tlf2]' WHERE $table_name_a.`id` = '$_POST[id]' LIMIT 1 ";

	if(mysqli_query($db, $sqlc)){ 	
		
	if (($_SESSION['dni'] == $_SESSION['mydni']) && ($_SESSION['id'] == $_POST['id']) && ($_POST['dni'] != $_SESSION['mydni'])) { 	$_SESSION['dni'] = $_POST['dni'];
							// CREA EL ARCHIVO MYDNI.TXT $_SESSION['mydni'].
							$filename = "../Inclu/mydni.php";
							$fw2 = fopen($filename, 'w+');
							$mydni = '<?php $_SESSION[\'mydni\'] = '.$_POST['dni'].'; ?>';
							fwrite($fw2, $mydni);
							fclose($fw2);
										}
	elseif (($_SESSION['dni'] != $_SESSION['mydni']) && ($_SESSION['id'] == $_POST['id']) && ($_POST['dni'] != $_SESSION['dni'])) { 
							$_SESSION['dni'] = $_POST['dni'];
					}else{ }
								 
					require '../Inclu/mydni.php';

				global $tabla;
				print( $tabla );

				} else {
				print("<font color='#FF0000'>
						* MODIFIQUE LA ENTRADA 220: </font>
						</br>
						&nbsp;&nbsp;&nbsp;".mysqli_error($db))."
						</br>";
						show_form ();
						global $texerror;
						$texerror = "\n\t ".mysqli_error($db);
							}
		
					} // FIN CONDICIONAL ADMIN
	
	elseif (($_SESSION['Nivel'] == 'user') || ($_SESSION['Nivel'] == 'plus')){
		
			$sqlc = "UPDATE `$db_name`.$table_name_a SET `Nivel` = '$_POST[Nivel]', `Nombre` = '$_POST[Nombre]', `Apellidos` = '$_POST[Apellidos]', `Email` = '$_POST[Email]', `Direccion` = '$_POST[Direccion]', `Tlf1` = '$_POST[Tlf1]', `Tlf2` = '$_POST[Tlf2]' WHERE $table_name_a.`id` = '$_POST[id]' LIMIT 1 ";

	if(mysqli_query($db, $sqlc)){ global $tabla;
								  print( $tabla );
				} else {
				print("<font color='#FF0000'>
						* MODIFIQUE LA ENTRADA 241: </font>
						</br>
						&nbsp;&nbsp;&nbsp;".mysqli_error($db))."
						</br>";
						show_form ();
						global $texerror;
						$texerror = "\n\t ".mysqli_error($db);
							}
					} // FIN CONDICIONAL USER / PLUS
	
 	} // FIN FUNCTION PROCESS_FORM

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////
			
function show_form($errors=''){
	
			require '../Inclu/mydni.php';

	if($_POST['oculto2']){

				$_SESSION['refcl'] = $_POST['ref'];
				$_SESSION['myimgcl'] = $_POST['myimg'];
				
				global $dt;
				$dt = $_POST['doc'];
		
				$defaults = array ( 'id' => $_POST['id'],
									'ref' => $_POST['ref'],
									'Nombre' => $_POST['Nombre'],
									'Apellidos' => $_POST['Apellidos'],
									'myimg' => $_SESSION['myimgcl'],
									'Nivel' => $_POST['Nivel'],			
									'doc' => $dt,
									'dni' => $_POST['dni'],
									'ldni' => $_POST['ldni'],
									'Email' => $_POST['Email'],
									'Usuario' => $_POST['Usuario'],
									'Usuario2' => $_POST['Usuario'],
									'Password' => $_POST['Password'],
									'Password2' => $_POST['Password'],
									'Direccion' => $_POST['Direccion'],
									'Tlf1' => $_POST['Tlf1'],
									'Tlf2' => $_POST['Tlf2']);
												}
								   
		elseif($_POST['modifica']){
			
			global $dt;
			$dt = $_POST['doc'];
			
			$defaults = array ( 'id' => $_POST['id'],
								'ref' => $_SESSION['refcl'],
								'Nombre' => $_POST['Nombre'],
								'Apellidos' => $_POST['Apellidos'],
								'myimg' => $_SESSION['myimgcl'],
								'Nivel' => $_POST['Nivel'],						
								'doc' => $dt,
								'dni' => $_POST['dni'],
								'ldni' => $_POST['ldni'],
								'Email' => $_POST['Email'],
								'Usuario' => $_POST['Usuario'],
								'Usuario2' => $_POST['Usuario2'],
								'Password' => $_POST['Password'],
								'Password2' => $_POST['Password2'],
								'Direccion' => $_POST['Direccion'],
								'Tlf1' => $_POST['Tlf1'],
								'Tlf2' => $_POST['Tlf2']);
												}
	
	if ($errors){
		print("<table align='center'>
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
		
	$Nivel = array (	'' => 'NIVEL USUARIO',
						'admin' => 'ADMINISTRADOR',
						'plus' => 'USER PLUS',
						'user'  => 'USER',
						'close'  => 'CLOSE', );														

	$doctype = array (	'DNI' => 'DNI/NIF Espa&ntilde;oles',
						'NIE' => 'NIE/NIF Extranjeros',
						'NIFespecial' => 'NIF Persona F&iacute;sica Especial',
						'NIFsa' => 'NIF Sociedad An&oacute;nima',
						'NIFsrl' => 'NIF Sociedad Responsabilidad Limitada',
						'NIFscol' => 'NIF Sociedad Colectiva',
						'NIFscom' => 'NIF Sociedad Comanditaria',
						'NIFcbhy' => 'NIF Comunidad Bienes y Herencias Yacentes',
						'NIFscoop' => 'NIF Sociedades Cooperativas',
						'NIFasoc' => 'NIF Asociaciones',
						'NIFcpph' => 'NIF Comunidad Propietarios Propiedad Horizontal',
						'NIFsccspj' => 'NIF Sociedad Civil, con o sin Personalidad Juridica',
						'NIFee' => 'NIF Entidad Extranjera',
						'NIFcl' => 'NIF Corporaciones Locales',
						'NIFop' => 'NIF Organismo Publico',
						'NIFcir' => 'NIF Congragaciones Instituciones Religiosas',
						'NIFoaeca' => 'NIF Organos Admin Estado y Comunidades Autonomas',
						'NIFute' => 'NIF Uniones Temporales de Empresas',
						'NIFotnd' => 'NIF Otros Tipos no Definidos',
						'NIFepenr' => 'NIF Establecimientos Permanentes Entidades no Residentes',
										);
	
	if ($_SESSION['Nivel'] == 'admin'){
	
	print("<table align='center' border=0>
				<tr>
					<th colspan=2 class='BorderInf'>
			<img src='../Users/".$_SESSION['refcl']."/img_admin/".$_POST['myimg']."' height='44px' width='33px' />
						</br>INTRODUZCA LOS NUEVOS DATOS EN EL FORMULARIO.
					</th>
				</tr>
				
		<form name='form_datos' method='post' action='$_SERVER[PHP_SELF]'>
			
		<input name='id' type='hidden' value='".$defaults['id']."' />					
		<input name='myimg' type='hidden' value='".$_POST['myimg']."' />					
				<tr>
					<td>	
						<font color='#FF0000'>*</font>
						Referencia Usuario:
					</td>
					<td>
		<input name='ref' type='hidden' value='".$_SESSION['refcl']."' />".$defaults['ref']."			
					</td>
				</tr>
					
				<tr>
					<td>	
						<font color='#FF0000'>*</font>
						Nombre:
					</td>
					<td>
		<input type='text' name='Nombre' size=28 maxlength=25 value='".$defaults['Nombre']."' />
					</td>
				</tr>
					
				<tr>
					<td>
						<font color='#FF0000'>*</font>
						Apellidos:
					</td>
					<td>
	<input type='text' name='Apellidos' size=28 maxlength=25 value='".$defaults['Apellidos']."' />
					</td>
				</tr>

				<tr>
					<td>
						<font color='#FF0000'>*</font>
						Tipo Documento:
					</td>
					<td>
		<select name='doc'>");
				foreach($doctype as $option => $label2){
					print ("<option value='".$option."' ");
					if($option == $defaults['doc']){print ("selected = 'selected'");}
													print ("> $label2 </option>");
												}	
	print ("</select>
					</td>
				</tr>
				<tr>
					<td>
						<font color='#FF0000'>*</font>
						N&uacute;mero:
					</td>
					<td>
		<input type='text' name='dni' size=28 maxlength=8 value='".$defaults['dni']."' />
					</td>
				</tr>
				
				<tr>
					<td>
						<font color='#FF0000'>*</font>
						Control::
					</td>
					<td>
		<input type='text' name='ldni' size=4 maxlength=1 value='".$defaults['ldni']."' />
					</td>
				</tr>
				
				<tr>
					<td>
						<font color='#FF0000'>*</font>
						Mail:
					</td>
					<td>
		<input type='text' name='Email' size=52 maxlength=50 value='".$defaults['Email']."' />
					</td>
				</tr>	
				
				<tr>
					<td>
						<font color='#FF0000'>*</font>
						Nivel Usuario:
					</td>
					<td>
		<select name='Nivel'>");
				foreach($Nivel as $optionnv => $labelnv){
					print ("<option value='".$optionnv."' ");
					if($optionnv == $defaults['Nivel']){print ("selected = 'selected'");}
													print ("> $labelnv </option>");
												}	
	print ("</select>
					</td>
				</tr>
					
				<tr>
					<td>
						<font color='#FF0000'>*</font>
						Nombre de Usuario:
					</td>
					<td>
		<input type='text' name='Usuario' size=12 maxlength=10 value='".$defaults['Usuario']."' />
					</td>
				</tr>
				
				<tr>
					<td>
						<font color='#FF0000'>*</font>
						Confirme el Usuario:
					</td>
					<td>
		<input type='text' name='Usuario2' size=12 maxlength=10 value='".$defaults['Usuario2']."' />
					</td>
				</tr>
							
				<tr>
					<td>
						<font color='#FF0000'>*</font>
						Password:
					</td>
					<td>
		<input type='text' name='Password' size=12 maxlength=10 value='".$defaults['Password']."' />
					</td>
				</tr>

				<tr>
					<td>
						<font color='#FF0000'>*</font>
						Confirme el Password:
					</td>
					<td>
	<input type='text' name='Password2' size=12 maxlength=10 value='".$defaults['Password2']."' />
					</td>
				</tr>

				<tr>
					<td>
						<font color='#FF0000'>*</font>
						Dirección:
					</td>
					<td>
	<input type='text' name='Direccion' size=52 maxlength=60 value='".$defaults['Direccion']."' />
					</td>
				</tr>
				
				<tr>
					<td>
						<font color='#FF0000'>*</font>
						Teléfono 1:
					</td>
					<td>
		<input type='text' name='Tlf1' size=12 maxlength=9 value='".$defaults['Tlf1']."' />
					</td>
				</tr>
				
				<tr>
					<td>
						<font color='#FF0000'>*</font>
						Teléfono 2:
					</td>
					<td>
		<input type='text' name='Tlf2' size=12 maxlength=9 value='".$defaults['Tlf2']."' />
					</td>
				</tr>
				
				<tr height=40px>
					<td colspan='2' align='right'>
						<input type='submit' value='MODIFICAR DATOS' />
						<input type='hidden' name='modifica' value=1 />
						
					</td>
				</tr>
			</form>														
		</table>");

	} // FIN IF ADMIN
	
	elseif(($_SESSION['Nivel'] == 'user') || ($_SESSION['Nivel'] == 'plus')){
	
			print("<table align='center' border=0>
				<tr>
					<th colspan=2 class='BorderInf'>
<img src='../Users/".$_SESSION['refcl']."/img_admin/".$_POST['myimg']."' height='44px' width='33px' />
						INTRODUZCA LOS NUEVOS DATOS EN EL FORMULARIO.
					</th>
				</tr>
				
		<form name='form_datos' method='post' action='$_SERVER[PHP_SELF]'>
			
		<input name='id' type='hidden' value='".$defaults['id']."' />					
		<input name='myimg' type='hidden' value='".$_POST['myimg']."' />					
				<tr>
					<td>	
						<font color='#FF0000'>*</font>
						Referencia Usuario:
					</td>
					<td>
		<input name='ref' type='hidden' value='".$_SESSION['refcl']."' />".$defaults['ref']."			
					</td>
				</tr>
					
				<tr>
					<td>	
						<font color='#FF0000'>*</font>
						Nombre:
					</td>
					<td>
		<input type='text' name='Nombre' size=28 maxlength=25 value='".$defaults['Nombre']."' />
					</td>
				</tr>
					
				<tr>
					<td>
						<font color='#FF0000'>*</font>
						Apellidos:
					</td>
					<td>
		<input type='text' name='Apellidos' size=28 maxlength=25 value='".$defaults['Apellidos']."' />
					</td>
				</tr>

				<tr>
					<td>
						<font color='#FF0000'>*</font>
						Tipo Documento:
					</td>
					<td>
		<input type='hidden' name='doc' value='".$defaults['doc']."' />".$defaults['doc']."
					</td>
				</tr>
				<tr>
					<td>
						<font color='#FF0000'>*</font>
						N&uacute;mero:
					</td>
					<td>
		<input type='hidden' name='dni' value='".$defaults['dni']."' />".$defaults['dni']."
					</td>
				</tr>
				
				<tr>
					<td>
						<font color='#FF0000'>*</font>
						Control::
					</td>
					<td>
		<input type='hidden' name='ldni' value='".$defaults['ldni']."' />".$defaults['ldni']."
					</td>
				</tr>
				
				<tr>
					<td>
						<font color='#FF0000'>*</font>
						Mail:
					</td>
					<td>
		<input type='text' name='Email' size=52 maxlength=50 value='".$defaults['Email']."' />
					</td>
				</tr>	
				
				<tr>
					<td>
						<font color='#FF0000'>*</font>
						Nivel Usuario:
					</td>
					<td>
		<input type='hidden' name='Nivel' value='".$defaults['Nivel']."' />".$defaults['Nivel']."
					</td>
				</tr>
					
				<tr>
					<td>
						<font color='#FF0000'>*</font>
						Nombre de Usuario:
					</td>
					<td>
		<input type='hidden' name='Usuario' value='".$defaults['Usuario']."' />".$defaults['Usuario']."
					</td>
				</tr>
				
		<input type='hidden' name='Usuario2' value='".$defaults['Usuario2']."' />
							
				<tr>
					<td>
						<font color='#FF0000'>*</font>
						Password:
					</td>
					<td>
		<input type='hidden' name='Password' value='".$defaults['Password']."' />".$defaults['Password']."
					</td>
				</tr>
		<input type='hidden' name='Password2' value='".$defaults['Password2']."' />
				<tr>
					<td>
						<font color='#FF0000'>*</font>
						Dirección:
					</td>
					<td>
		<input type='text' name='Direccion' size=52 maxlength=60 value='".$defaults['Direccion']."' />
					</td>
				</tr>
				
				<tr>
					<td>
						<font color='#FF0000'>*</font>
						Teléfono 1:
					</td>
					<td>
		<input type='text' name='Tlf1' size=12 maxlength=9 value='".$defaults['Tlf1']."' />
					</td>
				</tr>
				
				<tr>
					<td>
						<font color='#FF0000'>*</font>
						Teléfono 2:
					</td>
					<td>
		<input type='text' name='Tlf2' size=12 maxlength=9 value='".$defaults['Tlf2']."' />
					</td>
				</tr>
				
				<tr height=40px>
					<td colspan='2' align='right'>
						<input type='submit' value='MODIFICAR DATOS' />
						<input type='hidden' name='modifica' value=1 />
						
					</td>
				</tr>
			</form>														
		</table>");

			} // FIN ELSE IF USER / PLUS
	
	} // FIN FUNCTION SHOW_FOMR

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////
	
	function master_index(){
		
				require '../'.$_SESSION['menu'].'/Master_Index_Admin.php';
		
				} 

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function info_02(){

	global $ruta;
	
	$ActionTime = date('H:i:s');
	
	if($_SESSION['refcl'] == $_SESSION['ref']){	global $ruta;
												$ruta = $_SESSION['refcl'];}
	elseif($_SESSION['refcl'] != $_SESSION['ref']){	global $ruta;
													$ruta = $_SESSION['ref'];}
	
	global $dir;
	$dir = "../Users/".$_SESSION['ref']."/log";
	
	global $text;
	$text = PHP_EOL."- USER MODIFICADO ".$ActionTime.PHP_EOL."\t ID:".$_POST['id'].PHP_EOL."\t Nombre: ".$_POST['Nombre']." ".$_POST['Apellidos'].PHP_EOL."\t Ref: ".$_SESSION['ref'].PHP_EOL."\t Nivel: ".$_POST['Nivel'].PHP_EOL."\t User: ".$_POST['Usuario'].".\n\t Pass: ".$_POST['Password'].".\n\t ".$_POST['doc'].": ".$_POST['dni'].$_POST['ldni'].".\n\t Email: ".$_POST['Email'].PHP_EOL."\t Direccion: ".$_POST['Direccion'].PHP_EOL."\t Telefono 1: ".$_POST['Tlf1'].PHP_EOL."\t Telefono 2: ".$_POST['Tlf2'].PHP_EOL."\t Imagen: ".$_POST['myimg'];

	$logdocu = $ruta;
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

	global $texerror;

	global $orden;
	$orden = isset($_POST['Orden']);	

	$ActionTime = date('H:i:s');

	global $dir;
	$dir = "../Users/".$_SESSION['ref']."/log";
	
	global $text;
	$text = PHP_EOL."- USER MODIFICAR SELECCIONADO ".$ActionTime.PHP_EOL."\t ID:".$_POST['id'].PHP_EOL."\t Nombre: ".$_POST['Nombre']." ".$_POST['Apellidos'].PHP_EOL."\t Ref: ".$_POST['ref'].PHP_EOL."\t Nivel: ".$_POST['Nivel'].PHP_EOL."\t User: ".$_POST['Usuario'].".\n\t Pass: ".$_POST['Password'].".\n\t ".$_POST['doc'].": ".$_POST['dni'].$_POST['ldni'].".\n\t Email: ".$_POST['Email'].PHP_EOL."\t Direccion: ".$_POST['Direccion'].PHP_EOL."\t Telefono 1: ".$_POST['Tlf1'].PHP_EOL."\t Telefono 2: ".$_POST['Tlf2'].PHP_EOL."\t Imagen: ".$_POST['myimg'];

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

	require '../Inclu/Admin_Inclu_02.php';

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

/* Creado por Juan Barros Pazos 2020 */
?>