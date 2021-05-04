<?php

	require 'Inclu/error_hidden.php';
	require 'Inclu/Admin_Inclu_headb.php';
	require 'Inclu/my_bbdd_clave.php';

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	if(isset($_POST['limpia'])){
						deltables();
						deldirua();
						deldirub();
						deldiruc();
						rewrite();
						config_one();
			 			show_form();
		}

	elseif(isset($_POST['config'])){$_SESSION['inst'] = "noinst";						
		if($form_errors = validate_form()){show_form($form_errors);} 
		else {	process_form();
				require 'Conections/conection.php';
				$db = @mysqli_connect($db_host,$db_user,$db_pass,$db_name);
		
				if (!$db){ 	global $dbconecterror;
							$dbconecterror = $db_name." * ".mysqli_connect_error().PHP_EOL;
							print ("NO CONECTA A BBDD ".$db_name."</br>".mysqli_connect_error());
							show_form();
								} elseif($db) { config_one();
												crear_tablas();
												ayear();
												global $tablepf;
												print($tablepf);
												}
								}
		} else { inittot();
				 show_form();}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function inittot(){
	include 'Conections/conection.php';
	$db = @mysqli_connect($db_host,$db_user,$db_pass,$db_name);
	if (!$db){ //print ("Es imposible conectar con la bbdd ".$db_name."</br>".mysqli_connect_error());
				$_SESSION['inst'] = "noinst";
				global $inst;
				$inst = '';
	}else{
	global $inst;
	$inst = 1;

	global $table_name_a;
	$table_name_a = "`".$_SESSION['clave']."admin`";

	global $sqltadm;
	$sqltadm = "SELECT * FROM `$db_name`.$table_name_a ";
	if(($inst == 1)&&(@mysqli_num_rows(mysqli_query($db, $sqltadm)) < 1)){
		$_SESSION['inst'] = "inst";
		global $link;
		$link = "<tr>
					<th align='center' class='BorderInf'>
						<font color='#FF0000'>
							EXISTE UNA INSTALACION INCOMPLETA
						</font>
					</th>
				</tr>
				<tr>
					<th align='center'>
						CONTINUAR CON ESTA INSTALACIÓN
					</th>
				</tr>
				<tr>
					<td align='center' class='BorderInf'>
						<a href='config/config2.php'>
							CREE EL USUARIO ADMINISTRADOR
			 			</a>
							</br></br>
					</td>
				</tr>
				<tr>
					<th align='center'>
						INICIAR UNA INSTALACIÓN LIMPIA
					</th>
				</tr>
				<tr>
			<form name='limpia' action='$_SERVER[PHP_SELF]' method='post' >
				<td  align='center'>
			<input type='submit' value='ELIMINE TODOS LOS DATOS DEL SISTEMA' />
			<input type='hidden' name='limpia' value=1 />
			</br></br>
				</td>
			</fomr>
				</tr>";
}elseif(($inst == 1)&&(@mysqli_num_rows(mysqli_query($db, $sqltadm)) >= 1)){
			$_SESSION['inst'] = "inst";
			global $link;
			$link = "<tr>
						<th align='center' class='BorderInf'>
							<font color='#FF0000'>
								EXISTE UNA INSTALACION ANTERIOR
							</font>
						</th>
					</tr>
					<tr>
						<th align='center'>
							MANTENER TABLAS Y DIRECTORIOS
						</th>
					</tr>
					<tr>
				<form name='inscancel' action='config/config2.php' method='post' >
						<td align='center' class='BorderInf'>
				<input type='submit' value='CONTINUE CON LA CONFIGURACIÓN ACTUAL' />
				<input type='hidden' name='inscancel' value=1 />
				</br></br>
						</td>
				</form>
					</tr>
					<tr>
						<th align='center'>
							INICIAR UNA INSTALACIÓN LIMPIA
						</th>
					</tr>
					<tr>
				<form name='limpia' action='$_SERVER[PHP_SELF]' method='post' >
					<td  align='center'>
				<input type='submit' value='ELIMINE TODOS LOS DATOS DEL SISTEMA' />
				<input type='hidden' name='limpia' value=1 />
				</br></br>
					</td>
				</fomr>
					</tr>";
	}else{ 	$_SESSION['inst'] = "noinst";
			global $link;
		   	$link = "<tr>
		   				<td>
							<a href='config/config2.php'>
		   						CREE EL USUARIO ADMINISTRADOR
							</a>
						</td>
					</tr>";
				} // NO HAY DATOS EN LA BBDD
			} // CONDICIONAL SI CONECTO A LA BBDD
}	

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function config_one(){

	unset($_SESSION['showf']);

	$_SESSION['inst'] = "noinst";

	if(file_exists('config/year.txt')){unlink("config/year.txt");
					$data1 = PHP_EOL."\tUNLINK config/year.txt";}
			else {print("DON`T UNLINK config/year.txt </br>");
					$data1 = PHP_EOL."\tDON'T UNLINK config/year.txt";}

	if(file_exists('config/ayear.php')){unlink("config/ayear.php");
					$data2 = PHP_EOL."\tUNLINK config/ayear.php";}
			else {print("DON'T UNLINK config/ayear.php </br>");
					$data2 = PHP_EOL."\tDON'T UNLINK config/ayear.php";}

	if(!file_exists('config/year.txt')){
			if(file_exists('config/year_Init_System.txt')){
				copy("config/year_Init_System.txt", "config/year.txt");
				$data3 = PHP_EOL."\tRENAME config/year_Init_System.txt TO config/year.txt";
			} else {print("DON'T RENAME config/year_Init_System.txt TO config/year.txt </br>");
				$data3 = PHP_EOL."\tDON'T RENAME config/year_Init_System.txt TO config/year.txt";}
			}

	if(!file_exists('config/ayear.php')){
			if(file_exists('config/ayear_Init_System.php')){
				copy("config/ayear_Init_System.php", "config/ayear.php");
				$data4 = PHP_EOL."\tRENAME config/ayear_Init_System.php TO config/ayear.php";
			} else {print("DON'T RENAME config/ayear_Init_System.php TO config/ayear.php </br>");
				$data4 = PHP_EOL."\tDON'T RENAME config/ayear_Init_System.php TO config/ayear.php";}
			}
			
	global $cfone;
	$cfone = PHP_EOL."SUSTITUCION DE ARCHIVOS:".$data1.$data2.$data3.$data4;

	}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function deldirua(){

	require 'Conections/conection.php';
	
	$db = @mysqli_connect($db_host,$db_user,$db_pass,$db_name);

	global $table_name_a;
	$table_name_a = "`".$_SESSION['clave']."admin`";

	global $sqldu;
	$sqldu = "SELECT * FROM `$db_name`.$table_name_a";
	$qdu = mysqli_query($db, $sqldu);
	if(!$qdu){}
	else{
		// BORRA DIRECTORIOS DENTRO DEL USUARIO
		while($rown = mysqli_fetch_assoc($qdu)){
				$carpeta1 = "Users/".$rown['ref']."/img_admin";
				if(file_exists($carpeta1)){ $dir1 = $carpeta1."/";
											$handle1 = opendir($dir1);
											while ($file1 = readdir($handle1))
													{if (is_file($dir1.$file1))
														{unlink($dir1.$file1);}
													}
											rmdir ($carpeta1);
											} else {}
											
				$carpeta2 = "Users/".$rown['ref']."/log";
				if(file_exists($carpeta2)){ $dir2 = $carpeta2."/";
											$handle2 = opendir($dir2);
											while ($file2 = readdir($handle2))
													{if (is_file($dir2.$file2))
														{unlink($dir2.$file2);}
													}
											rmdir ($carpeta2);
											} else {}

		} // FIN DEL WHILE

	} // SE CUMPLE EL QUERY
} // FIN FUNCTION

function deldirub(){

	$carpetat = "Users/temp";
	if(file_exists($carpetat)){ $dirt = $carpetat."/";
								$handlet = opendir($dirt);
								while ($filet = readdir($handlet))
										{if (is_file($dirt.$filet))
											{unlink($dirt.$filet);}
										}
								rmdir ($carpetat);
								} else {}

	require 'Conections/conection.php';
	$db = @mysqli_connect($db_host,$db_user,$db_pass,$db_name);

	global $table_name_a;
	$table_name_a = "`".$_SESSION['clave']."admin`";

	global $sqldu;
	$sqldu = "SELECT * FROM `$db_name`.$table_name_a";
	$qdu = mysqli_query($db, $sqldu);
	if(!$qdu){}
	else{
		// BORRA DIRECTORIOS DEL USUARIO
		while($rowu = mysqli_fetch_assoc($qdu)){
			$carpeta4 = "Users/".$rowu['ref'];
			if(file_exists($carpeta4)){ $dir4 = $carpeta4."/";
										$handle4 = opendir($dir4);
										while ($file4 = readdir($handle4))
												{if (is_file($dir4.$file4))
													{unlink($dir4.$file4);}
												}
										rmdir ($carpeta4);
										} else {}
									}
	} // SE CUMPLE EL QUERY
} // FIN FUNCTION

function deldiruc(){

		// BORRA DIRECTORIO USUARIOS
			$carpeta5 = "Users";
			if(file_exists($carpeta5)){ $dir5 = $carpeta5."/";
										$handle5 = opendir($dir5);
										while ($file5 = readdir($handle5))
												{if (is_file($dir5.$file5))
													{unlink($dir5.$file5);}
												}
										rmdir ($carpeta5);
										} else {}
} // FIN FUNCTION


function deltables(){

	require 'Conections/conection.php';
	$db = @mysqli_connect($db_host,$db_user,$db_pass,$db_name);

	/*************		BORRAMOS TODAS LAS TABLAS DE USUARIOS Y SISTEMA		***************/

	require 'Inclu/my_bbdd_clave.php';

	/* Se busca las tablas en la base de datos */
	/* REFERENCIA DEL USUARIO O $_SESSION['iniref'] = $_POST['ref'] */
	/* $nom PARA LA CLAVE USUARIO ACOMPAÑANDA DE _ O NO */
	global $nom;
	$nom = $_SESSION['clave']."%"; // SOLO COINCIDEN AL PRINCIPIO
	$nom = "LIKE '$nom'";
	//$consulta = "SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_NAME $nom ";
	$consulta = "SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$db_name' AND TABLE_NAME $nom ";
	$respuesta = mysqli_query($db, $consulta);
	//$count = mysqli_num_rows($respuesta);
	//print("* NUMERO TABLAS: ".$count."<br>");
	//print("* CLAVE TABLA USUARIO: ".$nom."<br>");

	//global $fila;
	//$fila = mysqli_fetch_row($respuesta);

if(!$respuesta){
print("<font color='#FF0000'>300 Se ha producido un error: </font></br>".mysqli_error($db)."</br>");
	} else { 
		while ($fila = mysqli_fetch_row($respuesta)) {
			if($fila[0]){
		/* PROCEDEMOS A BORRAR LAS TABLAS DEL USUARIO */
			global $sqlt;
			$sqlt = "DROP TABLE `$db_name`.`$fila[0]` ";
			if(mysqli_query($db, $sqlt)){
				} else {
					//print ("<font color='#FF0000'>*** </font></br> ".mysqli_error($db).".</br>");
							} 
		/* HASTA AQUI BORRA TABLAS Y PASA LOS LOG DE BBDD */
					} // FIN IF $FILA[0]
				} // FIN WHILE

		// SE GRABAN LOS DATOS EN LOG DEL ADMIN
		
	} // FIN ELSE !$respuesta

}

function rewrite(){

/*	unlink("Conections/conection.php");*/


	$bddata = '<?php
	global $db_host;
	global $db_user;
	global $db_pass;
	global $db_name;
	$db_host = ""; 
	$db_user = ""; 
	$db_pass = ""; 
	$db_name = ""; 
	?>';

	$filename = "Conections/conection.php";
	$config = fopen($filename, 'w+');
	fwrite($config, $bddata);
	fclose($config);
	global $data5;
	$data5 = PHP_EOL."\tREWRITE Conections/conection.php";
	

}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function validate_form(){
	
	require 'config/validate_Init_System.php';
	
	return $errors;

		} 

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function process_form(){
	
	/************** CREAMOS EL ARCHIVO DE CONFIGURACIÓN **************/

	$host = "'".$_POST['host']."'";
	$user = "'".$_POST['user']."'";
	$pass = "'".$_POST['pass']."'";
	$name = "'".$_POST['name']."'";
	$clave = "'".$_POST['clave']."'";

	$bddata = '<?php
				global $db_host;
				global $db_user;
				global $db_pass;
				global $db_name;
				$db_host = '.$host.'; 
				$db_user = '.$user.'; 
				$db_pass = '.$pass.'; 
				$db_name = '.$name.'; 
				?>';

	/* CREA EL ARCHIVO DE CONEXIONES */

	$filename = "Conections/conection.php";
	$config = fopen($filename, 'w+');
	fwrite($config, $bddata);
	fclose($config);

	global $tablepf;
	$tablepf = "<table align='center'>
				<tr>
					<td colspan='2' align='center'>
							SE HA CREADO EL ARCHIVO DE CONEXIONES.
						</br>
							CON LAS SIGUIENTES VARIABLES.
					</td>
				</tr>

				<tr>
					<td>VARIABLE HOST ADRESS</td>
					<td>\$db_host = ".$host.";</td>		
				</tr>								

				<tr>
					<td>VARIABLE USER NAME</td>
					<td>\$db_user = ".$user.";</td>		
				</tr>	
												
				<tr>
					<td>VARIABLE PASSWORD</td>
					<td>\$db_pass = ".$pass.";</td>		
				</tr>	
												
				<tr>
					<td>VARIABLE BBDD NAME</td>
					<td>\$db_name = ".$name.";</td>		
				</tr>

				<tr>
					<td>CLAVE TABLES BBDD</td>
					<td>\$clave = ".$clave.";</td>		
				</tr>

				<tr>
		   			<td colspan=2 align='center'>
						<a href='config/config2.php'>
		   					CREE EL USUARIO ADMINISTRADOR
						</a>
					</td>
				</tr>
		</table>";

	$_SESSION["clave"] = strtolower($_POST['clave'])."_";
	// CREA EL ARCHIVO my_bbdd_clave.php $_SESSION['clave'].
	$filenameb = "Inclu/my_bbdd_clave.php";
	$fw2b = fopen($filenameb, 'w+');
	$myclave = '<?php $_SESSION[\'clave\'] = "'.$_SESSION["clave"].'"; ?>';
	fwrite($fw2b, $myclave);
	fclose($fw2b);

	}	

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////
	
	function crear_tablas(){

	require 'Inclu/my_bbdd_clave.php';

	// CREA EL DIRECTORIO DE USUARIOS.

	global $data0;
	global $carpeta;
	$carpeta = "Users";
	if (!file_exists($carpeta)) {
		mkdir($carpeta, 0777, true);
		$data0 = "\t* OK DIRECTORIO USUARIOS.".PHP_EOL;
		}
	elseif (!file_exists($carpeta)){ print("* NO HA CREADO EL DIRECTORIO ".$carpeta.PHP_EOL);
									 $data0 = "\t* NO OK DIRECTORIO USUARIOS.".PHP_EOL;
									}
	if (file_exists($carpeta)) {
		copy("config/index.php", $carpeta."/index.php");
		$data0 = $data0."\t* OK SECURE INDEX.PHP".PHP_EOL;;
	} else {}

	global $carpetat;
	$carpetat = "Users/temp";
	if (!file_exists($carpetat)) {
		mkdir($carpetat, 0777, true);
		$data0 = $data0."\t* OK DIRECTORIO TEMP.".PHP_EOL;
		}
	elseif (!file_exists($carpeta)){ print("* NO HA CREADO EL DIRECTORIO ".$carpetat.PHP_EOL);
									 $data0 = $data0."\t* NO OK DIRECTORIO TEMP.".PHP_EOL;
									}
	if (file_exists($carpetat)) {
		copy("config/SecureIndex2.php", $carpetat."/index.php");
		$data0 = $data0."\t* OK SECURE INDEX.PHP".PHP_EOL;;
	} else {}

	global $db;	
	global $db_host;
	global $db_user;
	global $db_pass;
	global $db_name;
	global $dbconecterror;
	
	/************** CREAMOS LA TABLA ADMIN ***************/

	global $table_name_a;
	$table_name_a = "`".$_SESSION['clave']."admin`";

	$admin = "CREATE TABLE IF NOT EXISTS `$db_name`.$table_name_a (
  `id` int(4) NOT NULL auto_increment,
  `ref` varchar(20) collate utf8_spanish2_ci NOT NULL,
  `Nivel` varchar(8) collate utf8_spanish2_ci NOT NULL default 'amd',
  `Nombre` varchar(25) collate utf8_spanish2_ci NOT NULL,
  `Apellidos` varchar(25) collate utf8_spanish2_ci NOT NULL,
  `myimg` varchar(30) collate utf8_spanish2_ci NOT NULL default 'untitled.png',
  `doc` varchar(11) collate utf8_spanish2_ci NOT NULL,
  `dni` varchar(8) collate utf8_spanish2_ci NOT NULL,
  `ldni` varchar(1) collate utf8_spanish2_ci NOT NULL,
  `Email` varchar(50) collate utf8_spanish2_ci NOT NULL,
  `Usuario` varchar(10) collate utf8_spanish2_ci NOT NULL,
  `Password` varchar(100) collate utf8_spanish2_ci NOT NULL,
  `Pass` varchar(10) collate utf8_spanish2_ci NOT NULL,
  `Direccion` varchar(60) collate utf8_spanish2_ci NOT NULL,
  `Tlf1`varchar(9) NOT NULL default '0',
  `Tlf2`varchar(9) NOT NULL default '0',
  `lastin` varchar(20) collate utf8_spanish2_ci NOT NULL default '0',
  `lastout` varchar(20) collate utf8_spanish2_ci NOT NULL default '0',
  `visitadmin` varchar(4) collate utf8_spanish2_ci NOT NULL default '0',
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `ref` (`ref`),
  UNIQUE KEY `dni` (`dni`),
  UNIQUE KEY `Email` (`Email`),
  UNIQUE KEY `Usuario` (`Usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=1 ";
		
	if(mysqli_query($db , $admin)){
					global $table1;
					$table1 = "\t* OK TABLA ADMIN.".PHP_EOL;
				} else {
					global $table1;
					$table1 = "\t* NO OK TABLA ADMIN. ".mysqli_error($db).PHP_EOL;
					
					}

	/************* CREAMOS LA TABLA FEEDBACK ****************/

	global $table_name_f;
	$table_name_f = "`".$_SESSION['clave']."feedback`";

	$feedback = "CREATE TABLE IF NOT EXISTS `$db_name`.$table_name_f (
		`id` int(4) NOT NULL auto_increment,
		`ref` varchar(20) collate utf8_spanish2_ci NOT NULL,
		`Nivel` varchar(8) collate utf8_spanish2_ci NOT NULL default 'amd',
		`Nombre` varchar(25) collate utf8_spanish2_ci NOT NULL,
		`Apellidos` varchar(25) collate utf8_spanish2_ci NOT NULL,
		`myimg` varchar(30) collate utf8_spanish2_ci NOT NULL default 'untitled.png ',
		`doc` varchar(11) collate utf8_spanish2_ci NOT NULL,
		`dni` varchar(8) collate utf8_spanish2_ci NOT NULL,
		`ldni` varchar(1) collate utf8_spanish2_ci NOT NULL,
		`Email` varchar(50) collate utf8_spanish2_ci NOT NULL,
		`Usuario` varchar(10) collate utf8_spanish2_ci NOT NULL,
		`Password` varchar(100) collate utf8_spanish2_ci NOT NULL,
		`Pass` varchar(10) collate utf8_spanish2_ci NOT NULL,
		`Direccion` varchar(60) collate utf8_spanish2_ci NOT NULL,
		`Tlf1`varchar(9) NOT NULL default '0',
		`Tlf2`varchar(9) NOT NULL default '0',
		`lastin` varchar(20) collate utf8_spanish2_ci NOT NULL default '0',
		`lastout` varchar(20) collate utf8_spanish2_ci NOT NULL default '0',
		`visitadmin` varchar(4) collate utf8_spanish2_ci NOT NULL default '0',
		`borrado` varchar(22) collate utf8_spanish2_ci NOT NULL default '0',

		UNIQUE KEY `id` (`id`),
		UNIQUE KEY `ref` (`ref`),
		UNIQUE KEY `dni` (`dni`),
		UNIQUE KEY `Email` (`Email`),
		UNIQUE KEY `Usuario` (`Usuario`)
	  ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=1 ";
			  
		  if(mysqli_query($db, $feedback)){
											  
						  global $table5;
						  $table5 = "\t* OK TABLA FEEDBACK.".PHP_EOL;
						  
					  } else {
						  
						  global $table5;
						  $table5 = "\t* NO OK TABLA FEEDBACK. ".mysqli_error($db).PHP_EOL;
	  
						  }
					
	/************* CREAMOS LA TABLA IP CONTROL****************/

	global $table_name_b;
	$table_name_b = "`".$_SESSION['clave']."ipcontrol`";

	$ipcontrol = "CREATE TABLE IF NOT EXISTS `$db_name`.$table_name_b (
  `id` int(4) NOT NULL auto_increment,
  `ref` varchar(20) collate utf8_spanish2_ci NOT NULL default 'anonimo',
  `nivel` varchar(8) collate utf8_spanish2_ci NOT NULL default 'anonimo',
  `ipn` varchar(22) collate utf8_spanish2_ci NOT NULL default 'lost',
  `error`varchar(4) collate utf8_spanish2_ci NOT NULL default '1',
  `acceso` varchar(4) collate utf8_spanish2_ci NOT NULL default '0',
  `date` varchar(12) collate utf8_spanish2_ci NOT NULL default '0000/00/00',
  `time` varchar(10) collate utf8_spanish2_ci NOT NULL default '00:00:00',
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=1 ";
		
	if(mysqli_query($db, $ipcontrol)){
					global $table2;
					$table2 = "\t* OK TABLA IP CONTROL. \n";
				} else {
					global $table2;
					$table2 = "\t* NO OK TABLA IP CONTROL. ".mysqli_error($db)." \n";
					}
					
	/************* CREAMOS LA TABLA VISITAS ADMIN ****************/

	global $table_name_c;
	$table_name_c = "`".$_SESSION['clave']."visitasadmin`";

	$visitas = "CREATE TABLE IF NOT EXISTS `$db_name`.$table_name_c (
  `idv` int(2) NOT NULL,
  `visita` int(10) NOT NULL,
  `admin` int(10) NOT NULL,
  `deneg` int(10) NOT NULL,
  `acceso` int(10) NOT NULL,
  PRIMARY KEY  (`idv`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1";
		
	if(mysqli_query($db, $visitas)){
		global $link;
		print ("<table align='center'>
							".$link."
				</table>");		

		global $table3;
		$table3 = "\t* OK TABLA VISITAS ADMIN.".PHP_EOL;

	$vd = "INSERT INTO `$db_name`.$table_name_c (`idv`, `visita`, `admin`, `deneg`, `acceso`) VALUES
	(69, 0, 0, 0, 0)";
		if(mysqli_query($db, $vd)){
						global $table4;
						$table4 = "\t* OK INIT VALUES EN VISITAS ADMIN.".PHP_EOL;
		} else { global $table4;
				 $table4 = "\t* NO OK INIT VALUES EN VISITAS ADMIN. ".mysqli_error($db).PHP_EOL;
						}

	} else {global $table3;
			$table3 = "\t* NO OK TABLA VISITAS ADMIN. ".mysqli_error($db).PHP_EOL;
			global $table4;
			$table4 = "\t* NO OK INIT VALUES EN VISITAS ADMIN. ".mysqli_error($db).PHP_EOL;
			}

	/************	PASAMOS LOS PARAMETROS A .LOG	*****************/
	
		global $data0;
		global $cfone;
		$datein = date('Y-m-d/H:i:s');

		$logdate = date('Y_m_d');
		$logtext = $cfone.PHP_EOL;
		$logtext = $logtext.PHP_EOL."- CONFIG INIT ".$datein;
		$logtext = $logtext.PHP_EOL." * ".$db_name;
		$logtext = $logtext.PHP_EOL." * ".$db_host;
		$logtext = $logtext.PHP_EOL." * ".$db_user;
		$logtext = $logtext.PHP_EOL." * ".$db_pass;
		$logtext = $logtext.PHP_EOL.$dbconecterror;
		$logtext = $logtext.PHP_EOL.$data0.$table1.$table2.$table3.$table4.$table5.PHP_EOL;

		$filename = "config/logs/".$logdate."_CONFIG_INIT.log";
		$log = fopen($filename, 'ab+');
		fwrite($log, $logtext);
		fclose($log);

	}	

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function modif(){
									   							
	$filename = "config/ayear.php";
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

function modif2(){

	$filename = "config/year.txt";
	$fw2 = fopen($filename, 'w+');
	$date = "".date('Y')."";
	fwrite($fw2, $date);
	fclose($fw2);
}

function ayear(){
	$filename = "config/year.txt";
	$fw2 = fopen($filename, 'r+');
	$fget = fgets($fw2);
	fclose($fw2);
	
	if($fget == date('Y')){}
	elseif($fget != date('Y')){ 	modif();
									modif2();
		}

}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function show_form($errors=[]){
	
	/* Se pasan los valores por defecto y se devuelven los que ha escrito el usuario. */
	
	if(isset($_POST['config'])){
		$defaults = $_POST;
		} else {$defaults = array ( 'host' => '',
									'user' => '',
									'pass' => '',
									'name' => '',
									'clave' => '',);
								   }
	
	if ($errors){
		print("	<table align='center'>
					<tr>
						<th style='text-align:center'>
							<font color='#FF0000'>* SOLUCIONE ESTOS ERRORES:</font><br/>
						</th>
					</tr>
					<tr>
						<td style='text-align:left'>");
		
		for($a=0; $c=count($errors), $a<$c; $a++){
			print("<font color='#FF0000'>**</font>  ".$errors [$a]."<br/>");
			}
		print("</td>
				</tr>
				</table>");
					}
					
	global $link;
	if($_SESSION['inst'] == "inst"){ print ("<table align='center'>
														".$link."
											</table>");		
	}else{
	print("<table align='center' style=\"margin-top:10px\">
					<tr>
					<td style='color:red' align='center'>
					INTRODUZCA LOS DATOS DE CONEXI&Oacute;N A LA BBDD.
							</br>
			SE CREAR&Aacute; EL ARCHIVO DE CONEXI&Oacute;N Y LAS TABLAS DE CONFIGURACI&Oacute;N.
					</td>
				</tr>
			</table>
			
			<table align='center' style=\"margin-top:10px\">
				<tr>
					<th colspan=2 class='BorderInf'>
							INIT CONFIG DATA
					</th>
				</tr>
				
	<form name='form_datos' method='post' action='$_SERVER[PHP_SELF]'>
						
				<tr>
					<td width=200px>	
						<font color='#FF0000'>*</font>
						DB HOST ADRESS
					</td>
					<td width=200px>
		<input type='text' name='host' size=25 maxlength=25 value='".$defaults['host']."' />
					</td>
				</tr>
					
				<tr>
					<td width=200px>	
						<font color='#FF0000'>*</font>
						DB USER NAME
					</td>
					<td width=200px>
		<input type='text' name='user' size=25 maxlength=25 value='".$defaults['user']."' />
					</td>
				</tr>
					
				<tr>
					<td width=200px>	
						<font color='#FF0000'>*</font>
						DB PASSWORD
					</td>
					<td width=200px>
		<input type='text' name='pass' size=25 maxlength=25 value='".$defaults['pass']."' />
					</td>
				</tr>
				
				<tr>
					<td width=200px>	
						<font color='#FF0000'>*</font>
						DB NAME
					</td>
					<td width=200px>
		<input type='text' name='name' size=25 maxlength=25 value='".$defaults['name']."' />
					</td>
				</tr>
					
				<tr>
					<td width=200px>	
						<font color='#FF0000'>*</font>
						TABLES SYSTEM CLAVE
					</td>
					<td width=200px>
		<input type='text' name='clave' size=25 maxlength=3 value='".$defaults['clave']."' />
					</td>
				</tr>
					
				<tr>
					<td align='right' valign='middle'  class='BorderSup' colspan='2'>
						<input type='submit' value='INIT CONFIG' />
						<input type='hidden' name='config' value=1 />
						
					</td>
				</tr>
		</form>														
			</table>"); 
		} // FIN PRINT TABLE
	
	} // FIN FUNCTION SHOW_FOMR	

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	require 'Inclu/Admin_Inclu_footer.php';

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

/* Creado por Juan Barros Pazos 2020 */
?>