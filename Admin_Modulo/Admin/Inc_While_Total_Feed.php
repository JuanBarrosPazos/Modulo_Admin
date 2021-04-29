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

	print (	"<tr align='center'>

            <!-- AQUÍ VA LA CABECERA DEL FORMULARIO -->


				<td class='BorderInfDch'>
					".$rowb['Nivel']."
				</td>
							
				<td class='BorderInfDch'>
					".$rowb['ref']."
				</td>
							
				<td class='BorderInfDch'>
					".$rowb['Nombre']."
				</td>
							
				<td class='BorderInfDch'>
					".$rowb['Apellidos']."
				</td>
						
				<td class='BorderInfDch'>
	<img src='../Users/".$rowb['ref']."/img_admin/".$rowb['myimg']."' height='40px' width='30px' />
				</td>
												
													
				<td class='BorderInfDch'>
					".$rowb['Usuario']."
				</td>
						
				<td class='BorderInfDch'>
					".$rowb['Password']."
				</td>
						
			</tr>
			<tr>
					
        <!-- AQUÍ VA LA BOTONERA -->
	
		".$formularioh);

		require 'rowbtotal.php';

        print($formulariof.$formulariohg);

		require 'rowbtotal.php';

		print($formulariofg.$formulariohi);

		require 'rowbtotal.php';

		print($formulariofi."</tr>");

	 }  // FIN DEL WHILE

	    print("</table>");
			
			} 
		} 

?>