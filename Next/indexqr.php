<?php
session_start();
 
	//require 'Inclu/error_hidden.php';
	require 'Inclu/Inclu_Menu_qr.php';
	require 'Conections/conection.php';
	require 'Conections/conect.php';
	require 'Inclu/my_bbdd_clave.php';

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	if(isset($_GET['ocultop'])){ process_pinqr();
						  //ayear();
						  errors();
						}

	elseif (isset($_POST['cancel'])) {	unset($_SESSION['usuarios']); }

	else { process_pinqr();
		   //ayear();
		   errors();
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
		
	ayear();	
	
	global $vname;
	$tabla1 = $_SESSION['clave'].$_SESSION['usuarios'];
	$tabla1 = strtolower($tabla1);
	$vname = $tabla1."_".date('Y');
	$vname = "`".$vname."`";

			////////////////////		**********  		////////////////////

	// FICHA ENTRADA O SALIDA.
	
	$sql1 =  "SELECT * FROM `$db_name`.$vname WHERE $vname.`dout` = '' AND $vname.`tout` = '00:00:00' ";
	$q1 = mysqli_query($db, $sql1);
	$count1 = mysqli_num_rows($q1);

			////////////////////		**********  		////////////////////

	// FICHA ENTRADA.
	
	if($count1 < 1){
		
		global $din;
		global $tin;
		$din = date('Y-m-d');

		/*
			HORA ORIGINAL DE ENTRADA DEL SCRIPT
			$tin = date('H:i:s');
		*/

		require 'fichar/fichar_redondeo_in.php';

			////////////////////		***********  		////////////////////

		global $dout;
		global $tout;
		global $ttot;
		$dout = '';
		$tout = '00:00:00';
		$ttot = '00:00:00';
		
	$tabla = "<table align='center' style='margin-top:10px' width=300px >
				<tr>
					<th colspan=2 class='BorderInf'>
						HA FICHADO LA ENTRADA </br>".$rp['Nombre']." ".$rp['Apellidos']."
					</th>
				</tr>
												
				<tr>
					<td colspan=2 align='center'>
	<img src='Users/".$_SESSION['usuarios']."/img_admin/".$rp['myimg']."' height='40px' width='30px' />
					</td>
				</tr>
				
				<tr>
					<td>
						REFERENCIA
					</td>
					<td>"
						.$rp['ref'].
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
					<td colspan=2  valign='middle'  align='right'>
						<form name='cancel' action='indexcamini.php' >
									<input type='submit'  value='CERRAR / SALIR' class='botonnaranja' />
						</form>
	<embed src='audi/entrada.mp3' autostart='true' loop='false' width='0' height='0' hidden='true' >
	</embed>
				<script type='text/javascript'>
						function redir(){window.location.href='indexcamini.php';}
						setTimeout('redir()',5000);
				</script>
					</td>
				</tr>
			</table>";	
		
	global $db;
	global $db_name;
	
	global $vname;
	$tabla1 = $_SESSION['clave'].$_SESSION['usuarios'];
	$tabla1 = strtolower($tabla1);
	$vname = $tabla1."_".date('Y');
	$vname = "`".$vname."`";

	$sqla = "INSERT INTO `$db_name`.$vname (`ref`, `Nombre`, `Apellidos`, `din`, `tin`, `dout`, `tout`, `ttot`) VALUES ('$_SESSION[usuarios]', '$rp[Nombre]', '$rp[Apellidos]', '$din', '$tin', '$dout', '$tout', '$ttot')";
		
	if(mysqli_query($db, $sqla)){ 
		
			print($tabla);
		
			global $dir;
			$dir = "Users/".$_SESSION['usuarios']."/mrficha";

			global $text;
			$text = PHP_EOL."\t- NOMBRE: ".$rp['Nombre']." ".$rp['Apellidos'];
			$text = $text.PHP_EOL."\t- USER REF: ".$_SESSION['usuarios'];
			$text = $text.PHP_EOL."** F. ENTRADA ".$din." / ".$tin;
			
			$rmfdocu = $_SESSION['usuarios'];
			$rmfdate = date('Y_m');
			$rmftext = $text.PHP_EOL;
			$filename = $dir."/".$rmfdate."_".$rmfdocu.".txt";
			$rmf = fopen($filename, 'ab+');
			fwrite($rmf, $rmftext);
			fclose($rmf);
	
		} else {print("* MODIFIQUE LA ENTRADA L.153: ".mysqli_error($db));
					global $texerror;
					$texerror = PHP_EOL."\t ".mysqli_error($db);
				}
		
		}
	
	// FIN FICHA ENTRADA
	
			////////////////////		***********  		////////////////////

	// FICHA SALIDA.
	
	elseif($count1 > 0){
		
	global $dout;
	global $tout;
	global $ttot;
	$dout = date('Y-m-d');

		/*
			HORA ORIGINAL DE SALIDA DEL SCRIPT
			$tout = date('H:i:s');
		*/

		require 'fichar/fichar_redondeo_out.php';

			////////////////////		***********  		////////////////////

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
	$dout = trim($dout);
	$tout = trim($tout);
		
	global $out;
	$out = $dout." ".$tout;
	
	$fecha1 = new DateTime($in);//fecha inicial
	$fecha2 = new DateTime($out);//fecha de cierre

	global $difer;
	$difer = $fecha1->diff($fecha2);
	//print ($difer);
	
	global $ttot;
	$ttot = $difer->format('%H:%i:%s');

			////////////////////		***********  		////////////////////
	
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
				</table>
				<!--
				<embed src='audi/10horas.mp3' autostart='true' loop='false' width='0' height='0' hidden='true' >
				</embed>
				-->");
		
		global $ttot;
		$ttot = '03:22:02';
		global $text;
		$text = PHP_EOL."*** ERROR CONSULTE ADMIN SYSTEM ***";
		$text = $text.PHP_EOL."\t- FICHA SALIDA ".$dout." / ".$tout;
		$text = $text.PHP_EOL."\t- N HORAS: ".$ttot;

		} /* fin if >9 */

			else {	global $ttot;
					global $text;
					$text = PHP_EOL."** F. SALIDA ".$dout." / ".$tout;
					$text = $text.PHP_EOL."\t- N HORAS: ".$ttot;

	 } /* Fin else >9 */
	
			////////////////////		**********  		////////////////////
	
		$tabla = "<table align='center' style='margin-top:10px' width=300px >
					<tr>
						<th colspan=2 class='BorderInf'>
							HA FICHADO LA SALIDA </br>".$rp['Nombre']." ".$rp['Apellidos']."
						</th>
					</tr>

					<tr>
						<td colspan=2 align='center'>
		<img src='Users/".$_SESSION['usuarios']."/img_admin/".$rp['myimg']."' height='40px' width='30px' />
						</td>
					</tr>
				
					<tr>
						<td>
							REFERENCIA
						</td>
						<td>"
							.$_SESSION['usuarios'].
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
							.$dout.
						"</td>
					</tr>

					<tr>
						<td>
							HORA SALIDA
						</td>
						<td>"
							.$tout.
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
							<form name='cancel' action='indexcamini.php' >
									<input type='submit'  value='CERRAR / SALIR' class='botonnaranja' />
							</form>
		<embed src='audi/salida.mp3'  autostart='true' loop='false' width='0' height='0' hidden='true' >
		</embed>
				<script type='text/javascript'>
						function redir(){window.location.href='indexcamini.php';}
						setTimeout('redir()',5000);
				</script>
						</td>
					</tr>
				</table>";	
		
	//print($in." / ".$out." / ".$ttot."</br>");
	//echo $difer->format('%Y años %m meses %d days %H horas %i minutos %s segundos');
						//00 años 0 meses 0 días 08 horas 0 minutos 0 segundos

	$sqla = "UPDATE `$db_name`.$vname SET `dout` = '$dout', `tout` = '$tout', `ttot` =  '$ttot' WHERE $vname.`dout` = '' AND $vname.`tout` = '00:00:00' LIMIT 1 ";
		
		if(mysqli_query($db, $sqla)){ 
			
			print($tabla); 
			suma_todo();
			
			$dir = "Users/".$_SESSION['usuarios']."/mrficha";

			global $sumatodo;
			global $text;
			$text = $text.PHP_EOL."** H. TOT. MES: ".$sumatodo;
			$text = $text.PHP_EOL."**********".PHP_EOL;
			$rmfdocu = $_SESSION['usuarios'];
			$rmfdate = date('Y_m');
			$rmftext = $text.PHP_EOL;
			$filename = $dir."/".$rmfdate."_".$rmfdocu.".txt";
			$rmf = fopen($filename, 'ab+');
			fwrite($rmf, $rmftext);
			fclose($rmf);
	
	} else {print("* MODIFIQUE LA ENTRADA L.368: ".mysqli_error($db));
					global $texerror;
					$texerror = PHP_EOL."\t ".mysqli_error($db);
				}
		}
		
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
						<form name='cancel' action='cam/indexcam.php' >
									<input type='submit'  value='CANCELAR Y VOLVER' class='botonnaranja' />
						</form>
					</td>
				</tr>
			</table>
	<embed src='audi/user_lost.mp3' autostart='true' loop='false' width='0' height='0' hidden='true' >
	</embed>");
	 		}	
	
} // FIN FUNCTION 

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

	require 'fichar/Inc_Suma_Todo.php';

}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function errors(){
	
	global $db;
	global $db_name;
	
	global $sesus;
	$sesus = $_SESSION['usuarios'];

	require 'fichar/Inc_errors.php';

}	

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////
	
function modif(){
									   							
	$filename = "Users/".$_SESSION['usuarios']."/ayear.php";
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

	$filename = "Users/".$_SESSION['usuarios']."/year.txt";
	$fw2 = fopen($filename, 'w+');
	$date = "".date('Y')."";
	fwrite($fw2, $date);
	fclose($fw2);
	global $dat2;
	$dat2 = "\tMODIFICADO Y ACTUALIZADO ".$filename.PHP_EOL;
}

function modif2b(){

	$filename = "config/year.txt";
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
	
	$vname = $_SESSION['clave'].$_SESSION['usuarios']."_".date('Y');
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
		
	if(mysqli_query($db, $tcl)){	global $dat4;
									$dat4 = "\t* OK TABLA ADMIN ".$vname.PHP_EOL;
			
				} else {	global $dat4;
							$dat4 = "\t* NO OK TABLA ADMIN. ".mysqli_error($db).PHP_EOL;
							}
	}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////
	
function ayear(){
	$filename = "Users/".$_SESSION['usuarios']."/year.txt";
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
		
	global $dir;
	$dir = "Users/".$_SESSION['usuarios']."/log";
	
	$logdocu = $_SESSION['usuarios'];
	$logdate = date('Y_m_d');
	
	$logtext = PHP_EOL."** EL AÑO HA CAMBIADO **".PHP_EOL.".\t User Ref: ".$_SESSION['usuarios'];
	$logtext = $logtext.PHP_EOL.$datos;

	$filename = $dir."/".$logdate."_".$logdocu.".log";
	$log = fopen($filename, 'ab+');
	fwrite($log, $logtext);
	fclose($log);
		
		}
}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////
	
	function salir() {	unset($_SESSION['id']);
						unset($_SESSION['Nivel']);
						unset($_SESSION['Nombre']);
						unset($_SESSION['Apellidos']);
						unset($_SESSION['doc']);
						unset($_SESSION['dni']);
						unset($_SESSION['ldni']);
						unset($_SESSION['Email']);
						unset($_SESSION['Usuario']);
						unset($_SESSION['Password']);
						unset($_SESSION['Direccion']);
						unset($_SESSION['Tlf1']);
						unset($_SESSION['Tlf2']);
					}
	
				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	require 'Inclu/Admin_Inclu_footer.php';
	
				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

/* Creado por Juan Barros Pazos 2021 */
?>
