<?php

	if(!$qb){
			print("<font color='#FF0000'>
					Se ha producido un error: </font>".mysqli_error($db)."</br></br>");
					
			show_form();	
			
	} else {
			
		if(mysqli_num_rows($qb)== 0){
				print ("<table style=\"text-align:center; border:0px;\">
							<tr>
								<td>
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
					<input type='submit' value='REFRESCAR DESPUES DE MODIFICAR DATOS' class='botonazul' />
					<input type='hidden' name='ocultoc' value=1 />
								</form>";
			} else { global $refrescaimg;
					 $refrescaimg = "<form name='refresimg' action='".$ruta."Admin_Ver.php'>
						<input type='submit' value='REFRESCAR DESPUES DE MODIFICAR DATOS' class='botonazul' />
						<input type='hidden' name='page' value=".$page." />
								</form>";
					}

	print ("<div class=\"juancentra\" style=\"\">
			<!--".$twhile.": ".mysqli_num_rows($qb).".-->".$refrescaimg);
                                    
	while($rowb = mysqli_fetch_assoc($qb)){
    
		global $formularioh;
		global $formulariof;
		global $formulariohi;
		global $formulariofi;
		global $formulariohe;
		global $formulariofe;

	print (	"<hr><div class='whiletotalaimg'>
	<img src='".$rutaimg.$rowb['ref']."/img_admin/".$rowb['myimg']."' style=\"height:34px; width:auto;\" />
				</div>
				<div class='whiletotala'>NOMBRE<br>".$rowb['Nombre']."</div>
				<div class='whiletotala'>APELLIDO<br>".$rowb['Apellidos']."</div>
				<br>
				<div class='whiletotala'>NIVEL<br>".$rowb['Nivel']."</div>
				<div class='whiletotala'>REF USER<br>".$rowb['ref']."</div>
				<div class='whiletotala'>USER<br>".$rowb['Usuario']."</div>
				<div class='whiletotala'>PASS<br>".$rowb['Pass']."</div><br>
				
        <!-- AQUÍ VA LA BOTONERA -->
	
		".$formularioh);

		require 'rowbtotal.php';

			print($formulariof.$formulariohg);

		require 'rowbtotal.php';

			print($formulariofg.$formulariohi);

		require 'rowbtotal.php';
		
			print($formulariofi.$formulariohe);

		require 'rowbtotal.php';

			print($formulariofe);
                    
	}  // FIN DEL WHILE

	    print("</div>");
			
			} 

	require 'Paginacion_Footter.php';
	
		} 

?>