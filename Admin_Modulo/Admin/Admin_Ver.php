<?php
session_start();

	//require '../Inclu/error_hidden.php';
	require '../Inclu/Admin_head.php';
	require '../Inclu/mydni.php';
	require '../Conections/conection.php';
	require '../Conections/conect.php';
	require '../Inclu/my_bbdd_clave.php';

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

if (($_SESSION['Nivel'] == 'user') || ($_SESSION['Nivel'] == 'plus')){ 
									master_index();
									ver_todo();
									info();
								}

elseif ($_SESSION['Nivel'] == 'admin'){

		master_index();

		if(isset($_POST['todo'])){ show_form();							
								   ver_todo();
								   info();
										}
								
		elseif(isset($_POST['ocultoc'])){
				if($form_errors = validate_form()){
						show_form($form_errors);
			} else {process_form();
					info();
					}
				}
		elseif ((isset($_GET['page'])) || (isset($_POST['page']))) {
											show_form();
											ver_todo();
										}
		else { 	show_form();
			   	ver_todo();
				}
		} 
			
	else { require '../Inclu/table_permisos.php'; }

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	function validate_form(){
		
		require 'Inc_Show_Form_01_Val.php';
		
		return $errors;

		} 
		
				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function process_form(){
	
	global $db;
	
	global $nombre;
	global $apellido;
	$nombre = $_POST['Nombre'];
	$apellido = $_POST['Apellidos'];
	
	show_form();
		
	$nom = "%".$_POST['Nombre']."%";
	$ape = "%".$_POST['Apellidos']."%";

	global $table_name_a;
	$table_name_a = "`".$_SESSION['clave']."admin`";

	if (strlen(trim($_POST['Apellidos'])) == 0){$ape = $nom;}
	if (strlen(trim($_POST['Nombre'])) == 0){ $nom = $ape;}
	
	//$orden = $_POST['Orden'];
		
	if (($_SESSION['Nivel'] == 'admin') && ($_SESSION['dni'] == $_SESSION['mydni'])) { 
	$sqlb =  "SELECT * FROM $table_name_a WHERE `Nombre` LIKE '$nom' OR `Apellidos` LIKE '$ape'  ORDER BY `Nombre` ASC  ";
	$qb = mysqli_query($db, $sqlb);
				}
	elseif (($_SESSION['Nivel'] == 'admin') && ($_SESSION['dni'] != $_SESSION['mydni'])){ 
	$sqlb =  "SELECT * FROM $table_name_a WHERE  `dni` <> '$_SESSION[mydni]' AND  `Nombre` LIKE '$nom' OR `dni` <> '$_SESSION[mydni]' AND `Apellidos` LIKE '$ape' ORDER BY `Nombre` ASC  ";
	$qb = mysqli_query($db, $sqlb);
				}
//	$sqlc =  "SELECT * FROM $table_name_a WHERE `Nombre` LIKE '$nom' OR `Apellidos` LIKE '$ape' ORDER BY `Nombre` ASC ";
//	$qc = mysqli_query($db, $sqlc);
	
			////////////////////		**********  		////////////////////

	global $twhile;
	$twhile = "FILTRO USUARIOS CONSULTA";

		global $ruta;
		$ruta = "";
	require 'Inc_While_Form.php';
		global $rutaimg;
		$rutaimg = "../Users/";
	require 'Inc_While_Total.php';

			////////////////////		**********  		////////////////////

	} // FIN FUNCTION

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function show_form($errors=''){

	global $titulo;
	$titulo = "GESTION USUARIOS";
	global $boton;
	$boton = "USUARIOS VER TODOS";

	require 'Inc_Show_Form_01.php';
	
	}	

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function ver_todo(){
		
	global $db;
	global $db_name;

	global $table_name_a;
	$table_name_a = "`".$_SESSION['clave']."admin`";

			if(isset($_POST['Orden'])){	global $orden;
										$orden = $_POST['Orden'];
			} elseif ((isset($_GET['page'])) || (isset($_POST['page']))) {
							if(isset($_SESSION['Orden'])){
										global $orden;
										$orden = $_SESSION['Orden']; 
									} else { global $orden;
											 $orden ='`id` ASC';}
			} else { global $orden;
					 $orden ='`id` ASC';}

	if (($_SESSION['Nivel'] == 'user') || ($_SESSION['Nivel'] == 'plus')){ 
			$ref = $_SESSION['ref'];
			$sqlb =  "SELECT * FROM $table_name_a WHERE `ref` = '$ref'";
			$qb = mysqli_query($db, $sqlb);
		}
	
	elseif (($_SESSION['Nivel'] == 'admin') && ($_SESSION['dni'] == $_SESSION['mydni'])) { 

			require 'Paginacion_Head.php';
			/*$sqlb =  "SELECT * FROM $table_name_a ORDER BY $orden ";*/
			//$sqlb =  "SELECT * FROM $table_name_a  ORDER BY `id` DESC $limit";
			$sqlb =  "SELECT * FROM $table_name_a  ORDER BY $orden $limit";
			$qb = mysqli_query($db, $sqlb);
			}
	elseif (($_SESSION['Nivel'] == 'admin') && ($_SESSION['dni'] != $_SESSION['mydni'])){ 
			require 'Paginacion_Head.php';
			/*$sqlb =  "SELECT * FROM $table_name_a WHERE $table_name_a.`dni` <> '$_SESSION[mydni]' ORDER BY $orden ";*/
			/*$sqlb =  "SELECT * FROM $table_name_a WHERE $table_name_a.`dni` <> '$_SESSION[mydni]' ORDER BY  `id` DESC $limit";*/
			$sqlb =  "SELECT * FROM $table_name_a WHERE $table_name_a.`dni` <> '$_SESSION[mydni]' ORDER BY  $orden $limit";
			$qb = mysqli_query($db, $sqlb);
			}

			////////////////////		**********  		////////////////////

	global $twhile;
	//$twhile = "TODOS USUARIOS CONSULTA";
	$twhile = "";
	
		global $ruta;
		$ruta = "";
	require 'Inc_While_Form.php';
		global $rutaimg;
		$rutaimg = "../Users/";
		global $pagedest;
		$pagedest = "Admin_Ver.php";
	require 'Inc_While_Total.php';

			////////////////////		**********  		////////////////////
		
	} // FIN FUNCTION

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

function info(){

	global $nombre;
	global $apellido;
	global $orden;
	
	$orden = isset($_POST['Orden']);
	
	if (isset($_POST['todo'])){$nombre = "TODOS LOS USUARIOS ".$orden;};	

	if (($_SESSION['Nivel'] == 'user') || ($_SESSION['Nivel'] == 'plus')){	
										$nombre = $_SESSION['Nombre'];
										$apellido = $_SESSION['Apellidos'];}
	
	$ActionTime = date('H:i:s');

	global $dir;
	$dir = "../Users/".$_SESSION['ref']."/log";
	
	global $text;
	$text = PHP_EOL."- ADMIN VER ".$ActionTime.PHP_EOL."\t Filtro => ".$nombre." ".$apellido;

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