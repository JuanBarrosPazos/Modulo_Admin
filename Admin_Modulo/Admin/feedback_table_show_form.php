<?php

print("	<tr>
			<td style='text-align:right !important; width:120px'>Ref. User: </td>
			<td style='text-align:left !important; width:100px'>".$defaults['ref']."</td>
			<td rowspan=5 width=94px>
<img src='../Users/".$_SESSION['sref']."/img_admin/".$defaults['myimg']."' height='120px' width='90px' />
			</td>
		</tr>
		<tr>
			<td style='text-align:right !important;'>Nombre: </td>
			<td style='text-align:left !important;'>".$defaults['Nombre']."</td>
		</tr>
		<tr>
			<td style='text-align:right !important;'>Apellidos: </td>
			<td style='text-align:left !important;'>".$defaults['Apellidos']."</td>
		</tr>
        <tr>
			<td style='text-align:right !important;'>Documento: </td>
			<td style='text-align:left !important;'>".$defaults['doc']."</td>
		</tr>
		<tr>
			<td style='text-align:right !important;'>N&uacute;mero: </td>
			<td style='text-align:left !important;'>".$defaults['dni']."</td>
		</tr>
		<tr>
			<td style='text-align:right !important;'>Control: </td>
			<td style='text-align:left !important;' colspan=2>".$defaults['ldni']."</td>
		</tr>
		<tr>
			<td style='text-align:right !important;'>Mail: </td>
			<td style='text-align:left !important;' colspan=2>".$defaults['Email']."</td>
		</tr>	
		<tr>
			<td style='text-align:right !important;'>Nivel: </td>
			<td style='text-align:left !important;' colspan=2>".$defaults['Nivel']."</td>
		</tr>
		<tr>
			<td style='text-align:right !important;'>Usuario:</td>
			<td style='text-align:left !important;' colspan=2>".$defaults['Usuario']."</td>
		</tr>
		<tr>
			<td style='text-align:right !important;'>Password: </td>
			<td style='text-align:left !important;' colspan=2>".$defaults['Pass']."</td>
		</tr>
        <tr>
			<td style='text-align:right !important;'>Dirección: </td>
			<td style='text-align:left !important;' colspan=2>".$defaults['Direccion']."</td>
		</tr>
		<tr>
			<td style='text-align:right !important;'>Teléfono 1: </td>
			<td style='text-align:left !important;' colspan=2>".$defaults['Tlf1']."</td>
		</tr>
		<tr>
			<td style='text-align:right !important;'>Teléfono 2: </td>
			<td style='text-align:left !important;' colspan=2>".$defaults['Tlf2']."</td>
		</tr>
		<tr>
			<td style='text-align:right !important;'>Last In: </td>
			<td style='text-align:left !important;' colspan=2>".$defaults['lastin']."</td>
		</tr>
		<tr>
			<td style='text-align:right !important;'>Last Out: </td>
			<td style='text-align:left !important;' colspan=2>".$defaults['lastout']."</td>
		</tr>
		<tr>
			<td style='text-align:right !important;'>Visitas: </td>
			<td style='text-align:left !important;' colspan=2>".$defaults['visitadmin']."</td>
		</tr>");

?>