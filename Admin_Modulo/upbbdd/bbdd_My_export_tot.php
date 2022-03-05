<?php

	require '../Inclu/error_hidden.php';
	require '../Conections/conection.php';
	require '../Conections/conect.php';
	require '../Inclu/my_bbdd_clave.php';

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

    set_time_limit(3000);
    $tablas_respaldo = [];
    //$db = new mysqli($db_host, $db_user, $db_pass, $db_name);
    //$db->select_db($db_name);
    $db->query("SET NAMES 'utf8'");
    $tablas = $db->query('SHOW TABLES');
    while ($fila = $tablas->fetch_row()) {
        $tablas_respaldo[] = $fila[0];
    }
    $contenido = "SET SQL_MODE = \"NO_AUTO_VALUE_ON_ZERO\";\r\nSET time_zone = \"+00:00\";\r\n\r\n/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;\r\n/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;\r\n/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;\r\n/*!40101 SET NAMES utf8 */;\r\n--\r\n-- Database: `" . $db_name . "`\r\n--\r\n\r\n";
    foreach ($tablas_respaldo as $db_name_table) {
        if (empty($db_name_table)) {
            continue;
        }
        $db_data_table = $db->query('SELECT * FROM `'.$db_name_table.'`');
        $numero_campos = $db_data_table->field_count;
        $numero_filas = $db->affected_rows;
        $esquemaDeTabla = $db->query('SHOW CREATE TABLE `'.$db_name_table.'`');
        $filatabla = $esquemaDeTabla->fetch_row();
        $contenido .= "\n\n" . $filatabla[1] . ";\n\n";
        for ($i = 0, $contador = 0; $i < $numero_campos; $i++, $contador = 0) {
            while ($fila = $db_data_table->fetch_row()) {
                //La primera y cada 100 veces
                if ($contador % 100 == 0 || $contador == 0) {
                    $contenido .= "\nINSERT INTO " . $db_name_table . " VALUES";
                }
                $contenido .= "\n(";
                for ($j = 0; $j < $numero_campos; $j++) {
                    $fila[$j] = str_replace("\n", "\n", addslashes($fila[$j]));
                    if (isset($fila[$j])) {
                        $contenido .= '"' . $fila[$j] . '"';
                    } else {
                        $contenido .= '""';
                    }
                    if ($j < ($numero_campos - 1)) {
                        $contenido .= ',';
                    }
                }
                $contenido .= ")";
                # Cada 100...
                if ((($contador + 1) % 100 == 0 && $contador != 0) || $contador + 1 == $numero_filas) {
                    $contenido .= ";";
                } else {
                    $contenido .= ",";
                }
                $contador = $contador + 1;
            }
        }
        $contenido .= "\n";
    }
    $contenido .= "\r\n/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;\r\n/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;\r\n/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;";
    # Se guardará dependiendo del directorio, en una carpeta llamada respaldos
    $carpeta = "bbdd_export_tot";
    if (!file_exists($carpeta)) {
        mkdir($carpeta);
    }else{}
    # Calcular un ID único
    //$id = uniqid();
    # También la fecha
    $fecha = date("Y-m-d");
    global $datebbddx;
	$datebbddx = date("Ymd_His");
    # Crear un archivo que tendrá un nombre como respaldo_2018-10-22_asd123.sql
    //$file_name = sprintf('%s/respaldo_%s_%s.sql', $carpeta, $fecha, $id);
    $file_name = $carpeta."/".$db_name.'_'.$datebbddx.'.sql';
    #Escribir todo el contenido. Si todo va bien, file_put_contents NO devuelve FALSE
    return file_put_contents($file_name, $contenido) !== false;
		
				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

/* Creado por Juan Barros Pazos 2021 */
?>