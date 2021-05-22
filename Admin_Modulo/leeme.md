
# MÓDULO CRUD DE ADMINISTRADORES Y USUARIOS.
# Admin_Modulo_V20Beta_Ok_Botones_Paginacion_&_Hash

- bbdd usuarios:
- http://localhost/Admin_Modulo/upbbdd/bbdd.php
- bbdd total:
- http://localhost/Admin_Modulo/upbbdd/export_bbdd_backups.php
- System log:
- http://localhost/Admin_Modulo/upbbdd/export_log.php
-
- Qrgen:
- http://localhost/Admin_Modulo/qrgen/indexqrg.php
- Qr Scanner:
- http://localhost/Admin_Modulo/cam/indexcam.php

## DESCRIPCION GENERAL:
- Creación automática de las tablas necesarias en la bbdd
- CRUD de usuarios y administradores.
- Baja de usuarios activos y almacenamiento en Feedbak Admin.
- Recuperación de usuarios desde Feedback Admin a Admin.
- Eliminación de usuarios y datos desde Feedback Admin.
- Log de sistema y de actividad de los usuarios individuales.
- 
- Exportación y eliminación de bbdd de usuarios.
- Exportación de bbdd completa.
- Exportación y eliminación de log de usuarios.
- 
- Generador de qr code usuarios.
- Lector de qr code de usuarios.
---
---
- Integro la función de copia de seguridad automática después de suma_visit(); en index_Play_System.php que pasa a ser index.php en el momento de la instalación.

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function bbdd_backup(){
	
	global $db;
	global $db_name;
	
	global $dated;
	$dated = date('d');
	global $datem;
	$datem = date('m');
	global $datey;
	$datey = date('Y');
	global $datebbddx;
	$datebbddx = date("Ymd");
	
	// SI HAY MAS DE OCHO COPIAS DE SEGURIDAD BORRARLAS.
	global $ruta;
	$ruta ="upbbdd/bbdd_export_tot";
	//print("RUTA: ".$ruta.".</br>");
	global $rutag;
	$rutag = "upbbdd/bbdd_export_tot/{*}";
	//print("RUTA G: ".$rutag.".</br>");
	$directorio = opendir($ruta);
	global $num;
	$num=count(glob($rutag,GLOB_BRACE));
	
	if($num > 8){	if(file_exists($ruta)){ $dir = $ruta."/";
			$handle = opendir($dir);
			// Si el mes es distinto a Febrero y el dia 12
		   if(($datem != 2)&&($dated == 12)){
					$name0 = $db_name.'_'.($datebbddx-6).'.sql';
					$name1 = $db_name.'_'.($datey.($datem-1).'30').'.sql';
		   			}
		   // Si el mes es igual a Febrero y el día 12
		   elseif(($datem == 2)&&($dated == 12)){
					$name0 = $db_name.'_'.($datebbddx-6).'.sql';
					$name1 = $db_name.'_'.($datey.($datem-1).'24').'.sql';
		   			}
		   // Si el mes es distinto a Febrero y el día 6
		   if(($datem != 2)&&($dated == 6)){
					$name0 = $db_name.'_'.($datey.($datem-1).'30').'.sql';
					$name1 = $db_name.'_'.($datey.($datem-1).'24').'.sql';
			   			}
		   // Si el mes es igual a Febrero y el día 6
			   elseif(($datem == 2)&&($dated == 6)){
						$name0 = $db_name.'_'.($datey.($datem-1).'24').'.sql';
						$name1 = $db_name.'_'.($datey.($datem-1).'18').'.sql';
			   			}
		   	  else{	$name0 = $db_name.'_'.($datebbddx-6).'.sql';
					$name1 = $db_name.'_'.($datebbddx-12).'.sql';
		   			}
							   
			if(file_exists($dir.$name0)){copy($dir.$name0, "upbbdd/temp/".$name0);}else{}
			if(file_exists($dir.$name1)){copy($dir.$name1, "upbbdd/temp/".$name1);}else{}
			// Borra los archivos temporales
			while ($file = readdir($handle)){if (is_file($dir.$file)) {unlink($dir.$file);}}
				} else { }
				if(file_exists("upbbdd/temp/".$name0)){rename("upbbdd/temp/".$name0, $dir.$name0);}else{}
				if(file_exists("upbbdd/temp/".$name1)){rename("upbbdd/temp/".$name1, $dir.$name1);}else{}
				}

					//////////////////			//////////////////
	
	// SI EXISTE EL RESPALDO CORRESPONDIENTE A HOY NO HACER NADA.
	if(file_exists('upbbdd/bbdd_export_tot/'.$db_name.'_'.$datebbddx.'.sql')){ }

	// DE LO CONTRARIO HACER EL RESPALDO.
	elseif(!file_exists('upbbdd/bbdd_export_tot/'.$db_name.'_'.$datebbddx.'.sql')){
		if(($dated == "6") || ($dated == "12") || ($dated == "18") || ($dated == "24") || ($dated == "30")){ 
			require 'upbbdd/bbdd_export_tot.php';
			} else { }
	} // Fin del condicional que realiza el respaldo
	
} // Fin function respado automatico bbdd.

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////
---
---
## 2021/05/22
### Admin_Modulo_V20Beta_Ok_Botones_Paginacion_&_Hash.zip
- Nuevas integraciones bbdd & log.
- Ajustes generales de código.

---
---
## 2021/05/21
### Admin_Modulo_V19_Ok_Botones_Paginacion_&_Hash.zip
- Configuración del menu usuario.
- Ajustes generales de código.
---
---
## 2021/05/10
### Admin_Modulo_V12_Ok_Paginacion_&_Hash.zip
- Configuración de la paginacion en Admin y Feedback.
- Ajustes generales de código.
---
---
## 2021/05/09
### Admin_Modulo_V11_Paginacion_&_Hash.zip
- Configuración de la paginacion en Admin y Feedback.
- Ajustes generales de código.
---
---
## 2021/05/06
### Admin_Modulo_V10_Paginacion_&_Hash.zip
- Configuración inicial de l apaginación en consultas.
- Modificación del inicio al abrir sesión.
---
---
## 2021/05/05
### Admin_Modulo_V09_Con_password_hash.zip
- Ajustes generales de codigo para gestión de administradores y log de actividad.
---
---
## 2021/05/04
### Admin_Modulo_V07_Ok_Sin_password_hash.zip
### Admin_Modulo_V08_Con_password_hash.zip
- Se modifica la tabla de usuarios en relación la la version anterior Password varchar 100.
- Se aplica password_hash() al Password del usuario.
- Se modifica el sistema de validación de Password del usuario para adaptarlo a password_verify()
- Se modifican la variables superglobales.
---
---

