<?php
session_start();

	//require '../Inclu/error_hidden.php';
	require '../Inclu/Admin_Inclu_head.php';
	require '../Inclu/mydni.php';
	require '../Conections/conection.php';
	require '../Conections/conect.php';
	require '../Inclu/my_bbdd_clave.php';


				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

if ($_SESSION['Nivel'] == 'admin'){

		master_index();

		if(isset($_POST['delete'])){	delete();
								show_form();
							  	listfiles();
							}
	
		elseif(isset($_POST['oculto2'])){	show_form();
								  	ver_todo();
							  		listfiles();

				} else {	show_form();
							listfiles();
						}
								
			} else { require '../Inclu/table_permisos.php'; }

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function show_form(){

	global $db;
	global $db_name;
	
	if((isset($_POST['oculto1']))||(isset($_POST['oculto2']))||(isset($_POST['delete']))){
					$_SESSION['tablas'] = strtolower($_POST['tablas']);
					$defaults = array ('Orden' => isset($ordenar),
								   	   'tablas' => strtolower($_POST['tablas']),
								   						);
					// print($_SESSION['tablas']);
										}
	else{unset($_SESSION['tablas']);}
	
	if($_SESSION['Nivel'] == 'user'){
		
		print("
			<table align='center' style='border:1; margin-top:2px' width='auto'>
				
				<tr>
					<td align='center'>
							TABLAS EXPORTABLES PARA BBDD ".$_SESSION['ref'].".
					</td>
				</tr>
			</table>");	

				}

	if($_SESSION['Nivel'] == 'admin'){
		
	print("<table align='center' style='border:1; margin-top:2px' width='auto'>
				
		<form name='form_tabla' method='post' action='$_SERVER[PHP_SELF]'>
			
			<input type='hidden' name='Orden' value='".@$defaults['Orden']."' />
				<tr>
					<td align='center'>
							EXPORTE TABLAS BBDD.
					</td>
				</tr>		
				<tr>
					<td>
					<div style='float:left; margin-right:6px''>
						<input type='submit' value='SELECCIONE USUARIO / TABLA' class='botonazul' />
						<input type='hidden' name='oculto1' value=1 />
					</div>
					<div style='float:left'>

						<select name='tablas'>
						
				<!-- -->	<option value=''");
							if(@$defaults['tablas'] == ''){
										print ("selected = 'selected'");
																		}
							print("
							>LAS TABLAS O USUARIO</option>
					 	
							<option value = 'admin'");
							if(@$defaults['tablas'] == 'admin'){
										print ("selected = 'selected'");
																		}
							/* */
				print("> Tabla Admin Sistem </option>");
							
	global $db;
	global $tablau;
	$tablau = $_SESSION['clave']."admin";
	$tablau = "`".$tablau."`";

	$sqlu =  "SELECT * FROM $tablau ORDER BY `ref` ASC ";
	$qu = mysqli_query($db, $sqlu);
	if(!$qu){
			print("* 136".mysqli_error($db)."<br/>");
	} else {
					
		while($rowu = mysqli_fetch_assoc($qu)){
					
					print ("<option value='".strtolower($_SESSION['clave'].$rowu['ref'])."' ");
					if(strtolower($_SESSION['clave'].$rowu['ref']) == @$defaults['tablas']){
										print ("selected = 'selected'");
																		}
						print ("> ".$rowu['Nombre']." ".$rowu['Apellidos']." </option>");
						}
					}  
		
	print ("</select>
					</div>
				</td>
			</tr>
		</form>	
			</table>"); 

	}
	
			////////////////////		**********  		////////////////////

	if ((isset($_POST['oculto1'])) || (isset($_POST['todo'])) ) {
			
	if ($_SESSION['tablas'] == '') { 
				print("<table align='center' style=\"margin-top:20px;margin-bottom:20px\">
									<tr align='center'>
										<td>
											<font color='red'>
										SELECCIONE UNA TABLA O NOMBRE DE USUARIO
											</font>
										</td>
									</tr>
								</table>");
					}	
					
	if ($_SESSION['tablas'] != '') {

	global $nom;
	$nom = strtolower($_SESSION['tablas']);
	if (strtolower($_SESSION['tablas']) == 'admin'){$nom = $nom;}
	else{$nom = "%".$nom."%";}
	$nom = "LIKE '$nom'";
	
/* Se busca las tablas en la base de datos */

	//$consulta = "SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES ";
	$consulta = "SHOW TABLES FROM $db_name $nom";
	$respuesta = mysqli_query($db, $consulta);
	if(!$respuesta){
	print("<font color='#FF0000'>194 Se ha producido un error: </font></br>".mysqli_error($db)."</br>");
		
		} else {	print( "<table align='center'>
		
									<tr>
										<th colspan=2 class='BorderInf'>
									NUMERO DE TABLAS ".mysqli_num_rows($respuesta).".
										</th>
									</tr>");
			while ($fila = mysqli_fetch_row($respuesta)) {
				if($fila[0]){
				print(	"<tr>
							<td class='BorderInfDch'>
											".$fila[0]."
							</td>
							<td class='BorderInf'>
				<form name='exporta' action='$_SERVER[PHP_SELF]' method='POST'>
					<input type='hidden' name='tablas' value='".$defaults['tablas']."' />
					<input name='tabla' type='hidden' value='".$fila[0]."' />
						<input type='submit' value='EXPORTA TABLA ".strtoupper($fila[0])."' class='botonverde' />
						<input type='hidden' name='oculto2' value=1 />
						</form>
										</td>
							<tr>			
								");
				}
					}
			print("</table>");		
					
				}
			}
		}
	
	}	

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function ver_todo(){
	
		require 'export_bbdd.php';

	}	/* Final ver_todo(); */

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function listfiles(){
	
	global $ruta;
	$ruta ="bbdd/";
	
	$directorio = opendir($ruta);
	global $num;
	$num=count(glob("bbdd/{*}",GLOB_BRACE));
	if($num < 1){print ("<table align='center' style='border:1; margin-top:2px' width='auto'>
	<tr><td align='center' class='BorderInf'>NO HAY ARCHIVOS PARA DESCARGAR</td></tr>");
	}else{
		
	print ("<table align='center' style='border:1; margin-top:2px' width='auto'>
	<tr><td align='center' colspan='3' class='BorderInf'>ARCHIVOS RESPALDO BBDD </td></tr>");
	while($archivo = readdir($directorio)){
		if($archivo != ',' && $archivo != '.' && $archivo != '..'){
			print("<tr>
			<td class='BorderInfDch'>
			<form name='delete' action='$_SERVER[PHP_SELF]' method='post'>
				<input type='hidden' name='tablas' value='".isset($_SESSION['tablas'])."' />
				<input type='hidden' name='ruta' value='".$ruta.$archivo."'>
				<input type='submit' value='ELIMINAR' class='botonrojo' >
				<input type='hidden' name='delete' value='1' >
			</form>
			</td>
			<td class='BorderInfDch'>
			<form name='archivos' action='".$ruta.$archivo."' target='_blank' method='post'>
				<input type='hidden' name='tablas' value='".isset($_SESSION['tablas'])."' />
				<input type='submit' value='DESCARGAR'  class='botonverde' />
			</form>
			</td>
			<td class='BorderInf'>".strtoupper($archivo)."</td>
			");
		}else{}
	} // FIN DEL WHILE
	}
	closedir($directorio);
	print("</table>");
}

function delete(){unlink($_POST['ruta']);}
	
				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////
	
	function master_index(){
		
	require '../'.$_SESSION['menu'].'/rutaupbbdd.php';
	require '../'.$_SESSION['menu'].'/Master_Index.php';

		} /* Fin funcion master_index.*/

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	require '../Inclu/Admin_Inclu_footer.php';
		
				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	/* Creado por Juan Barros Pazos 2021 */
?>