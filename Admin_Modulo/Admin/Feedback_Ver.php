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

		if($_POST['todo']){ show_form();							
							ver_todo();
							info();
							}
								
		elseif($_POST['oculto']){
				if($form_errors = validate_form()){
								show_form($form_errors);
							} else {process_form();
									info();
									}
								}
			else {show_form();}
		} else { require '../Inclu/table_permisos.php'; }

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function validate_form(){
	
	$errors = array();
	
	if ( (strlen(trim($_POST['Nombre'])) == 0) && (strlen(trim($_POST['Apellidos'])) == 0) ){
		$errors [] = " <font color='#FF0000'>UNO DE LOS DOS CAMPOS OBLIGATORIO</font>";
		}
	
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
	$orden = $_POST['Orden'];
		
	if (strlen(trim($_POST['Apellidos'])) == 0){$ape = $nom;}
	if (strlen(trim($_POST['Nombre'])) == 0){ $nom = $ape;}

	global $table_name_f;
	$table_name_f = "`".$_SESSION['clave']."feedback`";

	$sqlb =  "SELECT * FROM $table_name_f WHERE `Nombre` LIKE '$nom' OR `Apellidos` LIKE '$ape' ORDER BY `Nombre` ASC ";
 	
	$qb = mysqli_query($db, $sqlb);
	
			////////////////////		**********  		////////////////////

	global $twhile;
	$twhile = "FILTRO USUARIOS BAJAS CONSULTAR";

	require 'Inc_While_Form_Feed.php';

	require 'Inc_While_Total_Feed.php';

			////////////////////		**********  		////////////////////
		
	}	

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function show_form($errors=''){
	
	global $titulo;
	$titulo = "BAJAS TEMPORALES DEL SISTEMA";

	require 'Inc_Show_Form_01.php';
	
	}	

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function ver_todo(){
		
	global $db;

	if (($_SESSION['Nivel'] == 'admin')){ 
	$orden = $_POST['Orden'];

	global $table_name_f;
	$table_name_f = "`".$_SESSION['clave']."feedback`";

	$sqlb =  "SELECT * FROM $table_name_f ORDER BY $orden ";
	$qb = mysqli_query($db, $sqlb);
	}
	
			////////////////////		**********  		////////////////////

	global $twhile;
	$twhile = "TODOS USUARIOS BAJAS CONSULTAR";

	require 'Inc_While_Form_Feed.php';

	require 'Inc_While_Total_Feed.php';

			////////////////////		**********  		////////////////////
		
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

function info(){

	global $nombre;
	global $apellido;

	global $orden;
	$orden = $_POST['Orden'];
	
	if ($_POST['todo']){$nombre = "TODOS LOS USUARIOS ".$orden;};	

	$rf = $_POST['ref'];
	$nombre = $_POST['Nombre'];
	$apellido = $_POST['Apellidos'];
		
	$ActionTime = date('H:i:s');

	global $dir;
	$dir = "../Users/".$_SESSION['ref']."/log";

	global $text;
	$text = PHP_EOL."- USER BAJAS BUSQUEDA ".$ActionTime.PHP_EOL."\t Filtro => ".$nombre." ".$apellido;

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