<?php

	print(" <table align='center' style=\"margin-top:2px\">
				<tr>
					<th colspan=2 class='BorderInf'>
							DATOS DEL NUEVO ADMINISTRADOR
					</th>
				</tr>
				
<form name='form_datos' method='post' action='$_SERVER[PHP_SELF]'  enctype='multipart/form-data'>
						
				<tr>
					<td width=180px>	
						<font color='#FF0000'>*</font>
						Ref User:
					</td>
					<td width=360px>
						SE GENERA LA CLAVE AUTOMÁTICAMENTE 
					</td>
				</tr>
					
				<tr>
					<td width=130px>	
						<font color='#FF0000'>*</font>
						Nombre:
					</td>
					<td width=280px>
		<input type='text' name='Nombre' size=28 maxlength=25 value='".$defaults['Nombre']."' />
					</td>
				</tr>
					
				<tr>
					<td>
						<font color='#FF0000'>*</font>
						Apellidos:
					</td>
					<td>
	<input type='text' name='Apellidos' size=28 maxlength=25 value='".$defaults['Apellidos']."' />
					</td>
				</tr>

				<tr>
					<td>
						<font color='#FF0000'>*</font>
						Tipo Documento:
					</td>
					<td>

	<select name='doc'>");

				foreach($doctype as $option => $label){
					print ("<option value='".$option."' ");
					if($option == $defaults['doc']){print ("selected = 'selected'");}
													print ("> $label </option>");
												}	
						
	print ("</select>
					</td>
				</tr>

				<tr>
					<td>
						<font color='#FF0000'>*</font>
						N&uacute;mero:
					</td>
					<td>
		<input type='text' name='dni' size=12 maxlength=8 value='".$defaults['dni']."' />
					</td>
				</tr>
				
				<tr>
					<td>
						<font color='#FF0000'>*</font>
						Control:
					</td>
					<td>
		<input type='text' name='ldni' size=4 maxlength=1 value='".$defaults['ldni']."' />
					</td>
				</tr>
				<tr>
					<td>
						<font color='#FF0000'>*</font>
						Mail:
					</td>
					<td>
		<input type='text' name='Email' size=52 maxlength=50 value='".$defaults['Email']."' />
					</td>
				</tr>	
				
				<tr>
					<td>
						<font color='#FF0000'>*</font>
						Nivel Usuario:
					</td>
					<td>
	
	<select name='Nivel'>");

		foreach($Nivel as $optionnv => $labelnv){
			print ("<option value='".$optionnv."' ");
			if($optionnv == $defaults['Nivel']){print ("selected = 'selected'");}
												print ("> $labelnv </option>");
										}	
						
	print ("</select>
					</td>
				</tr>
					
				<tr>
					<td>
						<font color='#FF0000'>*</font>
						Nombre Usuario:
					</td>
					<td>
		<input type='text' name='Usuario' size=12 maxlength=10 value='".$defaults['Usuario']."' />
					</td>
				</tr>
				<tr>
					<td>
						<font color='#FF0000'>*</font>
						Confirme Usuario:
					</td>
					<td>
		<input type='text' name='Usuario2' size=12 maxlength=10 value='".$defaults['Usuario2']."' />
					</td>
				</tr>
							
				<tr>
					<td>
						<font color='#FF0000'>*</font>
						Password:
					</td>
					<td>
		<input type='text' name='Password' size=12 maxlength=10 value='".$defaults['Password']."' />
					</td>
				</tr>

				<tr>
					<td>
						<font color='#FF0000'>*</font>
						Confirme Password:
					</td>
					<td>
	<input type='text' name='Password2' size=12 maxlength=10 value='".$defaults['Password2']."' />
					</td>
				</tr>

				<tr>
					<td>
						<font color='#FF0000'>*</font>
						Dirección:
					</td>
					<td>
	<input type='text' name='Direccion' size=52 maxlength=60 value='".$defaults['Direccion']."' />
					</td>
				</tr>
				
				<tr>
					<td>
						<font color='#FF0000'>*</font>
						Teléfono 1:
					</td>
					<td>
		<input type='text' name='Tlf1' size=12 maxlength=9 value='".$defaults['Tlf1']."' />
					</td>
				</tr>
				
				<tr>
					<tr>
					<td>
						&nbsp;&nbsp;&nbsp;Teléfono 2:
					</td>
					<td>
		<input type='text' name='Tlf2' size=12 maxlength=9 value='".$defaults['Tlf2']."' />
					</td>
				</tr>
				
				<tr>
					<td>
						<font color='#FF0000'>*</font>
						Fotografía:
					</td>
					<td>
		<input type='file' name='myimg' value='".@$defaults['myimg']."' />						
					</td>
				</tr>

				<tr>
					<td colspan='2'  align='right' valign='middle'  class='BorderSup'>
						<input type='submit' value='REGISTRARME CON ESTOS DATOS' class='botonverde' />
						<input type='hidden' name='oculto' value=1 />
						
					</td>
				</tr>
		</form>														
			</table>"); 


?>