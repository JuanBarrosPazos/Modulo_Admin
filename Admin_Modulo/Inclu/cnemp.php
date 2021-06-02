<?php
session_start();

	global $playinclu;
	$playinclu = 1;

	require 'error_hidden.php';
	require 'Admin_head.php';
	require 'mydni.php';
	require 'nemp.php';
	require '../Conections/conection.php';
	require '../Conections/conect.php';
	require 'my_bbdd_clave.php';

///////////////////////////////////////////////////////////////////////////////////////////////

if ($_SESSION['Nivel'] == 'admin'){

	master_index();

	if(isset($_POST['oculto'])){
			if($form_errors = validate_form()){ show_form($form_errors); }
				else {  process_form();
						show_form();
						info_02(); }
		} else { show_form();
				 info_01(); }
	} else { require 'table_permisos.php'; } 

//////////////////////////////////////////////////////////////////////////////////////////////

function validate_form(){
	
	$errors = array();
	
	/* VALIDAMOS EL CAMPO NIVEL. */
	
	if(strlen(trim($_POST['nemp'])) == 0){
		$errors [] = "<font color='#FF0000'>SELECCIONE NUMERO EMPLEADOS</font>";
		}
	
	return $errors;

		} 

//////////////////////////////////////////////////////////////////////////////////////////////

function process_form(){
	
	// CREA EL ARCHIVO MYDNI.TXT $_SESSION['mydni'].
		$filename = "nemp.php";
		$fw2 = fopen($filename, 'w+');
		$mydni = '<?php $_SESSION[\'nuser\'] = '.$_POST['nemp'].'; ?>';
		fwrite($fw2, $mydni);
		fclose($fw2);
	
		$_SESSION['nuser'] = $_POST['nemp'];

	/**************************************/

	print( "<table align='center' style='margin-top:10px'>
				<tr>
					<th colspan=2 class='BorderInf'>
						SE HA GRABADO CORRETAMENTE
					</th>
				</tr>
								
				<tr>
					<td  align='center'>
						Nº EMPLEADOS PERMITIDOS: "
						.$_POST['nemp'].
					"</td>
				</tr>
				
			</table>");

		}

//////////////////////////////////////////////////////////////////////////////////////////////

function show_form($errors=[]){
	
	if(isset($_POST['oculto'])){
		$defaults = $_POST;
		} else {$defaults = array ( 'nemp' => $_SESSION['nuser']); }
	
	if ($errors){
		print("<table align='center'>
					<tr>
						<th style='text-align:center'>
					<font color='#FF0000'>* SOLUCIONE ESTOS ERRORES:</font><br/>
						</th>
					<tr>
						<td style='text-align:left'>");
			
		for($a=0; $c=count($errors), $a<$c; $a++){
			print("<font color='#FF0000'>**</font>  ".$errors [$a]."<br/>");
			}
		print("</td>
				</tr>
				</table>");
		}
	
	global $array_nemp;
	$array_nemp = 1;
	
	require '../Admin/admin_array_total.php';

/*******************************/

		print("<table align='center' style=\"margin-top:4px\">
				<tr>
					<th colspan=2 class='BorderInf'>
							Nº EMPLEADOS PERMITIDO: ".$_SESSION['nuser']."
					</th>
				</tr>
				
				<form name='form_datos' method='post' action='$_SERVER[PHP_SELF]' >
						
				<tr>
					<td>
						Nº 
					</td>
					<td>
				<select name='nemp'>");

				foreach($nemp as $optionnv => $labelnv){
					
					print ("<option value='".$optionnv."' ");
					
					if($optionnv == $defaults['nemp']){
															print ("selected = 'selected'");
																								}
													print ("> $labelnv </option>");
												}	
						
	print ("</select>
					</td>
				</tr>
				
				<tr>
					<td colspan='2'  align='right' valign='middle'  class='BorderSup'>
						<input type='submit' value='GRABAR Nº EMPLEADOS PERMITIDO' class='botonnaranja' />
						<input type='hidden' name='oculto' value=1 />
						
					</td>
				</tr>
		</form>														
			</table>"); 
	
	}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function info_01(){

	$ActionTime = date('H:i:s');
	
	global $dir;
	$dir = "../Users/".$_SESSION['ref']."/log";

	global $text;
	$text = PHP_EOL."- NUMERO USUARIOS ACCESO: ".$ActionTime.PHP_EOL."\t Nº EMPLEADOS: ".$_SESSION['nuser'];

	require '../Admin/log_write.php';

	}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function info_02(){

	$ActionTime = date('H:i:s');
	
	global $dir;
	$dir = "../Users/".$_SESSION['ref']."/log";

	global $text;
	$text = PHP_EOL."- NUMERO USUARIOS MODIFICADO: ".$ActionTime.PHP_EOL."\t Nº EMPLEADOS: ".$_POST['nemp'];

	require '../Admin/log_write.php';

	}


				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////
	
	function master_index(){
		
		require '../Inclu_Menu/rutainclu.php';
		require '../Inclu_Menu/Master_Index.php';
		
	} 

/////////////////////////////////////////////////////////////////////////////////////////////////

	require '../Inclu/Admin_Inclu_footer.php';
		
/* Creado por Juan Barros Pazos 2021 */
?>
