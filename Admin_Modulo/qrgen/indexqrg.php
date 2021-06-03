<?php    
	session_start();

	//require '../Inclu/error_hidden.php';
	require '../Inclu/Admin_head.php';
	require '../Inclu/mydni.php';
	require '../Inclu/nemp.php';

	require '../Conections/conection.php';
	require '../Conections/conect.php';
	require '../Inclu/my_bbdd_clave.php';

	require '../Inclu_Menu/rutaqrgen.php';
	require '../Inclu_Menu/Master_Index.php';

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////
	
	global $num;
	$num = count(glob("temp/{*}",GLOB_BRACE));
	if($num > 1){ deletemp(); } else { }

	global $num2;
	$num2 = count(glob("qrimg/{*}",GLOB_BRACE));
	if($num2 >= ($_SESSION['nuser']*2+6)){ deleqrimg(); } else { }
	//print($_SESSION['nuser']);

	if(isset($_POST['oculto'])){
		if($form_errors = validate_form()){ qrsize();
											show_form($form_errors);
											listfiles();
						} else {qrsize();
								process_form();
								qrimg();
								show_form();
								listfiles();
									}
							}

	elseif(isset($_POST['delete'])){ qrsize();
									 show_form();
									 delete(); 
									 listfiles();
								}

	elseif(isset($_POST['downl'])){qrsize();
							//qrimg();
							show_form();
							red();
							listfiles();
								}

	else {	qrsize();
			//qrimg();
			show_form();
			listfiles();	
				}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function qrsize(){

	if (isset($_REQUEST['level']) && (in_array($_REQUEST['level'], array('L','M','Q','H')))){
		global $errorCorrectionLevel;
        $errorCorrectionLevel = $_REQUEST['level'];    
	}else{	global $errorCorrectionLevel;
			$errorCorrectionLevel = 'Q';
			}

    if (isset($_REQUEST['size'])){
		global $matrixPointSize;
        $matrixPointSize = min(max((int)$_REQUEST['size'], 1), 10);
			}

	else{	global $matrixPointSize;
    		$matrixPointSize = 6;
			}
}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

	function red(){
		global $a;
		$a = 1;
		global $redir;
		$redir = "<script type='text/javascript'>
					function redir(){
					window.open ('".$_POST['ruta']."', '_blank') ;
					}
			setTimeout('redir()',500);
				  </script>";
			print ($redir);
				
	}
				
				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function process_form(){

    //set it to writable location, a place for temp generated PNG files
    $PNG_TEMP_DIR = dirname(__FILE__).DIRECTORY_SEPARATOR.'temp'.DIRECTORY_SEPARATOR;
    
	//html PNG location prefix
	global $PNG_WEB_DIR;
    $PNG_WEB_DIR = 'temp/';

	include "phpqrcode.php";    
    
    //ofcourse we need rights to create temp dir
    if (!file_exists($PNG_TEMP_DIR))
        mkdir($PNG_TEMP_DIR);
	
	global $filename;
    $filename = $PNG_TEMP_DIR.'test.png';
    
    //processing form input
	//remember to sanitize user input in real-life solution !!!

	global $errorCorrectionLevel;
	global $matrixPointSize;

    if ((isset($_REQUEST['metodo']))&&(isset($_REQUEST['usercod']))) { 
		if ($_REQUEST['metodo'] == 'index.php?pin=' ){ 
			global $metodo;
			$metodo = 'CONFIRM_';
		}else{
			global $metodo;
			$metodo = 'AUTO_';
		}
		global $data;
		$data = $_REQUEST['metodo'].$_REQUEST['usercod'];
		//print ($data);
        //it's very important!
        if (trim($data) == '')
            die('data cannot be empty! <a href="?">back</a>');
            
        // user data
    $filename = $PNG_TEMP_DIR.'test'.md5($data.'|'.$errorCorrectionLevel.'|'.$matrixPointSize).'.png';
    QRcode::png($data, $filename, $errorCorrectionLevel, $matrixPointSize, 2); 
	//print("<br>".$filename."<br>".$metodo.$_REQUEST['usercod']);

	if(strlen(trim($_POST['imgname'])) == 0){
		global $imgname;
		global $metodo;
		$imgname = $metodo.$_REQUEST['usercod'];
		if(file_exists("qrimg/".$imgname.".png")){unlink("qrimg/".$imgname.".png");}else{}
		if(file_exists($filename)){copy($filename, "qrimg/".$imgname.".png");}else{}
		}
	else{ global $imgname;
		  $imgname = str_replace(' ', '_',$_POST['imgname']);
		  global $data;
		  if(file_exists("qrimg/".$imgname.".png")){unlink("qrimg/".$imgname.".png");}else{}
		  if(file_exists($filename)){copy($filename, "qrimg/".$imgname.".png");}else{}
			}
 
    } else {    
    
        //default data
   /*
   echo 'You can provide data in GET parameter: <a href="?data=like_that">like that</a>'; 
   */   
        QRcode::png('PHP QR Code :)', $filename, $errorCorrectionLevel, $matrixPointSize, 2); 
     
    	}    

}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function validate_form(){
	
	$errors = array();

	if(strlen(trim($_POST['metodo'])) == 0){
		$errors [] = "METODO: <font color='#FF0000'> es obligatorio.</font>";
		}

	if(strlen(trim($_POST['usercod'])) == 0){
		$errors [] = "USUARIO: <font color='#FF0000'> es obligatorio.</font>";
		}

	return $errors;

} 

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function qrimg(){
	global $PNG_WEB_DIR;
	global $filename;
	//display generated file
	print("	<div style='text-align: center'>
				<img src='".$PNG_WEB_DIR.basename($filename)."' />
			</div>");  
}  

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

function Show_form($errors=[]){	

	if (isset($_POST['downl'])){
		print("<embed src='../audi/file_exp_ok.mp3' autostart='true' loop='false' width='0' height='0' hidden='true' ></embed>");
			}

	global $errorCorrectionLevel;
	global $matrixPointSize;

	if(isset($_POST['oculto'])){ $defaults = $_POST;

	} else {$defaults = array ( 
			'metodo' => isset($_REQUEST['metodo']),
			'usercod' => isset($_REQUEST['usercod']),
			'imgname' => isset($_REQUEST['imgname']),
						);
			}

	if ($errors){
		global $a;
		$a = 1;
		print("	<table align='center'>
					<tr>
						<th style='text-align:center>
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
	<embed src='../audi/error_form.mp3' autostart='true' loop='false' width='0' height='0' hidden='true' >
	</embed>
					</table>");
	}else{	global $a;
			$a = 0;
			}

	$metodo = array (	'' => 'SELECCIONE EL METODO',
						/*
						'index.php?pin=' => 'METODO CONFIRM',
						*/
						'indexqr.php?pin=' => 'METODO AUTO',
						'ejemplo1.php?pin=' => 'METODO EJEMPLO 1',
						'ejemplo2.php?pin=' => 'METODO EJEMPLO 2',
						'ejemplo3.php?pin=' => 'METODO EJEMPLO 3',);														

print("<div style='text-align: center'>

		<table align='center' style=\"border:0px;margin_bottom:6px;margin-top:10px\">
			<form action='$_SERVER[PHP_SELF]' method='post'>
		<tr>
			<td colspan='2' align='center' class='BorderSup'>
       			METODO EN QUE EL QR ACTUA
	   		</td>
		</tr>
		<tr>
			<td colspan='2' align='center' class='BorderInf'>
			<select name='metodo'>");
		foreach($metodo as $option => $label){
				print ("<option value='".$option."' ");
				if($option == $defaults['metodo']){	print ("selected = 'selected'");}
													print ("> $label </option>");
											}	
					
print ("</select>
			</td>
		</tr>
		<tr>
			<td style='text-align:right !important;'>
       			QR FOR USER:
	   		</td>
			<td style='text-align:left !important;'>

			<select name='usercod'>
			<option value=''>SELECCIONE UN USUARIO</option><!-- --> ");

global $db;
global $tablau;
$tablau = $_SESSION['clave']."admin";
$tablau = "`".$tablau."`";

$sqlu =  "SELECT * FROM $tablau ORDER BY `ref` ASC ";
$qu = mysqli_query($db, $sqlu);
if(!$qu){
		print("Modifique la entrada L.148 ".mysqli_error($db)."<br/>");
} else {
			
	while($rowu = mysqli_fetch_assoc($qu)){
				
				print ("<option value='".$rowu['dni']."' ");
				
				if($rowu['dni'] == $defaults['usercod']){
									print ("selected = 'selected'");
																	}
					print ("> ".$rowu['Nombre']." ".$rowu['Apellidos']." </option>");
		}
}  

print ("</select>
			</td>
		</tr>
		<tr>
			<td colspan='2' class='BorderSup'>
       			CALIDAD Y DEFINICION DEL QR
	   		</td>
		</tr>
		<tr>
			<td style='text-align:right !important;'>
		ECC:
			</td>
			<td style='text-align:left !important;'>");
	
	echo '<select name="level">
			<option value="L"'.(($errorCorrectionLevel=='L')?' selected':'').'>L - smallest</option>
			<option value="M"'.(($errorCorrectionLevel=='M')?' selected':'').'>M</option>
			<option value="Q"'.(($errorCorrectionLevel=='Q')?' selected':'').'>Q</option>
			<option value="H"'.(($errorCorrectionLevel=='H')?' selected':'').'>H - best</option>
		  </select>';

	print("<td>
		</tr>
		<tr>
			<td style='text-align:right !important;' class='BorderInf'>
        SIZE:
			</td>
			<td style='text-align:left !important;' class='BorderInf'>
			<select name='size'>");

	for($i=1;$i<=10;$i++){

		echo '<option value="'.$i.'"'.(($matrixPointSize==$i)?' selected':'').'>'.$i.'</option>';

		}

	print ("</select>
				</td>
			</tr>
			<tr>

			<td style='text-align:right !important;' class='BorderInf'>
				NAME FOR IMAGE:
			</td>
			<td style='text-align:left !important;' class='BorderInf'>
				<input name='imgname' size=32 maxlength=14 value='".$defaults['imgname']."' placeholder='OPCIONAL' />
			</td>
		</tr>
		<tr>
			<td colspan=2 class='BorderInf'>
					<input type='submit' value='GENERATE QR CODE FOR USER' class='botonverde' />
					<input type='hidden' name='oculto' value=1 />
				</form>
			</td>
		</tr>
		</table>
	</div>");

}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////
	
	function deletemp(){

	global $ruta;
	$ruta = "temp/";
	if(file_exists($ruta)){  $dir = $ruta."/";
							 $handle = opendir($dir);
					while ($file = readdir($handle))
						 {if (is_file($dir.$file)){unlink($dir.$file);}
							}
						} else { }
	}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////
	
	function deleqrimg(){

	global $ruta;
	$ruta = "qrimg/";
	if(file_exists($ruta)){  $dir = $ruta."/";
							 $handle = opendir($dir);
			  while ($file = readdir($handle)){if (is_file($dir.$file))
												 {unlink($dir.$file);}
											 	}
							} else { }
			}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////
	
function listfiles(){
	
	global $num3;
	$num3=count(glob("qrimg/{*}",GLOB_BRACE));

	global $ruta;
	$ruta ="qrimg/";
	//print("RUTA: ".$ruta.".</br>");
	
	global $rutag;
	$rutag = "qrimg/{*}";
	//print("RUTA G: ".$rutag.".</br>");
		
	$directorio = opendir($ruta);
	global $num;
	$num=count(glob($rutag,GLOB_BRACE));

	global $a;

	if($num < 1){
		
	if ($a == 0){
		print("<embed src='../audi/no_file.mp3' autostart='true' loop='false' width='0' height='0' hidden='true' ></embed>");
					}
		
		print ("<table align='center' style='border:1; margin-top:2px' width='auto'>
					<tr>
						<td align='center'>NO HAY ARCHIVOS PARA DESCARGAR</td>
					</tr>
				</table>");
	}else{
		
	if ($a == 0) {
		print("<embed src='../audi/files_for_exp.mp3' autostart='true' loop='false' width='0' height='0' hidden='true' ></embed>");
						}

	print ("<table align='center' style='border:1; margin-top:2px' width='auto'>
				<tr>
					<td align='center' colspan='3' class='BorderInf'>
						QR CODES FOR EXPORT  ".$num3." 
						<br>
						IF > ".(($_SESSION['nuser']*2+6))." AUTO DELETE QR FILES
					</td>
				</tr>");

while($archivo = readdir($directorio)){
	if($archivo != ',' && $archivo != '.' && $archivo != '..'){
		print("<tr>
					<td class='BorderInfDch'>
						<form name='delete' action='$_SERVER[PHP_SELF]' method='post'>
							<input type='hidden' name='ruta' value='".$ruta.$archivo."'>
							<input type='submit' value='ELIMINAR' class='botonrojo' />
							<input type='hidden' name='delete' value='1' >
						</form>
					</td>
					<td class='BorderInfDch'>
						<form name='archivos' action='$_SERVER[PHP_SELF]' method='POST'>
							<input type='hidden' name='ruta' value='".$ruta.$archivo."'>
							<input type='hidden' name='downl' value='1' >
							<input type='submit' value='DESCARGAR' class='botonverde' />
						</form>
					</td>
					<td class='BorderInf'>".strtoupper($archivo)."</td>
				</tr>");
			}else{}
		} // FIN DEL WHILE
	}
	closedir($directorio);
	print("</table>");
}

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////
					
function delete(){
	global $a;
	$a = 1;
	unlink($_POST['ruta']);
	print("<embed src='../audi/deleteqr.mp3' autostart='true' loop='false' width='0' height='0' hidden='true' ></embed>");
}
	
				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////
					
	require '../Inclu/Admin_Inclu_02.php';

				   ////////////////////				   ////////////////////
////////////////////				////////////////////				////////////////////
				 ////////////////////				  ///////////////////

/* Creado por Juan Barros Pazos 2021 */

?>
