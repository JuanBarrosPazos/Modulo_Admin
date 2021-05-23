<?php
session_start();
 
	//require '../Inclu/error_hidden.php';
	require '../Inclu/Admin_Inclu_head.php';
	require '../Inclu/mydni.php';
	require '../Inclu/my_bbdd_clave.php';
	require '../Conections/conection.php';
	require '../Conections/conect.php';
	require '../Inclu/my_bbdd_clave.php';


				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	global $ruta;
	$ruta = "../";
	global $rutacam;
	$rutacam = "";
	global $docname;
	$docname = "Admin/Admin_Ver.php";

 if(isset($_GET['pin'])){

	require $rutacam.'consultaqr.php';

		if (($rowu['Nivel'] == 'admin') || ($rowu['Nivel'] == 'plus') || ($rowu['Nivel'] == 'user')){ 

				process_pinqr(); 
				
		} else { require $ruta.'Inclu/table_permisos.php'; 
				 require $rutacam.'redir.php';
					}
	
	
	} else { require $ruta.'Inclu/table_permisos.php';
			 require $rutacam.'redir.php';
				}
	
				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function process_pinqr(){
	
	global $table_name_a;
	$table_name_a = "`".$_SESSION['clave']."admin`";

	global $rutacam;
	require $rutacam.'consultaqr.php';
	
	$_SESSION['usuarios'] = strtolower($rowu['ref']);
	
	if ($contu> 0){
	
	global $rutacam;
	require $rutacam.'table_data.php';
		
	}else{
		
		global $rutacam;
		require $rutacam.'table_lost.php';

	 		}	

	require $rutacam.'redir.php';

	} // FIN FUNCTION 

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	require '../Inclu/Admin_Inclu_footer.php';
	
				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

/* Creado por Juan Barros Pazos 2021 */
?>
