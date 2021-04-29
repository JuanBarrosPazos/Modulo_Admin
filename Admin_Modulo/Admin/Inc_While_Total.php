<?php

	if(!$qb){
			print("<font color='#FF0000'>
					Se ha producido un error: </font>".mysqli_error($db)."</br></br>");
					
			show_form();	
			
		} else {
			
			if(mysqli_num_rows($qb)== 0){
							print ("<table align='center' style=\"border:0px\">
										<tr>
											<td align='center'>
												<font color='#FF0000'>
													NO HAY DATOS
												</font>
											</td>
										</tr>
									</table>");

				} else { 	print ("<table align='center'>
									<tr>
										<th colspan=7 class='BorderInf'>
					".$twhile.": ".mysqli_num_rows($qb).".
										</th>
									</tr>
									
									<tr>
										<th class='BorderInfDch'>
											Nivel
										</th>
										
										<th class='BorderInfDch'>
											Referencia
										</th>
										
										<th class='BorderInfDch'>
											Nombre
										</th>
										
										<th class='BorderInfDch'>
											Apellidos
										</th>
										
										<th class='BorderInfDch'>
											
										</th>
										
										<th class='BorderInfDch'>
											Usuario
										</th>
										
										<th class='BorderInfDch'>
											Password
										</th>
										
                                    </tr>");
                                    
	while($rowb = mysqli_fetch_assoc($qb)){
    
    global $formularioh;
    global $formulariof;
	global $formulariohi;
	global $formulariofi;
	global $formulariohe;
	global $formulariofe;

	print (	"<tr align='center'>".$formularioh."

            <!-- AQUÍ VA LA CABECERA DEL FORMULARIO -->

	<input name='id' type='hidden' value='".$rowb['id']."' />
						
				<td class='BorderInfDch'>
	<input name='Nivel' type='hidden' value='".$rowb['Nivel']."' />".$rowb['Nivel']."
				</td>
							
				<td class='BorderInfDch'>
	<input name='ref' type='hidden' value='".$rowb['ref']."' />".$rowb['ref']."
				</td>
							
				<td class='BorderInfDch'>
	<input name='Nombre' type='hidden' value='".$rowb['Nombre']."' />".$rowb['Nombre']."
				</td>
							
				<td class='BorderInfDch'>
	<input name='Apellidos' type='hidden' value='".$rowb['Apellidos']."' />".$rowb['Apellidos']."
				</td>
						
				<td class='BorderInfDch'>
	<input name='myimg' type='hidden' value='".$rowb['myimg']."' />
	<img src='../Users/".$rowb['ref']."/img_admin/".$rowb['myimg']."' height='40px' width='30px' />
				</td>
												
	<input name='doc' type='hidden' value='".$rowb['doc']."' />
	<input name='dni' type='hidden' value='".$rowb['dni']."' />
	<input name='ldni' type='hidden' value='".$rowb['ldni']."' />
	<input name='Email' type='hidden' value='".$rowb['Email']."' />
													
				<td class='BorderInfDch'>
	<input name='Usuario' type='hidden' value='".$rowb['Usuario']."' />".$rowb['Usuario']."
				</td>
						
				<td class='BorderInfDch'>
	<input name='Password' type='hidden' value='".$rowb['Password']."' />".$rowb['Password']."
				</td>
						
	<input name='Direccion' type='hidden' value='".$rowb['Direccion']."' />
	<input name='Tlf1' type='hidden' value='".$rowb['Tlf1']."' />
	<input name='Tlf2' type='hidden' value='".$rowb['Tlf2']."' />
	<input name='lastin' type='hidden' value='".$rowb['lastin']."' />
	<input name='lastout' type='hidden' value='".$rowb['lastout']."' />
	<input name='visitadmin' type='hidden' value='".$rowb['visitadmin']."' />
	<input name='myqr' type='hidden' value='".$rowb['myqr']."' />
			</tr>
					
        <!-- AQUÍ VA LA BOTONERA -->

            ".$formulariof.$formulariohg."

		");

		require 'rowbtotal.php';

		print($formulariofg.$formulariohi);

		require 'rowbtotal.php';

		print($formulariofi.$formulariohe);

		require 'rowbtotal.php';

		print($formulariofe."</tr>");
                    
	 }  // FIN DEL WHILE

	    print("</table>");
			
			} 
		} 

?>