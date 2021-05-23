<?php

global $ruta;

print("<table align='center' style='margin-top:10px' width=450px >
		<tr>
			<th class='BorderInf'>
                <b><font color='#FF0000'>
                    NO EXISTE EL USUARIO.
                    </br>
                    PONGASE EN CONTACTO CON ADMIN SYSTEM.
                </font></b>
			</th>
		 </tr>
		 <tr>
			<td valign='middle'  align='center'>
				<form name='cancel' action='".$ruta."index.php' >
						<input type='submit'  value='CANCELAR Y VOLVER' class='botonnaranja' />
				</form>
			</td>
		</tr>
	</table>
	<embed src='".$ruta."audi/user_lost.mp3' autostart='true' loop='false' width='0' height='0' hidden='true' >
	</embed>");

?>