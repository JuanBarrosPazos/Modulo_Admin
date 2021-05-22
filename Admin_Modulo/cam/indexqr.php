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

if (($_SESSION['Nivel'] == 'admin') || ($_SESSION['Nivel'] == 'plus')){ 

	if(isset($_GET['pin'])){ process_pinqr(); }

	else { process_pinqr(); }

		} else { require '../Inclu/table_permisos.php'; 
					global $redir;
					$redir = "<script type='text/javascript'>
									function redir(){
									window.location.href='indexcam.php';
								}
								setTimeout('redir()',6000);
								</script>";
					print ($redir);
				 }

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function process_pinqr(){
	
	global $db;
	global $db_name;

	global $table_name_a;
	$table_name_a = "`".$_SESSION['clave']."admin`";

	$sqlp =  "SELECT * FROM `$db_name`.$table_name_a WHERE $table_name_a.`dni` = '$_GET[pin]' ";
	$qp = mysqli_query($db, $sqlp);
	$cp = mysqli_num_rows($qp);
	$rp = mysqli_fetch_assoc($qp);
	
	$_SESSION['usuarios'] = strtolower($rp['ref']);
	
	if ($cp > 0){
		
	global $rutaimg;
	$rutaimg = "src='../Users/".$rp['ref']."/img_admin/".$rp['myimg']."'";
	
		print("<table align='center' width='auto'>
		<tr>
			<th colspan=3  class='BorderInf'>
				DATOS DEL USUARIO
			</th>
		</tr>
	 <tr>
					<td width=150px>Nombre:</td>
					<td width=200px>"
						.$rp['Nombre'].
					"</td>
					<td rowspan='5' align='center'>
				<img ".$rutaimg." height='120px' width='90px' />
					</td>
				</tr>
				
				<tr>
					<td>Apellidos:</td>
					<td>".$rp['Apellidos']."</td>
				</tr>				
				
				<tr>
					<td>Tipo Documento:</td>
					<td>".$rp['doc']."</td>
				</tr>				
				
				<tr>
					<td>N&uacute;mero:</td>
					<td>".$rp['dni']."</td>
				</tr>				
				
				<tr>
					<td>Control:</td>
					<td>".$rp['ldni']."</td>
				</tr>				
				
				<tr>
					<td>Mail:</td>
					<td colspan='2'>".$rp['Email']."</td>
				</tr>
				
				<tr>
					<td>Tipo Usuario</td>
					<td colspan='2'>".$rp['Nivel']."</td>
				</tr>
				
				<tr>
					<td>Referencia Usuario</td>
					<td colspan='2'>".$rp['ref']."</td>
				</tr>
				
				<tr>
					<td>Usuario:</td>
					<td colspan='2'>".$rp['Usuario']."</td>
				</tr>
				
				<tr>
					<td>Password:</td>
					<td colspan='2'>".$rp['Pass']."</td>
				</tr>
				
				<tr>
					<td>Pais:</td>
					<td colspan='2'>".$rp['Direccion']."</td>
				</tr>
				
				<tr>
					<td>Teléfono 1:</td>
					<td colspan='2'>".$rp['Tlf1']."</td>
				</tr>
				
				<tr>
					<td>Teléfono 2:</td>
					<td colspan='2'>".$rp['Tlf2']."</td>
				</tr>

         <tr>
		<td colspan=3 align='right' class='BorderSup'>
			<form name='closewindow' action='indexcam.php' />
				<input type='submit' value='CANCELAR Y VOLVER' class='botonnaranja' />
				<input type='hidden' name='cancel' value=1 />
			</form>
		</td>
	</tr>
</table>"); 
		
	}else{	print("<table align='center' style='margin-top:10px' width=450px >
				<tr>
					<th class='BorderInf'>
					<b>
					<font color='#FF0000'>
						NO EXISTE EL USUARIO.
						</br>
						PONGASE EN CONTACTO CON ADMIN SYSTEM.
					</font>
					</b>
					</th>
				 </tr>
				 <tr>
					<td valign='middle'  align='center'>
						<form name='cancel' action='indexcam.php' >
								<input type='submit'  value='CANCELAR Y VOLVER' class='botonnaranja' />
						</form>
					</td>
				</tr>
			</table>
	<embed src='../audi/user_lost.mp3' autostart='true' loop='false' width='0' height='0' hidden='true' >
	</embed>");
	 		}	

			 global $redir;
			 $redir = "<script type='text/javascript'>
							 function redir(){
							 window.location.href='indexcam.php';
						 }
						 setTimeout('redir()',6000);
						 </script>";
			 print ($redir);

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
