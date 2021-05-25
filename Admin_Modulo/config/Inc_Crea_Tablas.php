<?php

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


?>