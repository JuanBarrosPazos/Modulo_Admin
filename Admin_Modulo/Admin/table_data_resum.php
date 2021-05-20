<?php
        if ($rf == ''){$rf = $_POST['ref'];}
        else { }
        if ($_POST['Pass'] == ''){ $pass = $_POST['Password'];}
        else { $pass = $_POST['Pass'];}

        print(" <tr>
					<td width=150px>Nombre:</td>
					<td width=200px>"
						.$_POST['Nombre'].
					"</td>
					<td rowspan='5' align='center'>
				<img ".$rutaimg." height='120px' width='90px' />
					</td>
				</tr>
				
				<tr>
					<td>Apellidos:</td>
					<td>".$_POST['Apellidos']."</td>
				</tr>				
				
				<tr>
					<td>Tipo Documento:</td>
					<td>".$_POST['doc']."</td>
				</tr>				
				
				<tr>
					<td>N&uacute;mero:</td>
					<td>".$_POST['dni']."</td>
				</tr>				
				
				<tr>
					<td>Control:</td>
					<td>".$_POST['ldni']."</td>
				</tr>				
				
				<tr>
					<td>Mail:</td>
					<td colspan='2'>".$_POST['Email']."</td>
				</tr>
				
				<tr>
					<td>Tipo Usuario</td>
					<td colspan='2'>".$_POST['Nivel']."</td>
				</tr>
				
				<tr>
					<td>Referencia Usuario</td>
					<td colspan='2'>".$rf."</td>
				</tr>
				
				<tr>
					<td>Usuario:</td>
					<td colspan='2'>".$_POST['Usuario']."</td>
				</tr>
				
				<tr>
					<td>Password:</td>
					<td colspan='2'>".$pass."</td>
				</tr>
				
				<tr>
					<td>Pais:</td>
					<td colspan='2'>".$_POST['Direccion']."</td>
				</tr>
				
				<tr>
					<td>Teléfono 1:</td>
					<td colspan='2'>".$_POST['Tlf1']."</td>
				</tr>
				
				<tr>
					<td>Teléfono 2:</td>
					<td colspan='2'>".$_POST['Tlf2']."</td>
				</tr>

             ");
?>