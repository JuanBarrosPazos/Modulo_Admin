<?php

	require '../Inclu/error_hidden.php';
	require '../Inclu/Admin_Inclu_head.php';
	require '../Conections/conection.php';
	require '../Conections/conect.php';
	require '../Inclu/my_bbdd_clave.php';

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	if(isset($_POST['inscancel'])){	
				config_one();
				print("<table align='center' style=\"margin-top:12px;\">
							<tr>
								<td>
				 					<a href='../index.php'>
										ACCEDA AL SISTEMA
				 					</a>
			 					</td>
							 </tr>
						</table>");
						}
	elseif(isset($_POST['oculto'])){
		if($form_errors = validate_form()){
				show_form($form_errors);
									} else {process_form();
														}
	} else {show_form();}
								
				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function config_one(){
	
	if(file_exists('../index.php')){unlink("../index.php");
					$data1 = PHP_EOL."\t UNLINK ../index.php";}
			else {print("DON`T UNLINK ../index.php </br>");
					$data1 = PHP_EOL."\t DON`T UNLINK ../index.php";}

	if(!file_exists('../index.php')){
			if(file_exists('index_Play_System.php')){
				copy("index_Play_System.php", "../index_Play_System.php");
				$data2 = PHP_EOL."\t COPY ../index_Play_System.php";
				} else {print("DON`T COPY index_Play_System.php </br>");
						$data2 = PHP_EOL."\t DON`T COPY index_Play_System.php";}
			} 

	if(file_exists('../index_Play_System.php')){
				rename("../index_Play_System.php", "../index.php");
				$data3 = PHP_EOL."\t RENAME ../index_Play_System.php TO ../index.php";
			} else {print("DON`T RENAME ../index_Play_System.php TO ../index.php </br>");
				$data3 = PHP_EOL."\t DON`T RENAME ../index_Play_System.php TO ../index.php";}
	
	global $cfone;
	$cfone = PHP_EOL."SUSTITUCION DE ARCHIVOS:".$data1.$data2.$data3;
	
	}
	
				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function validate_form(){
	
		require 'validate.php';	
		
		return $errors;

		} 

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function process_form(){
	
	global $db;
	global $db_name;
	
/*	REFERENCIA DE USUARIO	*/

if (preg_match('/^(\w{1})/',$_POST['Nombre'],$ref1)){	$rf1 = $ref1[1];
														$rf1 = trim($rf1);
														/*print($ref1[1]."</br>");*/
														}
if (preg_match('/^(\w{1})*(\s\w{1})/',$_POST['Nombre'],$ref2)){	$rf2 = $ref2[2];
																$rf2 = trim($rf2);
														/*print($ref2[2]."</br>");*/
														}
if (preg_match('/^(\w{1})/',$_POST['Apellidos'],$ref3)){	$rf3 = $ref3[1];
															$rf3 = trim($rf3);
														/*print($ref3[1]."</br>");*/
														}
if (preg_match('/^(\w{1})*(\s\w{1})/',$_POST['Apellidos'],$ref4)){	$rf4 = $ref4[2];
																	$rf4 = trim($rf4);
														/*print($ref4[2]."</br>");*/
														}

	global $rf;
	$rf = $rf1.$rf2.$rf3.$rf4.$_POST['dni'].$_POST['ldni'];
	$rf = trim($rf);
	$rf = strtolower($rf);

	$_SESSION['iniref'] = $rf;

	/**************************************/
	
	crear_tablas();

	/**************************************/

	global $vni;
	global $carpetaimg;
	
	$trf = $_SESSION['iniref'];
	
	$vn1 = "img_admin";
	$carpetaimg = "../Users/".$trf."/".$vn1;

	if($_FILES['myimg']['size'] == 0){
			$nombre = $carpetaimg."/untitled.png";
			global $new_name;
			$new_name = $rf.".png";
			$rename_filename = $carpetaimg."/".$new_name;							
			copy("untitled.png", $rename_filename);
												}
												
	else{	$safe_filename = trim(str_replace('/', '', $_FILES['myimg']['name']));
			$safe_filename = trim(str_replace('..', '', $safe_filename));

		 	$nombre = $_FILES['myimg']['name'];
		  	$nombre_tmp = $_FILES['myimg']['tmp_name'];
		  	$tipo = $_FILES['myimg']['type'];
		  	$tamano = $_FILES['myimg']['size'];
		  
			$destination_file = $carpetaimg.'/'.$safe_filename;

	 if( file_exists( $carpetaimg.'/'.$nombre) ){
			unlink($carpetaimg."/".$nombre);
		//	print("* El archivo ".$nombre." ya existe, seleccione otra imagen.</br>");
												}
			
	elseif (move_uploaded_file($_FILES['myimg']['tmp_name'], $destination_file)){
			
			// Renombrar el archivo:
			$extension = substr($_FILES['myimg']['name'],-3);
			// print($extension);
			// $extension = end(explode('.', $_FILES['myimg']['name']) );
			global $new_name;
			$new_name = $rf.".".$extension;
			$rename_filename = $carpetaimg."/".$new_name;								
			rename($destination_file, $rename_filename);

			// print("El archivo se ha guardado en: ".$destination_file);
	
			}
			
		else {print("NO SE HA PODIDO GUARDAR EN ".$destination_file);}
		
		}

	global $nombre;
	global $apellido;
	$nombre = $_POST['Nombre'];
	$apellido = $_POST['Apellidos'];

	global $password;
	$password = $_POST['Password'] ;
	global $passwordhash;
	$passwordhash = password_hash($password, PASSWORD_DEFAULT, array ( "cost"=>10));

	global $db_name;

	global $table_name_a;
	$table_name_a = "`".$_SESSION['clave']."admin`";

	$sql = "INSERT INTO `$db_name`.$table_name_a (`ref`, `Nivel`, `Nombre`, `Apellidos`, `myimg`, `doc`, `dni`, `ldni`, `Email`, `Usuario`, `Password`, `Pass`, `Direccion`, `Tlf1`, `Tlf2`) VALUES ('$rf', '$_POST[Nivel]', '$_POST[Nombre]', '$_POST[Apellidos]', '$new_name', '$_POST[doc]', '$_POST[dni]', '$_POST[ldni]', '$_POST[Email]', '$_POST[Usuario]', '$passwordhash', '$password', '$_POST[Direccion]', '$_POST[Tlf1]', '$_POST[Tlf2]')";
		
	if(mysqli_query($db, $sql)){	// CREA EL ARCHIVO MYDNI.TXT $_SESSION['mydni'].
										$filename = "../Inclu/mydni.php";
										$fw2 = fopen($filename, 'w+');
										$mydni = '<?php $_SESSION[\'mydni\'] = '.$_POST['dni'].'; ?>';
										fwrite($fw2, $mydni);
										fclose($fw2);
	
	print( "<table align='center' style='margin-top:10px'>
				<tr>
					<th colspan=3 class='BorderInf'>
						SE HA REGISTRADO COMO ADMINISTRADOR.
					</th>
				</tr>
								
				<tr>
					<td width=150px>
						Nombre:
					</td>
					<td width=200px>"
						.$_POST['Nombre'].
					"</td>
					<td rowspan='4' align='center' width='100px'>
				<img src='".$carpetaimg."/".$new_name."' height='120px' width='90px' />
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
					<td colspan='2'>"
						.$_POST['ldni'].
					"</td>
				</tr>				
				
				<tr>
					<td>
						Mail:
					</td>
					<td colspan='2'>"
						.$_POST['Email'].
					"</td>
				</tr>
				
				<tr>
					<td>
						Tipo Usuario
					</td>
					<td colspan='2'>"
						.$_POST['Nivel'].
					"</td>
				</tr>
				
				<tr>
					<td>
						Referencia Usuario
					</td>
					<td colspan='2'>"
						.$rf.
					"</td>
				</tr>
				
				<tr>
					<td>
						Usuario:
					</td>
					<td colspan='2'>"
						.$_POST['Usuario'].
					"</td>
				</tr>
				
				<tr>
					<td>
						Password:
					</td>
					<td colspan='2'>"
						.$_POST['Password'].
					"</td>
				</tr>
				
				<tr>
				
					<td>
						Pais:
					</td>
					<td colspan='2'>"
						.$_POST['Direccion'].
					"</td>
				</tr>
				
				<tr>
					<td>
						Teléfono 1:
					</td>
					<td colspan='2'>"
						.$_POST['Tlf1'].
					"</td>
				</tr>
				
				<tr>
					<td>
						Teléfono 2:
					</td>
					<td colspan='2'>"
						.$_POST['Tlf2'].
					"</td>
				</tr>
				
				<tr>
					<td colspan=3 align='right' class='BorderSup'>
						<a href=\"../index.php\">
									ADMINISTRADOR ACCESO A INICIO DEL SISTEMA 
						</a>
					</td>
				</tr>
			</table>");

global $cfone;
$datein = date('Y-m-d/H:i:s');
$logdate = date('Y_m_d');
$logtext = $cfone.PHP_EOL."- CREADO USER ADMIN 1. ".$datein.PHP_EOL."\t User Ref: ".$rf.PHP_EOL."\t Name: ".$_POST['Nombre']." ".$_POST['Apellidos'].PHP_EOL."\t User: ".$_POST['Usuario'].PHP_EOL."\t Pass: ".$_POST['Password'].PHP_EOL;
$filename = "logs/".$logdate."_CONFIG_INIT.log";
$log = fopen($filename, 'ab+');
fwrite($log, $logtext);
fclose($log);

	config_one();
				
	} else {	print("</br>
				<font color='#FF0000'>
			* Estos datos no son validos, modifique esta entrada: </font></br> ".mysqli_error($db))."
				</br>";
				show_form ();
				
					}
		}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function y(){
	
	global $trf;
	$trf = $_SESSION['iniref'];
	$carpeta = "../Users/".$trf;
	$filename = $carpeta."/ayear.php";
	$fw1 = fopen($filename, 'r+');
	$contenido = fread($fw1,filesize($filename));
	fclose($fw1);
	$contenido = explode("\n",$contenido);
	$contenido[2] = "'' => 'YEAR',\n'".date('y')."' => '".date('Y')."',";
	$contenido = implode("\n",$contenido);
	//fseek($fw, 37);
	$fw = fopen($filename, 'w+');
	fwrite($fw, $contenido);
	fclose($fw);
}

function modif(){

	$filename = "../Users/".$_SESSION['iniref']."/year.txt";
	$fw2 = fopen($filename, 'w+');
	$date = "".date('Y')."";
	fwrite($fw2, $date);
	fclose($fw2);
	}

function crear_tablas(){
	
	global $db;	
	global $db_name;
	global $db;	
	global $db_host;
	global $db_user;
	global $db_pass;
	global $db_name;
	global $dbconecterror;
	
	global $trf;
	$trf = $_SESSION['iniref'];
	
// CREA EL DIRECTORIO DE USUARIO.

	global $carpeta;
	$carpeta = "../Users/".$trf;

	if (!file_exists($carpeta)) {
		mkdir($carpeta, 0777, true);
		$data1 = "\t* OK DIRECTORIO USUARIO ".$carpeta."\n";
		}
		else{
		//print("* NO OK DIRECTORIO USUARIO ".$carpeta."\n");
		$data1 = "\t* NO OK DIRECTORIO USUARIO ".$carpeta."\n";
		}

	if (file_exists($carpeta)){
		copy("../Images/untitled.png", $carpeta."/untitled.png");
		copy("../Images/pdf.png", $carpeta."/pdf.png");
		copy("ayear_Init_System.php", $carpeta."/ayear.php");
		copy("year.txt", $carpeta."/year.txt");
		copy("SecureIndex2.php", $carpeta."/index.php");
		global $data1;
		$data1 = $data1."\t* OK USER SYSTEM FILES ".$carpeta."\n";
		y();
		modif();
		}
		else{
		print("* NO OK USER SYSTEM FILES ".$carpeta."\n");
		global $data1;
		$data1 = $data1."\t* NO OK USER SYSTEM FILES".$carpeta."\n";
		}
	
	// CREA EL DIRECTORIO DE IMAGEN DE USUARIO.

	$vn1 = "img_admin";
	$carpetaimg = "../Users/".$trf."/".$vn1;
	if (!file_exists($carpetaimg)) {
		mkdir($carpetaimg, 0777, true);
		copy("../Images/untitled.png", $carpetaimg."/untitled.png");
		$data2 = "\t* OK DIRECTORIO ".$carpetaimg."\n";
		}
		else{print("* NO OK EL DIRECTORIO ".$carpetaimg."\n");
		$data2 = "\t* NO OK DIRECTORIO ".$carpetaimg."\n";
		}
	
	// CREA EL DIRECTORIO DE LOG DE USUARIO.

	$vn1 = "log";
	$carpetalog = "../Users/".$trf."/".$vn1;
	if (!file_exists($carpetalog)) {
		mkdir($carpetalog, 0777, true);
		$data3 = "\t* OK DIRECTORIO ".$carpetalog."\n";
		}
		else{print("* NO OK EL DIRECTORIO ".$carpetalog."\n");
		$data3 = "\t* NO OK DIRECTORIO ".$carpetalog."\n";
		}
	
	/************	PASAMOS LOS PARAMETROS A .LOG	*****************/
	
$datein = date('Y-m-d/H:i:s');
$logdate = date('Y_m_d');
$logtext = PHP_EOL."- CONFIG INIT ".$datein.PHP_EOL."* ".$db_name.PHP_EOL."* ".$db_host.PHP_EOL.". * ".$db_user.PHP_EOL."* ".$db_pass.PHP_EOL.$dbconecterror.$data1.$data2.$data3.PHP_EOL;
$filename = "logs/".$logdate."_CONFIG_INIT.log";
$log = fopen($filename, 'ab+');
fwrite($log, $logtext);
	fclose($log);

	}	

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function show_form($errors=[]){
	
	if(isset($_POST['oculto'])){
		$defaults = $_POST;
		} else {$defaults = array ( 'Nombre' => '',
									'Apellidos' => '',
									'myimg' => isset($_POST['myimg']),	
									'Nivel' => '',
									'ref' => '',
									'doc' => '',
									'dni' => '',
									'ldni' => '',
									'Email' => 'Solo letras minúsculas',
									'Usuario' => '',
									'Usuario2' => '',
									'Password' => '',
									'Password2' => '',
									'Direccion' => '',
									'Tlf1' => '',
									'Tlf2' => '');
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
		
		for($a=0; $c=count(@$errors), $a<$c; $a++){
			print("<font color='#FF0000'>**</font>  ".$errors [$a]."<br/>");
			}
		print("</td>
				</tr>
				</table>");
			}
		
	$Nivel = array (	//'' => 'NIVEL USUARIO',
						'admin' => 'ADMINISTRADOR');														

	$doctype = array (	'DNI' => 'DNI/NIF Espa&ntilde;oles',
						'NIE' => 'NIE/NIF Extranjeros',
						'NIFespecial' => 'NIF Persona F&iacute;sica Especial',
					  /*
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
						*/
										);
	
/*******************************/

	print("
			<table align='center' style=\"margin-top:2px\">
				<tr>
					<th colspan=2 class='BorderInf'>
							DATOS DEL NUEVO ADMINISTRADOR
					</th>
				</tr>
				
<form name='form_datos' method='post' action='$_SERVER[PHP_SELF]'  enctype='multipart/form-data'>
						
				<tr>
					<td width=180px>	
						<font color='#FF0000'>*</font>
						Ref User:
					</td>
					<td width=360px>
						SE GENERA LA CLAVE AUTOMÁTICAMENTE 
					</td>
				</tr>
					
				<tr>
					<td width=130px>	
						<font color='#FF0000'>*</font>
						Nombre:
					</td>
					<td width=280px>
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

				foreach($doctype as $option => $label){
					print ("<option value='".$option."' ");
					if($option == $defaults['doc']){print ("selected = 'selected'");}
													print ("> $label </option>");
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
		<input type='text' name='dni' size=12 maxlength=8 value='".$defaults['dni']."' />
					</td>
				</tr>
				
				<tr>
					<td>
						<font color='#FF0000'>*</font>
						Control:
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
						Nombre Usuario:
					</td>
					<td>
		<input type='text' name='Usuario' size=12 maxlength=10 value='".$defaults['Usuario']."' />
					</td>
				</tr>
				<tr>
					<td>
						<font color='#FF0000'>*</font>
						Confirme Usuario:
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
						Confirme Password:
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
					<tr>
					<td>
						&nbsp;&nbsp;&nbsp;Teléfono 2:
					</td>
					<td>
		<input type='text' name='Tlf2' size=12 maxlength=9 value='".$defaults['Tlf2']."' />
					</td>
				</tr>
				
				<tr>
					<td>
						<font color='#FF0000'>*</font>
						Fotografía:
					</td>
					<td>
		<input type='file' name='myimg' value='".@$defaults['myimg']."' />						
					</td>
				</tr>

				<tr>
					<td colspan='2'  align='right' valign='middle'  class='BorderSup'>
						<input type='submit' value='REGISTRARME CON ESTOS DATOS' />
						<input type='hidden' name='oculto' value=1 />
						
					</td>
				</tr>
		</form>														
			</table>"); 
	
	}	

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////
	
	function master_index(){
		
		require '../'.$_SESSION['menu'].'/rutas.php';
		require '../'.$_SESSION['menu'].'/Master_Index.php';
		
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