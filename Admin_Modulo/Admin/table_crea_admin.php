<?php

	require 'Admin_Botonera.php';

	if (isset($modifadmin)){ 
		global $title;
		$title = "<img src='../Users/".$_SESSION['refcl']."/img_admin/".$_POST['myimg']."' height='44px' width='33px' />
					</br>MODIFIQUE LOS DATOS DEL ADMINISTRADOR";
		global $title2;
		$title2 = "<input name='ref' type='hidden' value='".$_SESSION['refcl']."' />".$defaults['ref'];
		global $title3;
		$title3 = "MODIFICAR DATOS USUARIO";
		global $title4;
		$title4 = "modifica";
		global $closewin;
		$closewin = "<tr><td colspan=3 style='text-align:right !important;' class='BorderSup BorderInf'>
			<form name='closewindow' action='$_SERVER[PHP_SELF]'  onsubmit=\"window.close()\">
				<input type='submit' value='CERRAR VENTANA' class='botonrojo' />
				<input type='hidden' name='closewin' value=1 />
			</form></td></tr>"; 
	}
	elseif (!isset($modifadmin)){ 
		global $title;
		$title = "DATOS DEL NUEVO ADMINISTRADOR";
		global $title2;
		$title2 = "SE GENERA LA CLAVE AUTOMÁTICAMENTE";
		global $title3;
		$title3 = "REGISTRARME CON ESTOS DATOS";
		global $title4;
		$title4 = "oculto";
		if(isset($config2)){ global $closewin;
							 $closewin = ""; }
		else { 	global $closewin;
				$closewin = "<tr><td colspan=3 style='text-align:center;' class='BorderInf'>".$inciobajas.$inicioadmin."</td></tr>";
					}
	 }

	print("<table style=\"margin-top:6px\">
				<tr>
					<th colspan=2 class='BorderInf'>".$title."</th>
				</tr>".$closewin."
				
		<form name='form_datos' method='post' action='$_SERVER[PHP_SELF]' enctype='multipart/form-data'>

			<input name='id' type='hidden' value='".@$defaults['id']."' />				
			<input name='myimg' type='hidden' value='".@$_POST['myimg']."' />					
						
				<tr>
					<td style='text-align:right !important; width:140px;' >	
						<font color='#FF0000'>*</font>
						Ref User:
					</td>
					<td style='text-align:left !important; width:290px;'>
						".$title2." 
					</td>
				</tr>
					
				<tr>
					<td style='text-align:right !important;'>	
						<font color='#FF0000'>*</font>
						Nombre:
					</td>
					<td style='text-align:left !important;'>
		<input type='text' name='Nombre' size=28 maxlength=25 value='".$defaults['Nombre']."' />
					</td>
				</tr>
					
				<tr>
					<td style='text-align:right !important;'>
						<font color='#FF0000'>*</font>
						Apellidos:
					</td>
					<td style='text-align:left !important;'>
	<input type='text' name='Apellidos' size=28 maxlength=25 value='".$defaults['Apellidos']."' />
					</td>
				</tr>

				<tr>
					<td style='text-align:right !important;'>
						<font color='#FF0000'>*</font>
						Documento:
					</td>
					<td style='text-align:left !important;'>");
	
	// INICIO SI ES USER O PLUS SE LIMITA EL FORMULARIO 
	if((@$_SESSION['Nivel'] == 'user') || (@$_SESSION['Nivel'] == 'plus')){ 

		print("	<input type='hidden' name='doc' value='".$defaults['doc']."' />".$defaults['doc']);

		}

	else { print("<select name='doc'>");
					foreach($doctype as $option => $label){
						print ("<option value='".$option."' ");
						if($option == $defaults['doc']){print ("selected = 'selected'");}
														print ("> $label </option>");
													}	
			print ("</select>");
		}
	// FIN SI ES USER O PLUS SE LIMITA EL FORMULARIO 

			print("</td>
				</tr>

				<tr>
					<td style='text-align:right !important;'>
						<font color='#FF0000'>*</font>
						N&uacute;mero:
					</td>
					<td style='text-align:left !important;'>");

		// INICIO SI ES USER O PLUS SE LIMITA EL FORMULARIO 
		if((@$_SESSION['Nivel'] == 'user') || (@$_SESSION['Nivel'] == 'plus')){

		print("<input type='hidden' name='dni' value='".$defaults['dni']."' />".$defaults['dni']);

		} else {
		
		print("<input type='text' name='dni' size=12 maxlength=8 value='".$defaults['dni']."' />");

		}
		// FIN SI ES USER O PLUS SE LIMITA EL FORMULARIO 

			print("</td>
				</tr>
				
				<tr>
					<td style='text-align:right !important;'>
						<font color='#FF0000'>*</font>
						Control:
					</td>
					<td style='text-align:left !important;'>");

		// INICIO SI ES USER O PLUS SE LIMITA EL FORMULARIO 
		if((@$_SESSION['Nivel'] == 'user') || (@$_SESSION['Nivel'] == 'plus')){

		print("<input type='hidden' name='ldni' value='".$defaults['ldni']."' />".$defaults['ldni']);

		} else {
		
		print("<input type='text' name='ldni' size=4 maxlength=1 value='".$defaults['ldni']."' />");

		}
		// FIN SI ES USER O PLUS SE LIMITA EL FORMULARIO 

		print("		</td>
				</tr>
				<tr>
					<td style='text-align:right !important;'>
						<font color='#FF0000'>*</font>
						Mail:
					</td>
					<td style='text-align:left !important;'>
		<input type='text' name='Email' size=42 maxlength=50 value='".$defaults['Email']."' placeholder='SOLO LETRAS MINUSCULAS'/>
					</td>
				</tr>	
				
				<tr>
					<td style='text-align:right !important;'>
						<font color='#FF0000'>*</font>
						Nivel:
					</td>
					<td style='text-align:left !important;'>");

	// INICIO SI ES USER O PLUS SE LIMITA EL FORMULARIO 
	if((@$_SESSION['Nivel'] == 'user') || (@$_SESSION['Nivel'] == 'plus')){ 

		print("<input type='hidden' name='Nivel' value='".$defaults['Nivel']."' />".$defaults['Nivel']);

		} else { print("<select name='Nivel'>");
						foreach($Nivel as $optionnv => $labelnv){
							print ("<option value='".$optionnv."' ");
							if($optionnv == $defaults['Nivel']){print ("selected = 'selected'");}
																print ("> $labelnv </option>");
														}	
				print ("</select>");
		}
	// FIN SI ES USER O PLUS SE LIMITA EL FORMULARIO 

			print("</td>
				</tr>
					
				<tr>
					<td style='text-align:right !important;'>
						<font color='#FF0000'>*</font>
						Usuario:
					</td>
					<td style='text-align:left !important;'>");

	// INICIO SI ES USER O PLUS SE LIMITA EL FORMULARIO 
	if((@$_SESSION['Nivel'] == 'user') || (@$_SESSION['Nivel'] == 'plus')){

	print("	<input type='hidden' name='Usuario' value='".$defaults['Usuario']."' />".$defaults['Usuario']."
				</td></tr>
			<input type='hidden' name='Usuario2' value='".$defaults['Usuario2']."' />");

	} else {
	print("<input type='text' name='Usuario' size=12 maxlength=10 value='".$defaults['Usuario']."' />
				</td></tr>
				<tr><td style='text-align:right !important;'><font color='#FF0000'>*</font>
						Conf. Usuario:
				</td><td style='text-align:left !important;'>
		<input type='text' name='Usuario2' size=12 maxlength=10 value='".$defaults['Usuario2']."' />
				</td></tr>");
		}
	// FIN SI ES USER O PLUS SE LIMITA EL FORMULARIO 

		print("<tr>
					<td style='text-align:right !important;'>
						<font color='#FF0000'>*</font>
						Password:
					</td>
					<td style='text-align:left !important;'>");

	// INICIO SI ES USER O PLUS SE LIMITA EL FORMULARIO 

	if((@$_SESSION['Nivel'] == 'user') || (@$_SESSION['Nivel'] == 'plus')){ 

		print("<input type='hidden' name='Password' value='".$defaults['Password']."' />".$defaults['Password']."
				</td></tr>
			<input type='hidden' name='Password2' value='".$defaults['Password2']."' />");
	} else { 
		print("<input type='text' name='Password' size=12 maxlength=10 value='".$defaults['Password']."' />
				</td></tr>
				<tr><td style='text-align:right !important;'><font color='#FF0000'>*</font>
						Conf. Password:
				</td><td style='text-align:left !important;'>
	<input type='text' name='Password2' size=12 maxlength=10 value='".$defaults['Password2']."' />
				</td></tr>");
		}
	// FIN SI ES USER O PLUS SE LIMITA EL FORMULARIO 

		print("	<tr>
					<td style='text-align:right !important;'>
						<font color='#FF0000'>*</font>
						Dirección:
					</td>
					<td style='text-align:left !important;'>
	<input type='text' name='Direccion' size=42 maxlength=60 value='".$defaults['Direccion']."' />
					</td>
				</tr>
				
				<tr>
					<td style='text-align:right !important;'>
						<font color='#FF0000'>*</font>
						Teléfono 1:
					</td>
					<td style='text-align:left !important;'>
		<input type='text' name='Tlf1' size=12 maxlength=9 value='".$defaults['Tlf1']."' />
					</td>
				</tr>
				
				<tr>
					<tr>
					<td style='text-align:right !important;'>
						Teléfono 2:
					</td>
					<td style='text-align:left !important;'>
		<input type='text' name='Tlf2' size=12 maxlength=9 value='".$defaults['Tlf2']."' />
					</td>
				</tr>");
		 
		global $imgform;
		if($imgform == "config2") {

		print("	<tr>
					<td style='text-align:right !important;'>
						<font color='#FF0000'>*</font>
						Fotografía:
					</td>
					<td style='text-align:left !important;'>
		<input type='file' name='myimg' value='".@$defaults['myimg']."' />						
					</td>
				</tr>");
			} else { }	

	print("	<tr>
				<td colspan='2' style='text-align:right !important;' class='BorderSup BorderInf'>
					<input type='submit' value='".$title3."' class='botonverde' />
					<input type='hidden' name='".$title4."' value=1 />
				</td>
			</tr>
				</form>".$closewin."
		</table>"); 

?>