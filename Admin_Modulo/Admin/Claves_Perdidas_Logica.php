<?php

	if(isset($_POST['oculto'])){
		if($form_errors = validate_form()){
			print("<table align='center'>
						<tr>
							<td>
								<font color='#FF0000'>
									NO SE HA ENVIADO EL FORMULARIO.
								</font>
							</td>
						</tr>
						<tr>
							<td align='center'>
			<a href='http://juanbarrospazos.blogspot.com.es/' target='_blank'>
					Contactos Juan Barros
			</a>
							</td>
						</tr>
					</table>");
												
			show_form($form_errors);
										
		} else {print("<table align='center' style=\"margin-top:20px\">
							<tr>
								<td>
									<font color='#0080C0'>
										SE HA PROCESADO SU PETICION CORRECTAMENTE.
									</font>
								</td>
							</tr>
							<tr>
								<td>
									<font color='#0080C0'>
										PULSE ENVIAR PARA RECIBIR SUS DATOS VIA MAIL.
									</font>
								</td>
							</tr>
						</table>
<embed src='../audi/claves_lost_2.mp3' autostart='true' loop='false' width='0' height='0' hidden='true' >
</embed>");
											
		process_form();
							}
					}	/* Fin del if $_POST['oculto']*/
										
			else {show_form();}
												
	if(isset($_POST['oculto2'])){	process_Mail();
							unset($_SESSION['']);
											}

?>