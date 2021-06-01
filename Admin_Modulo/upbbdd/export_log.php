<?php
session_start();

	//require '../Inclu/error_hidden.php';
	require '../Inclu/Admin_head.php';

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
	
					else {	show_form();
							listfiles();
					}
								
				} else { require '../Inclu/table_permisos.php'; }

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function show_form(){

	global $db;
	global $db_name;
	
	if((isset($_POST['oculto1']))||(isset($_POST['delete']))){
				$_SESSION['tablas'] = $_POST['tablas'];
				$defaults = array ('Orden' => '`id` ASC',
								   'tablas' => $_POST['tablas'],
								   						);
		//print($_SESSION['tablas']);
										}
		else{	unset($_SESSION['tablas']);
				$defaults = array ('Orden' => '`id` ASC',
								   'tablas' => '',
								   						);
										}

	if($_SESSION['Nivel'] == 'admin'){
		
		print("
			<table align='center' style='border:1; margin-top:2px' width='auto'>
				
			<form name='form_tabla' method='post' action='$_SERVER[PHP_SELF]'>
			
			<input type='hidden' name='Orden' value='".$defaults['Orden']."' />
			
				<tr>
					<td align='center'>
							EXPORTE .LOG USUARIOS.
					</td>
				</tr>		
				<tr>
					<td>
					<div style='float:left; margin-right:6px''>
						<input type='submit' value='SELECCIONE USUARIO' class='botonazul' />
						<input type='hidden' name='oculto1' value=1 />
					</div>
					<div style='float:left'>

						<select name='tablas'>");

	global $db;
	global $tablau;
	$tablau = $_SESSION['clave']."admin";
	$tablau = "`".$tablau."`";

	$sqlu =  "SELECT * FROM $tablau ORDER BY `ref` ASC ";
	$qu = mysqli_query($db, $sqlu);
	if(!$qu){
			print("Modifique la entrada L.95 ".mysqli_error($db)."<br/>");
	} else {
					
		while($rowu = mysqli_fetch_assoc($qu)){
					
					print ("<option value='".$rowu['ref']."' ");
					
					if($rowu['ref'] == $defaults['tablas']){
										print ("selected = 'selected'");
																		}
						print ("> ".$rowu['Nombre']." ".$rowu['Apellidos']." </option>");
						}
					}  
		
	print ("	</select>
					</div>
				</td>
			</tr>
		</form>	
			</table>				
				"); 

		}
	
	}	

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function listfiles(){
	
	if(@$_SESSION['tablas'] == ''){ $_SESSION['tablas'] = $_SESSION['ref']; }
	//print("*".$_SESSION['tablas'].".</br>");

	global $ruta;
	$ruta ="../Users/".$_SESSION['tablas']."/log/";
	//print("RUTA: ".$ruta.".</br>");
	
	global $rutag;
	$rutag = "../Users/".$_SESSION['tablas']."/log/{*}";
	//print("RUTA G: ".$rutag.".</br>");
		
	$directorio = opendir($ruta);
	global $num;
	$num=count(glob($rutag,GLOB_BRACE));
	if($num < 1){
		
		print ("<table align='center' style='border:1; margin-top:2px' width='auto'>
					<tr>
					<td align='center'>NO HAY ARCHIVOS PARA DESCARGAR</td>
					</tr>");
	}else{
	
	print ("<table align='center' style='border:1; margin-top:2px' width='auto'>
	<tr><td align='center' colspan='3' class='BorderInf'>".strtoupper($_SESSION['tablas'])." ARCHIVOS LOG </td></tr>");
	while($archivo = readdir($directorio)){
		if($archivo != ',' && $archivo != '.' && $archivo != '..'){
			print("<tr>
			<td class='BorderInfDch'>
			<form name='delete' action='$_SERVER[PHP_SELF]' method='post'>
			<input type='hidden' name='tablas' value='".$_SESSION['tablas']."' />
			<input type='hidden' name='ruta' value='".$ruta.$archivo."'>
			<input type='submit' value='ELIMINAR' class='botonrojo' >
			<input type='hidden' name='delete' value='1' >
			</form>
			</td>
			<td class='BorderInfDch'>
			<form name='archivos' action='".$ruta.$archivo."' target='_blank' method='post'>
			<input type='hidden' name='tablas' value='".$_SESSION['tablas']."' />
			<input type='submit' value='DESCARGAR' class='botonverde' />
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

	require '../Inclu/Admin_Inclu_02.php';

					   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

/* Creado por Juan Barros Pazos 2021 */
?>
