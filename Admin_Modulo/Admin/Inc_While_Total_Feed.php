<?php

	if(!$qb){
			print("<font color='#FF0000'>
					Se ha producido un error: </font>".mysqli_error($db)."</br></br>");
					
			show_form();	
			
		} else {
			
			if(mysqli_num_rows($qb)== 0){
				print ("<table align='center' style=\"border:0px\">
						<tr><td align='center'>
							".$inicioadmincrear.$inicioadmin."<hr>
							<font color='#FF0000'>NO HAY DATOS</font>
						</td></tr></table>");

		} else { print ("<div class=\"juancentra\">
			".$twhile.": ".mysqli_num_rows($qb)."<hr>".$inicioadmin.$inicioadmincrear);
                                    
	while($rowb = mysqli_fetch_assoc($qb)){
    
    global $formularioh;
    global $formulariof;
	global $formulariohi;
	global $formulariofi;

	print (	"<hr><div class='whiletotalaimg'>
	<img src='../Users/".$rowb['ref']."/img_admin/".$rowb['myimg']."' style=\"height:34px; width:auto;\" />
				</div>
				<div class='whiletotala'>NOMBRE<br>".$rowb['Nombre']."</div>
				<div class='whiletotala'>APELLIDO<br>".$rowb['Apellidos']."</div>
				<br>
				<div class='whiletotala'>NIVEL<br>".$rowb['Nivel']."</div>
				<div class='whiletotala'>REF USER<br>".$rowb['ref']."</div>
				<div class='whiletotala'>USER<br>".$rowb['Usuario']."</div>
				<div class='whiletotala'>PASSWORD<br>".$rowb['Pass']."</div><br>
					
        <!-- AQUÍ VA LA BOTONERA -->
	
		".$formularioh);

		require 'rowbtotal.php';

        print($formulariof.$formulariohg);

		require 'rowbtotal.php';

		print($formulariofg.$formulariohi);

		require 'rowbtotal.php';

		print($formulariofi);

	 }  // FIN DEL WHILE

	    print("</div>");
			
			} 

	require 'Paginacion_Footter.php';

		} 

?>