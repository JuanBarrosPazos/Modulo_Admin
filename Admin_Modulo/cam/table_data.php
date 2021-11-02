<?php

    global $ruta;
	global $docname;

    global $rutaimg;
    $rutaimg = "src='".$ruta."Users/".$rowu['ref']."/img_admin/".$rowu['myimg']."'";

	print("<table align='center'>
				<tr>
					<th colspan=3  class='BorderInf'>DATOS DEL USUARIO</th>
				</tr>
				<tr>
					<td style='text-align:right !important; width:120px;' >Nombre:</td>
					<td style='text-align:left !important; width:110px;'>".$rowu['Nombre']."</td>
					<td style='text-align:center !important;' rowspan='5' align='center'>
						<img ".$rutaimg." height='120px' width='90px' /></td>
				</tr>
				
				<tr>
					<td style='text-align:right !important;'>Apellidos: </td>
					<td style='text-align:left !important;'>".$rowu['Apellidos']."</td>
				</tr>				
				
				<tr>
					<td style='text-align:right !important;'>Tipo Documento: </td>
					<td style='text-align:left !important;'>".$rowu['doc']."</td>
				</tr>				
				
				<tr>
					<td style='text-align:right !important;'>N&uacute;mero: </td>
					<td style='text-align:left !important;'>".$rowu['dni']."</td>
				</tr>				
				
				<tr>
					<td style='text-align:right !important;'>Control: </td>
					<td style='text-align:left !important;'>".$rowu['ldni']."</td>
				</tr>				
				
				<tr>
					<td style='text-align:right !important;'>Mail: </td>
					<td style='text-align:left !important;' colspan='2'>".$rowu['Email']."</td>
				</tr>
				
				<tr>
					<td style='text-align:right !important;'>Tipo Usuario: </td>
					<td style='text-align:left !important;' colspan='2'>".$rowu['Nivel']."</td>
				</tr>
				
				<tr>
					<td style='text-align:right !important;'>User Ref: </td>
					<td style='text-align:left !important;' colspan='2'>".$rowu['ref']."</td>
				</tr>
				
				<tr>
					<td style='text-align:right !important;'>Usuario:</td>
					<td style='text-align:left !important;' colspan='2'>".$rowu['Usuario']."</td>
				</tr>
				
				<tr>
					<td style='text-align:right !important;'>Password: </td>
					<td style='text-align:left !important;' colspan='2'>".$rowu['Pass']."</td>
				</tr>
				
				<tr>
					<td style='text-align:right !important;'>Pais: </td>
					<td style='text-align:left !important;' colspan='2'>".$rowu['Direccion']."</td>
				</tr>
				
				<tr>
					<td style='text-align:right !important;'>Teléfono 1: </td>
					<td style='text-align:left !important;' colspan='2'>".$rowu['Tlf1']."</td>
				</tr>
				
				<tr>
					<td style='text-align:right !important;'>Teléfono 2: </td>
					<td style='text-align:left !important;' colspan='2'>".$rowu['Tlf2']."</td>
				</tr>

                <tr>
                    <td colspan=3 class='BorderSup' style='text-align: right !important;'>
                        <form name='closewindow' action='".$ruta.$docname."' />
                            <input type='submit' value='CANCELAR Y VOLVER' class='botonnaranja' />
                            <input type='hidden' name='cancel' value=1 />
                        </form>
                    </td>
                </tr>
            </table>"); 

?>