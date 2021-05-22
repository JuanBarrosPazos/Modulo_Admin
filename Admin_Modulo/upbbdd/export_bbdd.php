<?php

	global $db;
	global $db_name;
	global $valor;
	$valor = strtolower($_POST['tabla']);
	global $valort;
	$valort = "`".$valor."`";
	global $datein;
	$datein = date('Y.m.d_H.i.s');
//	$datein = date('Y.m.d');
	
//	print("* EXPORTADA TABLA: ".strtoupper($db_name." => ".$valor).".");

	global $id;
	global $campo;
	global $texc;
	global $c3;
	global $c4;
	global $numr;
				
				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

		/* TABLAS DE LOS USUARIOS */

		global $tcuf;
		$tcuf = trim($_POST['tabla']);
		$ctuf = strtolower($tcuf);
		global $tcufs;
		$tcufs = trim($_SESSION['tablas']);
		$tcufs = strtolower($tcufs);

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

// EXPORTA LA TABLA ADMIN DEL SISTEMA //

if (trim($_POST['tabla']) == $_SESSION['clave']."admin" ){
$campo = 'id,ref,Nivel,Nombre,Apellidos,myimg,doc,dni,ldni,Email,Usuario,Password,Pass,Direccion,Tlf1,Tlf2,lastin,lastout,visitadmin';
$texc = '`id`, `ref`, `Nivel`, `Nombre`, `Apellidos`, `myimg`, `doc`, `dni`, `ldni`, `Email`, `Usuario`, `Password`, `Pass`, `Direccion`, `Tlf1`, `Tlf2`, `lastin`, `lastout`, `visitadmin`';
		$id = "`id`";
$c3 = "\n\t`id` int(4) NOT NULL auto_increment,
\t`ref` varchar(20) collate utf8_spanish2_ci NOT NULL,
\t`Nivel` varchar(8) collate utf8_spanish2_ci NOT NULL default 'amd',
\t`Nombre` varchar(25) collate utf8_spanish2_ci NOT NULL,
\t`Apellidos` varchar(25) collate utf8_spanish2_ci NOT NULL,
\t`myimg` varchar(30) collate utf8_spanish2_ci NOT NULL default 'untitled.png ',
\t`doc` varchar(11) collate utf8_spanish2_ci NOT NULL,
\t`dni` varchar(8) collate utf8_spanish2_ci NOT NULL,
\t`ldni` varchar(1) collate utf8_spanish2_ci NOT NULL,
\t`Email` varchar(50) collate utf8_spanish2_ci NOT NULL,
\t`Usuario` varchar(10) collate utf8_spanish2_ci NOT NULL,
\t`Password` varchar(100) collate utf8_spanish2_ci NOT NULL,
\t`Pass` varchar(10) collate utf8_spanish2_ci NOT NULL,
\t`Direccion` varchar(60) collate utf8_spanish2_ci NOT NULL,
\t`Tlf1`varchar(9) NOT NULL default '0',
\t`Tlf2`varchar(9) NOT NULL default '0',
\t`lastin` varchar(20) collate utf8_spanish2_ci NOT NULL default '0',
\t`lastout` varchar(20) collate utf8_spanish2_ci NOT NULL default '0',
\t`visitadmin` varchar(4) collate utf8_spanish2_ci NOT NULL default '0',
\tUNIQUE KEY `id` (`id`),
\tUNIQUE KEY `ref` (`ref`),
\tUNIQUE KEY `dni` (`dni`),
\tUNIQUE KEY `Email` (`Email`),
\tUNIQUE KEY `Usuario` (`Usuario`)";
	$sqlc =  "SELECT * FROM $valort ORDER BY $id ASC";
	$qc = mysqli_query($db, $sqlc);
			while($rowc = mysqli_fetch_row($qc)){
				global $numr;
				$numr = ($rowc[0]+1);}
$c4 = "\nENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=".$numr;
		 		}	
				
				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

// EXPORTA LA TABLA VISITAS ADMIN DEL SISTEMA //

elseif (trim($_POST['tabla']) == $_SESSION['clave']."visitasadmin" ){
$campo = 'idv,visita,admin,deneg,acceso';
$texc = '`idv`, `visita`, `admin`, `deneg`, `acceso`';
		$id = "`idv`";
$c3 = "\n\t`id` int(4) NOT NULL auto_increment,
\t`idv` int(2) NOT NULL,
\t`visita` int(10) NOT NULL,
\t`admin` int(10) NOT NULL,
\t`deneg` int(10) NOT NULL,
\t`acceso` int(10) NOT NULL,
\t  PRIMARY KEY  (`idv`)";
	$sqlc =  "SELECT * FROM $valort ORDER BY $id ASC";
	$qc = mysqli_query($db, $sqlc);
			while($rowc = mysqli_fetch_row($qc)){
				global $numr;
				$numr = ($rowc[0]+1);}
$c4 = "ENGINE=InnoDB DEFAULT CHARSET=latin1".$numr;
		 		}	
				
				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

// EXPORTA LA TABLA CONTROL USUARIO //

else{
$campo = 'id,ref,Nombre,Apellidos,din,tin,dout,tout,ttot';
$texc = '`id`, `ref`, `Nombre`, `Apellidos`, `din`, `tin`, `dout`, `tout`, `ttot`';
		$id = "`id`";
$c3 = "\n\t  `id` int(4) NOT NULL auto_increment,
\t`ref` varchar(20) collate utf8_spanish2_ci NOT NULL,
\t`Nombre` varchar(25) collate utf8_spanish2_ci NOT NULL,
\t`Apellidos` varchar(25) collate utf8_spanish2_ci NOT NULL,
\t`din` varchar(10) collate utf8_spanish2_ci NOT NULL,
\t`tin` time NOT NULL,
\t`dout` varchar(10) collate utf8_spanish2_ci NULL,
\t`tout` time NULL,
\t`ttot` time NULL,
\tPRIMARY KEY  (`id`),
\tUNIQUE KEY `id` (`id`)";
	$sqlc =  "SELECT * FROM $valort ORDER BY $id ASC";
	$qc = mysqli_query($db, $sqlc);
			while($rowc = mysqli_fetch_row($qc)){
				global $numr;
				$numr = ($rowc[0]+1);}
$c4 = "\nENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=".$numr;
				 }	
				 
				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

global $filename;
$filename = "bbdd/TBL_".$valor."_DT_".$datein.".sql";

	global $sqlb;
	global $qb;
	$sqlb =  "SELECT * FROM $valort ORDER BY $id ASC";
	$qb = mysqli_query($db, $sqlb);
	global $numr;
	global $nentradas;
	$nentradas = mysqli_num_rows($qb);
	global $nrw;
	$nrw = mysqli_num_rows($qb);
	//$_SESSION['numr'] = $numr;
		if(!$qb){
	print("<font color='#FF0000'>214 Se ha producido un error: </form><br/>".mysqli_error($db)."<br/>");
			
		} else {
			if(mysqli_num_rows($qb)== 0){
						print("
			<table align='center' style='border:1; margin-top:2px' width='auto'>
				
				<tr>
					<td align='center'>
							NO HAY DATOS EN ESTA TABLA.
					</td>
				</tr>
				</table>");	

				} else { 
			
			$campos = explode(',',$campo);
			$count = count($campos);
				
			print ("<table align='center' width='auto'>
						<tr>
							<th colspan=".$count." class='BorderInf'>
				UPDATE OK. || BBDD: ".strtoupper($db_name)." || TABLA: ".strtoupper($valor)."
							</th>
						</tr>
						<tr>");
						
				print("<td>* Nº Campos:".$count.".<br/>||  ");
				for($a=0; $c=$count, $a<$c; $a++){
				print($campos[$a]." || ");
					}
				print("<br/>* Nº Entradas: ".$nentradas." &nbsp; * Nº Id. Max: ".($numr-1)."
				<br/>* Ruta Documento: ".$filename."</td>");
									
			for($a=0; $c=$count, $a<$c; $a++){
				//print(	"<td class='BorderInfDch'>".$campos[$a]."</td>");
					}
				print("</tr>");
									
//$_SESSION['ruta'] = $filename;
$fh = fopen($filename,'w+');
$c1 ='SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";';
$c2 ='SET time_zone = "+00:00";';
$linec = "\n-- Servidor: ".$_SERVER['SERVER_NAME'].
"\n-- Tiempo de generación: ".date('Y/m/d')." a las ".date('H:i:s').
"\n-- Versión del servidor: ".$_SERVER['SERVER_SOFTWARE'].
"\n\n".$c1."\n".$c2."\n
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
\n--\n-- Base de datos: `".$db_name."`\n--
\n-- --------------------------------------------------------
\n--\n-- Estructura de tabla para la tabla `".$valor."`\n--\n
CREATE TABLE IF NOT EXISTS `".$valor."` (".$c3."}".$c4.";
\n--\n-- Volcado de datos para la tabla `".$valor."`\n--\n";
		$line0 = "\nINSERT INTO `".$valor."` (";
		$line1 = ") VALUES";
		$line = $linec.$line0.$texc.$line1;
fwrite($fh, $line);
fclose($fh);

			while($rowb = mysqli_fetch_row($qb)){
				//$_SESSION['numr'] = ($rowb[0]+1);
$fh = fopen($filename,'ab+');
		$line0 = "\n(";
fwrite($fh, $line0);
fclose($fh);
				//print (	"<tr align='center'>");
					for($i=0; $c=$count, $i<$c; $i++){
				//	print(	"<td class='BorderInfDch'>".$rowb[$i]."</td>");
$fh = fopen($filename,'ab+');
		$line2 = "'".$rowb[$i]."', ";
fwrite($fh, $line2);
fclose($fh);
						 }
$fh = fopen($filename,'ab+');
		$line3 = "),";
fwrite($fh, $line3);
fclose($fh);
						//print("	</tr>")
						;}
						 
$fh = fopen($filename,'ab+');
		$line3 = ";\n
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;";
fwrite($fh, $line3);
fclose($fh);
				} 
					print("</table>");
			} 

if($nrw == 0){}
else{
$line = file_get_contents($filename);
$line = str_replace(', ),','),',$line);
$line = str_replace('),;',');',$line);

$fh = fopen($filename,'w+');
fwrite($fh, $line);
@$tot[$d] = @$data[$d];
fclose($fh);
//print($_SESSION['numr']);

	}
	
				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////
		
/* Creado por Juan Barros Pazos 2021 */
?>