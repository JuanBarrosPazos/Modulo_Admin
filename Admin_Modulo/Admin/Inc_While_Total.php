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
									<font color='#FF0000'>NO HAY DATOS</font>
								</td>
							</tr>
						</table>");
		} else { global $page;
				 if ($page >= 1){ } 
				 else { $page = 1;}

			if(isset($_POST['ocultoc'])){

				$defaults['Nombre'] = $_POST['Nombre'];
				$defaults['Apellidos'] = $_POST['Apellidos'];
				global $refrescaimg;
				$refrescaimg = "<form name='refresimg' action='".$ruta."Admin_Ver.php' method='POST'>
					<input type='hidden' name='Nombre' value='".@$defaults['Nombre']."' />
					<input type='hidden' name='Apellidos' value='".@$defaults['Apellidos']."' />
					<input type='submit' value='REFRESCAR VISTA IMAGENES' />
					<input type='hidden' name='ocultoc' value=1 />
								</form>";
			} else { global $refrescaimg;
					 $refrescaimg = "<form name='refresimg' action='".$ruta."Admin_Ver.php'>
										<input type='submit' value='REFRESCAR VISTA IMAGENES' />
										<input type='hidden' name='page' value=".$page." />
									 </form>";
					}

			print ("<table align='center'>
						<tr>
								<th colspan=7 class='BorderInf'>
					".$twhile.": ".mysqli_num_rows($qb).".".$refrescaimg."
								</th>
						</tr>
						<tr>
							<th class='BorderInfDch'>Nivel</th>
							<th class='BorderInfDch'>Referencia</th>
							<th class='BorderInfDch'>Nombre</th>
							<th class='BorderInfDch'>Apellidos</th>
							<th class='BorderInfDch'></th>
							<th class='BorderInfDch'>Usuario</th>
							<th class='BorderInfDch'>Password</th>
                        </tr>");
                                    
	while($rowb = mysqli_fetch_assoc($qb)){
    
		global $formularioh;
		global $formulariof;
		global $formulariohi;
		global $formulariofi;
		global $formulariohe;
		global $formulariofe;

	print (	"<tr align='center'>

        <!-- AQUÍ VA LA CABECERA DEL FORMULARIO -->
				<td class='BorderInfDch'>".$rowb['Nivel']."</td>
				<td class='BorderInfDch'>".$rowb['ref']."</td>
				<td class='BorderInfDch'>".$rowb['Nombre']."</td>
				<td class='BorderInfDch'>".$rowb['Apellidos']."</td>
				<td class='BorderInfDch'>
	<img src='".$rutaimg.$rowb['ref']."/img_admin/".$rowb['myimg']."' height='40px' width='30px' />
				</td>
				<td class='BorderInfDch'>".$rowb['Usuario']."</td>
				<td class='BorderInfDch'>".$rowb['Pass']."</td>
			</tr>
			<tr>
        <!-- AQUÍ VA LA BOTONERA -->
	
		".$formularioh);

		require 'rowbtotal.php';

			print($formulariof.$formulariohg);

		require 'rowbtotal.php';

			print($formulariofg.$formulariohi);

		if ($_SESSION['Nivel'] == 'admin') { 

			require 'rowbtotal.php';
		
		} else { }

			print($formulariofi.$formulariohe);

		require 'rowbtotal.php';

			print($formulariofe."</tr>");
                    
	 }  // FIN DEL WHILE

	    print("</table>");
			
			} 

	require 'Paginacion_Footter.php';
	
		} 

?>