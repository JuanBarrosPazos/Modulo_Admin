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

	require '../'.$_SESSION['menu'].'/rutacam.php';
	require '../'.$_SESSION['menu'].'/Master_Index.php';

	if(isset($_POST['entrada'])){	pin_in();
										//errors();
								}
							
	elseif(isset($_POST['salida'])){	pin_out();
										//errors();
								}

	elseif (isset($_POST['cancel'])) {	red(); }

	elseif(isset($_GET['ocultop'])){ process_pin();
							  		 //ayear();
							  		 errors();
									}

	elseif(isset($_GET['pin']) != ''){ 	process_pin();
										//ayear();
							 			errors();
							  			}

	else {	show_form2();}

}else { require '../Inclu/table_permisos.php'; }

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function red(){
	global $redir;
	$redir = "<script type='text/javascript'>
					function redir(){
					window.location.href='indexcam.php';
				}
				setTimeout('redir()',500);
			</script>";
	print ($redir);
}
				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function modif(){
									   							
	$filename = "../Users/".$_SESSION['ref']."/ayear.php";
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
	global $dat1;
	$dat1 = "\tMODIFICADO Y ACTUALIZADO ".$filename.PHP_EOL;
}

function modif2(){

	$filename = "../Users/".$_SESSION['ref']."/year.txt";
	$fw2 = fopen($filename, 'w+');
	$date = "".date('Y')."";
	fwrite($fw2, $date);
	fclose($fw2);
	global $dat2;
	$dat2 = "\tMODIFICADO Y ACTUALIZADO ".$filename.PHP_EOL;
}

function modif2b(){

	$filename = "../config/year.txt";
	$fw2 = fopen($filename, 'w+');
	$date = "".date('Y')."";
	fwrite($fw2, $date);
	fclose($fw2);
	global $dat3;
	$dat3 = "\tMODIFICADO Y ACTUALIZADO ".$filename.PHP_EOL;
}

function tcl(){
	
	global $db;
	global $db_name;
	
	$vname = $_SESSION['clave'].$_SESSION['ref']."_".date('Y');
	$vname = "`".$vname."`";
	
	$tcl = "CREATE TABLE IF NOT EXISTS `$db_name`.$vname (
  `id` int(4) NOT NULL auto_increment,
  `ref` varchar(20) collate utf8_spanish2_ci NOT NULL,
  `Nombre` varchar(25) collate utf8_spanish2_ci NOT NULL,
  `Apellidos` varchar(25) collate utf8_spanish2_ci NOT NULL,
  `din` varchar(10) collate utf8_spanish2_ci NOT NULL,
  `tin` time NOT NULL,
  `dout` varchar(10) collate utf8_spanish2_ci NULL,
  `tout` time NULL,
  `ttot` time NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=1 ";
		
	if(mysqli_query($db , $tcl)){
		
					global $dat4;
					$dat4 = "\t* OK TABLA ADMIN ".$vname.PHP_EOL;
			
				} else {
					
					global $dat4;
					$dat4 = "\t* NO OK TABLA ADMIN. ".mysqli_error($db).PHP_EOL;
					
					}
}
					
				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function ayear(){
	$filename = "../Users/".$_SESSION['ref']."/year.txt";
	$fw2 = fopen($filename, 'r+');
	$fget = fgets($fw2);
	fclose($fw2);
	
	if($fget == date('Y')){
		/*print(" <div style='clear:both'></div>
				<div style='width:200px'>* EL AÑO ES EL MISMO</br>&nbsp;&nbsp;&nbsp;".date('Y')." == ".$fget."</div>"); */
				}
	elseif($fget != date('Y')){ 
		print(" <div style='clear:both'></div>
				<div style='width:200px'>* EL AÑO HA CAMBIADO</div>");/*</br>&nbsp;&nbsp;&nbsp;".date('Y')." != ".$fget." */
		modif();
		modif2();
		modif2b();
		tcl();
		global $dat1;	global $dat2;	global $dat3;	global $dat4;
		global $datos;
		$datos = $dat1.$dat2.$dat3.$dat4.PHP_EOL;
		}
}


				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function validate_formp(){
	
	global $db;
	global $db_name;

	global $table_name_a;
	$table_name_a = "`".$_SESSION['clave']."admin`";

	$sqlp =  "SELECT * FROM `$db_name`.$table_name_a WHERE $table_name_a.`dni` = '$_POST[pin]' ";
	$qp = mysqli_query($db, $sqlp);
	$cp = mysqli_num_rows($qp);
	
	$errorsp = array();
	
	if (strlen(trim($_POST['pin'])) == 0){
		//$errorsp [] = "PIN: Campo obligatorio.";
		$errorsp [] = "USER ACCES PIN ERROR";
		}

	elseif (strlen(trim($_POST['pin'])) < 8){
		//$errorsp [] = "PIN: Incorrecto.";
		$errorsp [] = "USER ACCES PIN ERROR";
		}

	elseif (strlen(trim($_POST['pin'])) > 8){
		//$errorsp [] = "PIN: Incorrecto.";
		$errorsp [] = "USER ACCES PIN ERROR";
		}
	
	elseif (!preg_match('/^[A-Z\d]+$/',$_POST['pin'])){
		//$errorsp [] = "PIN: Incorrecto.";
		$errorsp [] = "USER ACCES PIN ERROR";
		}
	
	/*
	elseif (!preg_match('/^[^a-z@´`\'áéíóú#$&%<>:"·\(\)=¿?!¡\[\]\{\};,\/:\.\*]+$/',$_POST['pin'])){
		$errors [] = "PIN: Incorrecto.";
		}

	elseif (!preg_match('/^[^a-z]+$/',$_POST['pin'])){
		$errors [] = "PIN: Incorrecto.";
		}*/
	
	elseif($cp == 0){
		//$errorsp [] = "PIN: Incorrecto.";
		$errorsp [] = "USER ACCES PIN ERROR";
		}

	return $errorsp;

		}


				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function errors(){
	
	global $db;
	global $db_name;
	
	global $sesus;
	$sesus = $_SESSION['ref'];

	require '../fichar/Inc_errors.php';

}	

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function show_ficha(){
	
	global $db;
	global $db_name;
	
	global $vname;
	$tabla1 = $_SESSION['clave'].$_SESSION['ref'];
	$tabla1 = strtolower($tabla1);
	$vname = $tabla1."_".date('Y');
	$vname = "`".$vname."`";

	// FICHA ENTRADA O SALIDA.
	
	$sql1 =  "SELECT * FROM `$db_name`.$vname WHERE $vname.`dout` = '' AND $vname.`tout` = '00:00:00' ";
	$q1 = mysqli_query($db, $sql1);
	$count1 = mysqli_num_rows($q1);

	// FICHA ENTRADA.
	
	if($count1 < 1){
		
		global $din;
		global $tin;
		$din = date('Y-m-d');
		$tin = date('H:i:s');

		global $dout;
		global $tout;
		global $ttot;
		$dout = '';
		$tout = '00:00:00';
		$ttot = '00:00:00';
		
	print("<table align='center' style=\"margin-top:2px\">
			<tr>
				<td>
					".$_SESSION['Nombre']." ".$_SESSION['Apellidos'].". Ref: ".$_SESSION['ref']."
				</td>
					<td valign='middle'  align='center'>
	<form name='form_datos' method='post' action='fichar/fichar_Crear.php' enctype='multipart/form-data'>
		<input type='hidden' id='ref' name='ref' value='".$_SESSION['ref']."' />
		<input type='hidden' id='name1' name='name1' value='".$_SESSION['Nombre']."' />
		<input type='hidden' id='name2' name='name2' value='".$_SESSION['Apellidos']."' />
		<input type='hidden' id='din' name='din' value='".$din."' />
		<input type='hidden' id='tin' name='tin' value='".$tin."' />
		<input type='hidden' id='dout' name='dout' value='".$dout."' />
		<input type='hidden' id='tout' name='tout' value='".$tout."' />
		<input type='hidden' id='ttot' name='ttot' value='".$ttot."' />
						<input type='submit' value='FICHAR ENTRADA' class='botonverde' />
						<input type='hidden' name='entrada' value=1 />
	</form>														
					</td>
				</tr>
				
			</table>			
						"); 
		}
	
	// FICHA SALIDA.
	
	elseif($count1 > 0){
		

		global $dout;
		global $tout;
		global $ttot;
		$dout = date('Y-m-d');
		$tout = date('H:i:s');

	print("<table align='center' style=\"margin-top:6px\">
			<tr>
				<td>
					".$_SESSION['Nombre']." ".$_SESSION['Apellidos'].". Ref: ".$_SESSION['ref']."
				</td>
				<td valign='middle'  align='center'>
	<form name='form_datos' method='post' action='fichar/fichar_Crear.php' enctype='multipart/form-data'>
		<input type='hidden' id='ref' name='ref' value='".$_SESSION['ref']."' />
		<input type='hidden' id='name1' name='name1' value='".$_SESSION['Nombre']."' />
		<input type='hidden' id='name2' name='name2' value='".$_SESSION['Apellidos']."' />
		<input type='hidden' id='dout' name='dout' value='".$dout."' />
		<input type='hidden' id='tout' name='tout' value='".$tout."' />
						<input type='submit' value='FICHAR SALIDA' class='botonverde' />
						<input type='hidden' name='salida' value=1 />
		</form>														
					</td>
				</tr>
			</table>"); 
		
		}
	
	}	

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function process_pin(){
	
	global $db;
	global $db_name;
	
	global $qrp;
	
	if ((isset($_GET['ocultop']))  || (isset($_GET['pin']) != '')){ $qrp = $_GET['pin']; }
	else{ $qrp = $_POST['pin']; }
	
	global $table_name_a;
	$table_name_a = "`".$_SESSION['clave']."admin`";

	$sqlp =  "SELECT * FROM `$db_name`.$table_name_a WHERE $table_name_a.`dni` = '$qrp' ";
	$qp = mysqli_query($db, $sqlp);
	$cp = mysqli_num_rows($qp);
	$rp = mysqli_fetch_assoc($qp);
	
	$_SESSION['usuarios'] = $rp['ref'];
	$_SESSION['ref'] = $rp['ref'];

	if ($cp > 0){
	
	global $vname;
	$tabla1 = $_SESSION['clave'].$rp['ref'];
	$tabla1 = strtolower($tabla1);
	$vname = $tabla1."_".date('Y');
	$vname = "`".$vname."`";

	// FICHA ENTRADA O SALIDA.
	
	$sql1 =  "SELECT * FROM `$db_name`.$vname WHERE $vname.`dout` = '' AND $vname.`tout` = '00:00:00' ";
	$q1 = mysqli_query($db, $sql1);
	$count1 = mysqli_num_rows($q1);

	// FICHA ENTRADA.
	
	if($count1 < 1){
		
		global $din;
		global $tin;
		$din = date('Y-m-d');
		$tin = date('H:i:s');

		global $dout;
		global $tout;
		global $ttot;
		$dout = '';
		$tout = '00:00:00';
		$ttot = '00:00:00';
		
	print("<table align='center' style=\"margin-top:6px\">
			<tr>
				<td>
	<img src='../Users/".$rp['ref']."/img_admin/".$rp['myimg']."' height='40px' width='30px' />
				</td>
				<td>
					".$rp['Nombre']." ".$rp['Apellidos'].". Ref: ".$rp['ref']."
				</td>
				<td valign='middle'  align='center'>
	<form name='form_datos' method='post' action='$_SERVER[PHP_SELF]' enctype='multipart/form-data'>
		<input name='myimg' type='hidden' value='".$rp['myimg']."' />
		<input type='hidden' id='ref' name='ref' value='".$rp['ref']."' />
		<input type='hidden' id='name1' name='name1' value='".$rp['Nombre']."' />
		<input type='hidden' id='name2' name='name2' value='".$rp['Apellidos']."' />
		<input type='hidden' id='din' name='din' value='".$din."' />
		<input type='hidden' id='tin' name='tin' value='".$tin."' />
		<input type='hidden' id='dout' name='dout' value='".$dout."' />
		<input type='hidden' id='tout' name='tout' value='".$tout."' />
		<input type='hidden' id='ttot' name='ttot' value='".$ttot."' />
					<input type='submit' value='FICHAR ENTRADA' class='botonverde' />
					<input type='hidden' name='entrada' value=1 />
	</form>														
				</td>
			<form name='fcancel' method='post' action='$_SERVER[PHP_SELF]' >
				<td valign='middle'  align='center'>
						<input type='submit' value='CANCELAR Y VOLVER' class='botonnaranja' />
						<input type='hidden' name='cancel' value=1 />
				</td>
			</form>
		</tr>
<embed src='../audi/conf_user_data.mp3' autostart='true' loop='false' width='0' height='0' hidden='true' >
</embed>
	</table>");

	global $redir;
	$redir = "<script type='text/javascript'>
						function redir(){
						window.location.href='indexcam.php';
					}
					setTimeout('redir()',14000);
					</script>";
		print ($redir);

		}
	
	// FICHA SALIDA.
	
	elseif($count1 > 0){
		
		global $dout;
		global $tout;
		global $ttot;
		$dout = date('Y-m-d');
		$tout = date('H:i:s');

	print("<table align='center' style=\"margin-top:6px\">
			<tr>
				<td>
	<img src='../Users/".$rp['ref']."/img_admin/".$rp['myimg']."' height='40px' width='30px' />
				</td>
				<td>
					".$rp['Nombre']." ".$rp['Apellidos'].". Ref: ".$rp['ref']."
				</td>
				<td valign='middle'  align='center'>
		<form name='form_datos' method='post' action='$_SERVER[PHP_SELF]' enctype='multipart/form-data'>
			<input name='myimg' type='hidden' value='".$rp['myimg']."' />
			<input type='hidden' id='ref' name='ref' value='".$rp['ref']."' />
			<input type='hidden' id='name1' name='name1' value='".$rp['Nombre']."' />
			<input type='hidden' id='name2' name='name2' value='".$rp['Apellidos']."' />
			<input type='hidden' id='dout' name='dout' value='".$dout."' />
			<input type='hidden' id='tout' name='tout' value='".$tout."' />
						<input type='submit' value='FICHAR SALIDA' class='botonverde' />
						<input type='hidden' name='salida' value=1 />
		</form>														
					</td>
				<form name='fcancel' method='post' action='$_SERVER[PHP_SELF]' >
					<td valign='middle'  align='center'>
							<input type='submit' value='CANCELAR Y VOLVER' class='botonnaranja' />
							<input type='hidden' name='cancel' value=1 />
					</td>
				</form>
			</tr>
<embed src='../audi/conf_user_data.mp3' autostart='true' loop='false' width='0' height='0' hidden='true' >
</embed>
			</table>"); 
		
		}
	
	ayear();
		
	}else{		print("<table align='center' style='margin-top:10px' width=450px >
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
				 	<form name='fcancel' method='post' action='$_SERVER[PHP_SELF]' >
						<input type='submit' value='CANCELAR Y VOLVER' class='botonnaranja' />
						<input type='hidden' name='cancel' value=1 />
					</form>
					</td>
				</tr>
	<embed src='../audi/user_lost.mp3' autostart='true' loop='false' width='0' height='0' hidden='true' >
	</embed>
			</table>");

	 	global $redir;
		$redir = "<script type='text/javascript'>
							function redir(){
							window.location.href='indexcam.php';
						}
						setTimeout('redir()',4000);
						</script>";
			print ($redir);

		 	}			
		
} // FIN FUNCTION

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function pin_out(){
	
	global $db;
	global $db_name;
	
	$_SESSION['usuarios'] = $_POST['ref'];

	global $vname;
	$tabla1 = $_SESSION['clave'].$_POST['ref'];
	$tabla1 = strtolower($tabla1);
	$vname = $tabla1."_".date('Y');
	$vname = "`".$vname."`";

	$sql1 =  "SELECT * FROM `$db_name`.$vname WHERE $vname.`dout` = '' AND $vname.`tout` = '00:00:00' LIMIT 1 ";
	$q1 = mysqli_query($db, $sql1);
	$count1 = mysqli_num_rows($q1);
	$row1 = mysqli_fetch_assoc($q1);
	global $din;
	global $tin;
	$din = trim($row1['din']);
	$tin = trim($row1['tin']);
	global $in;
	$in = $din." ".$tin;
	global $dout;
	global $tout;
	$dout = trim($_POST['dout']);
	$tout = trim($_POST['tout']);
	global $out;
	$out = $dout." ".$tout;
	
	$fecha1 = new DateTime($in);//fecha inicial
	$fecha2 = new DateTime($out);//fecha de cierre

	global $difer;
	$difer = $fecha1->diff($fecha2);
	//print ($difer);
	
	global $ttot;
	$ttot = $difer->format('%H:%i:%s');

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////
	
	$ttot1 = $difer->format('%H:%i:%s');
	global $ttoth;
	$ttoth = substr($ttot1,0,2);
	$ttoth = str_replace(":","",$ttoth);
	
	$ttot2 = $difer->format('%d-%H:%i:%s');
	global $ttotd;
	$ttotd = substr($ttot2,0,2);
	$ttotd = str_replace("-","",$ttotd);
	

	if (($ttoth > 9)||($ttotd > 0)){
		
		print("<table align='center' style='margin-top:10px' width=450px >
				<tr>
					<th class='BorderInf'>
					<b>
					<font color='#FF0000'>
						NO PUEDE FICHAR MÁS DE 10 HORAS.
						</br>
						PONGASE EN CONTACTO CON ADMIN SYSTEM.
					</font>
					</b>
					</th>
				 </tr>
				</table>");
		
					global $ttot;
					$ttot = '03:22:02';
					global $text;
					$text = PHP_EOL."*** ERROR CONSULTE ADMIN SYSTEM ***";
					$text = $text.PHP_EOL."\t- FICHA SALIDA ".$_POST['dout']." / ".$_POST['tout'];
					$text = $text.PHP_EOL."\t- N HORAS: ".$ttot;

					} /* fin if >9 */

			else {	global $ttot;
					global $text;
					$text = PHP_EOL."** F. SALIDA ".$_POST['dout']." / ".$_POST['tout'];
					$text = $text.PHP_EOL."\t- N HORAS: ".$ttot;

			 } /* Fin else >9 */
	
				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////
	
			$tabla = "<table align='center' style='margin-top:10px' width=320px >
							<tr>
								<th colspan=2 class='BorderInf'>
									HA FICHADO LA SALIDA</br>".$_POST['name1']." ".$_POST['name2']."
								</th>
							</tr>

							<tr>
								<td colspan=2 align='center'>
		<img src='../Users/".$_POST['ref']."/img_admin/".$_POST['myimg']."' height='40px' width='30px' />
								</td>
							</tr>
				
							<tr>
								<td>
									REFERENCIA
								</td>
								<td>"
									.$_POST['ref'].
								"</td>
							</tr>

							<tr>
								<td>	
									FECHA ENTRADA
								</td>
								<td>"
									.$din.
								"</td>
							</tr>

							<tr>
								<td>
									HORA ENTRADA
								</td>
								<td>"
									.$tin.
								"</td>
							</tr>

							<tr>
								<td>	
									FECHA SALIDA
								</td>
								<td>"
									.$_POST['dout'].
								"</td>
							</tr>

							<tr>
								<td>
									HORA SALIDA
								</td>
								<td>"
									.$_POST['tout'].
								"</td>
							</tr>

							<tr>
								<td>
									HORAS REALIZADAS
								</td>
								<td>"
									.$ttot.
								"</td>
							</tr>
				<tr>
					<td colspan=2  valign='middle'  align='right'>
				<form name='fcancel' method='post' action='$_SERVER[PHP_SELF]' >
									<input type='submit' value='VOLVER INICIO' class='botonnaranja' />
									<input type='hidden' name='cancel' value=1 />
				</form>	
				<embed src='../audi/salida.mp3' autostart='true' loop='false' width='0' height='0' hidden='true' >
				</embed>
					</td>
				</tr>
			</table>";	
		
	//print($in." / ".$out." / ".$ttot."</br>");
	//echo $difer->format('%Y años %m meses %d days %H horas %i minutos %s segundos');
						//00 años 0 meses 0 días 08 horas 0 minutos 0 segundos

	$sqla = "UPDATE `$db_name`.$vname SET `dout` = '$_POST[dout]', `tout` = '$_POST[tout]', `ttot` =  '$ttot' WHERE $vname.`dout` = '' AND $vname.`tout` = '00:00:00' LIMIT 1 ";
		
		if(mysqli_query($db, $sqla)){ 
			
			print($tabla); 
			suma_todo();

					global $dir;
					$dir = "../Users/".$_POST['ref']."/mrficha";

					global $sumatodo;
					global $text;
					$text = $text.PHP_EOL."** H. TOT. MES: ".$sumatodo;
					$text = $text.PHP_EOL."**********".PHP_EOL;
					$rmfdocu = $_POST['ref'];
					$rmfdate = date('Y_m');
					$rmftext = $text.PHP_EOL;
					$filename = $dir."/".$rmfdate."_".$rmfdocu.".txt";
					$rmf = fopen($filename, 'ab+');
					fwrite($rmf, $rmftext);
					fclose($rmf);
			
			global $redir;
			$redir = "<script type='text/javascript'>
							function redir(){
							window.location.href='indexcam.php';
						}
						setTimeout('redir()',8000);
						</script>";
			print ($redir);
	
		} else {
					print("* MODIFIQUE LA ENTRADA L.1054: ".mysqli_error($db));
							show_form2();
							show_form ();
							global $texerror;
							$texerror = PHP_EOL."\t ".mysqli_error($db);
					}
	
	}	

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function pin_in(){
	
	$tabla = "<table align='center' style='margin-top:10px' width=320px >
				<tr>
					<th colspan=2 class='BorderInf'>
						HA FICHADO LA ENTRADA</br>".$_POST['name1']." ".$_POST['name2']."
					</th>
				</tr>
												
				<tr>
					<td colspan=2 align='center'>
	<img src='../Users/".$_POST['ref']."/img_admin/".$_POST['myimg']."' height='40px' width='30px' />
					</td>
				</tr>
				
				<tr>
					<td>
						REFERENCIA
					</td>
					<td>"
						.$_POST['ref'].
					"</td>
				</tr>
				
				<tr>
					<td>	
						FECHA ENTRADA
					</td>
					<td>"
						.$_POST['din'].
					"</td>
				</tr>
				
				<tr>
					<td>
						HORA ENTRADA
					</td>
					<td>"
						.$_POST['tin'].
					"</td>
				</tr>
								
				<tr>
					<td colspan=2  valign='middle'  align='right'>
				<form name='fcancel' method='post' action='$_SERVER[PHP_SELF]' >
									<input type='submit' value='VOLVER INICIO' class='botonnaranja' />
									<input type='hidden' name='cancel' value=1 />
				</form>
				<embed src='../audi/entrada.mp3' autostart='true' loop='false' width='0' height='0' hidden='true' >
				</embed>
					</td>
				</tr>
			</table>";	
		
	global $db;
	global $db_name;
	
	$_SESSION['usuarios'] = $_POST['ref'];

	global $vname;
	$tabla1 = $_SESSION['clave'].$_POST['ref'];
	$tabla1 = strtolower($tabla1);
	$vname = $tabla1."_".date('Y');
	$vname = "`".$vname."`";

	$sqla = "INSERT INTO `$db_name`.$vname (`ref`, `Nombre`, `Apellidos`, `din`, `tin`, `dout`, `tout`, `ttot`) VALUES ('$_POST[ref]', '$_POST[name1]', '$_POST[name2]', '$_POST[din]', '$_POST[tin]', '$_POST[dout]', '$_POST[tout]', '$_POST[ttot]')";
		
	if(mysqli_query($db, $sqla)){ 
		
			print($tabla);
		
			global $dir;
			$dir = "../Users/".$_SESSION['usuarios']."/mrficha";

			global $text;
			$text = PHP_EOL."\t- NOMBRE: ".$_POST['name1']." ".$_POST['name2'];
			$text = $text.PHP_EOL."\t- USER REF: ".$_POST['ref'];
			$text = $text.PHP_EOL."** F. ENTRADA ".$_POST['din']." / ".$_POST['tin'];
			
					$rmfdocu = $_POST['ref'];
					$rmfdate = date('Y_m');
					$rmftext = $text.PHP_EOL;
					$filename = $dir."/".$rmfdate."_".$rmfdocu.".txt";
					$rmf = fopen($filename, 'ab+');
					fwrite($rmf, $rmftext);
					fclose($rmf);
		
			global $redir;
			$redir = "<script type='text/javascript'>
							function redir(){
							window.location.href='indexcam.php';
						}
						setTimeout('redir()',8000);
						</script>";
			print ($redir);

		} else {
					print("* MODIFIQUE LA ENTRADA L.1151: ".mysqli_error($db));
							show_form2();
							show_form ();
							global $texerror;
							$texerror = PHP_EOL."\t ".mysqli_error($db);
				}
	
	}	


				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function suma_todo(){
		
	global $db;
	global $db_name;
	
	global $dyt;
	$dyt = date('Y');
	global $dm;
	$dm = "-".date('m')."-";
	global $dd;
	$dd = '';
	global $fil;											
	$fil = $dyt.$dm."%";

	$tabla1 = $_SESSION['clave'].$_SESSION['usuarios'];
	$tabla1 = strtolower($tabla1);
	global $vname;
	$vname = $tabla1."_".$dyt;
	$vname = "`".$vname."`";

	require '../fichar/Inc_Suma_Todo.php';

}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function show_form2($errorsp=''){
	
	if(isset($_POST['pin'])){
		$defaults = $_POST;
		} else {$defaults = array ('pin' => '');}
	
	if ($errorsp){
		print("	<table align='center'>
					<tr>
						<td style='text-align:center'>
							<!--
							<font color='#FF0000'>* SOLUCIONE ESTOS ERRORES:</font><br/>
							-->
							<font color='#FF0000'>ERROR ACCESO PIN</font>
						</td>
					</tr>
					<!--
					<tr>
						<td style='text-align:left'>
					-->");
			
		/*
		for($a=0; $c=count($errorsp), $a<$c; $a++){
			print("<font color='#FF0000'>**</font>  ".$errorsp [$a]."<br/>");
			}
		*/
		print("<!--</td>
				  </tr>-->
	<embed src='../audi/pin_error.mp3' autostart='true' loop='false' width='0' height='0' hidden='true' >
	</embed>
		</table>");
		}
	
	print("<table align='center' style=\"margin-top:2px; margin-bottom:2px\" >
				
				<tr>
					<th colspan=3 class='BorderSup' style='padding-top: 10px'>
							<a href='indexcam.php'>
									GO TO QR SCANNER CAM
							</a>
					</th>
				</tr>
				
			</table>"); 
	
	}


				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function ver_todo(){
		
	global $db;
	global $db_name;
	
	global $dyt1;
	$dyt1 = date('Y');
	global $dm1;
	global $dd1;
	$dm1 = date('m');
	$dd1 = '';
	global $fil;												
	$fil = "%".$dyt1."-%".$dm1."%-".$dd1."%";

	$tabla1 = $_SESSION['clave'].$_SESSION['ref'];
	$tabla1 = strtolower($tabla1);
	global $vname;
	$vname = $tabla1."_".$dyt1;
	$vname = "`".$vname."`";

	require '../fichar/Inc_Suma_Todo.php';

//////////////////////////
	
	$sqlb =  "SELECT * FROM $vname WHERE `din` LIKE '$fil' ORDER BY  `din` ASC ";
	$qb = mysqli_query($db, $sqlb);
	
	if(!$qb){
			print("<font color='#FF0000'>Se ha producido un error L.773: </font></br>".mysqli_error($db)."</br>");
			
		} else {
			
			if(mysqli_num_rows($qb) == 0){
							print ("<table align='center'>
										<tr>
											<td>
												<font color='#FF0000'>
													NO HAY DATOS ESTE MES ".date('Y/m')."
												</font>
											</td>
										</tr>
									</table>");


				} else { 	print ("<table align='center'>
									<tr>
										<th colspan=6 class='BorderInf'>
								".$_SESSION['Nombre']." ".$_SESSION['Apellidos'].". Ref: ".$_SESSION['ref'].". "
								   .mysqli_num_rows($qb)." RESULTADOS.
										</th>
									</tr>
									
									<tr>
										
										<th class='BorderInfDch'>
												ID
										</th>																			
										
										<th class='BorderInfDch'>
												DATE IN
										</th>																			
										
										<th class='BorderInfDch'>
												TIME IN
										</th>																			
										
										<th class='BorderInfDch'>
												DATE OUT
										</th>										

										<th class='BorderInfDch'>
												TIME OUT
										</th>
										
										<th class='BorderInfDch'>
												TIME TOT
										</th>
										
									</tr>");
			
			while($rowb = mysqli_fetch_assoc($qb)){

			print (	"<tr align='center'>
									
						<td class='BorderInfDch' align='center'>
																".$rowb['id']."
						</td>

						<td class='BorderInfDch' align='left'>
																".$rowb['din']."
						</td>
						
						<td class='BorderInfDch' align='right'>
																".$rowb['tin']."
						</td>
						
						<td class='BorderInfDch' align='right'>
																".$rowb['dout']."
						</td>

						<td class='BorderInfDch' align='right'>
																".$rowb['tout']."
						</td>

						<td class='BorderInfDch' align='right'>
																".$rowb['ttot']."
						</td>

					</tr>");
					
								} /* Fin del while.*/ 

									print("		<tr>
										<td colspan='6' class='BorderInf'>
										</td>
									</tr>
						
									<tr>
										
										<td colspan='3' class='BorderInf' align='right'>
												HORAS TOTALES:
										</td>
																				
										
										<td colspan='3' class='BorderInf' align='left'>
												".$sumatodo."
										</td>
										
																				
									</tr>
						</table>
								");
		
						} /* Fin segundo else anidado en if */

			} /* Fin de primer else . */
		
	}	/* Final ver_todo(); */


				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	require '../Inclu/Admin_Inclu_footer.php';
	
				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

/* Creado por Juan Barros Pazos 2021 */

?>
