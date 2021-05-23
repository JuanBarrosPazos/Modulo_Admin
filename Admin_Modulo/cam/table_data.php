<?php

    global $ruta;
    
    global $rutaimg;
    $rutaimg = "src='".$ruta."Users/".$rowu['ref']."/img_admin/".$rowu['myimg']."'";

	print("<table align='center'>
				<tr>
					<th colspan=3  class='BorderInf'>DATOS DEL USUARIO</th>
				</tr>
				<tr>
					<td width=150px>Nombre:</td>
					<td width=200px>".$rowu['Nombre']."</td>
					<td rowspan='5' align='center'><img ".$rutaimg." height='120px' width='90px' /></td>
				</tr>
				
				<tr>
					<td>Apellidos:</td>
					<td>".$rowu['Apellidos']."</td>
				</tr>				
				
				<tr>
					<td>Tipo Documento:</td>
					<td>".$rowu['doc']."</td>
				</tr>				
				
				<tr>
					<td>N&uacute;mero:</td>
					<td>".$rowu['dni']."</td>
				</tr>				
				
				<tr>
					<td>Control:</td>
					<td>".$rowu['ldni']."</td>
				</tr>				
				
				<tr>
					<td>Mail:</td>
					<td colspan='2'>".$rowu['Email']."</td>
				</tr>
				
				<tr>
					<td>Tipo Usuario</td>
					<td colspan='2'>".$rowu['Nivel']."</td>
				</tr>
				
				<tr>
					<td>Referencia Usuario</td>
					<td colspan='2'>".$rowu['ref']."</td>
				</tr>
				
				<tr>
					<td>Usuario:</td>
					<td colspan='2'>".$rowu['Usuario']."</td>
				</tr>
				
				<tr>
					<td>Password:</td>
					<td colspan='2'>".$rowu['Pass']."</td>
				</tr>
				
				<tr>
					<td>Pais:</td>
					<td colspan='2'>".$rowu['Direccion']."</td>
				</tr>
				
				<tr>
					<td>Teléfono 1:</td>
					<td colspan='2'>".$rowu['Tlf1']."</td>
				</tr>
				
				<tr>
					<td>Teléfono 2:</td>
					<td colspan='2'>".$rowu['Tlf2']."</td>
				</tr>

                <tr>
                    <td colspan=3 class='BorderSup' style='text-align: right !important;'>
                        <form name='closewindow' action='".$ruta."index.php' />
                            <input type='submit' value='CANCELAR Y VOLVER' class='botonnaranja' />
                            <input type='hidden' name='cancel' value=1 />
                        </form>
                    </td>
                </tr>
            </table>"); 

?>