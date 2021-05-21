<?php

	global $formularioh;
	$formularioh = "<td colspan=7 align='center' class='BorderInf'>
				<form style=\"display:inline-block;\" name='ver' action='Feedback_Ver_02.php' target='popup'method='POST' onsubmit=\"window.open('', 'popup', 'width=420px,height=550px,')\">";

	global $formulariof;
	$formulariof = "<input type='submit' value='VER DETALLES' class='botonverde' />
					<input type='hidden' name='oculto2' value=1 />
				</form>";

	global $formulariohg;
	$formulariohg = "<form style=\"display:inline-block;\" name='modifica' action='Feedback_Admin_Borrar_02.php' method='POST'>";

	global $formulariofg;
	$formulariofg = "<input type='submit' value='BORRAR DATOS EMPLEADO' class='botonrojo' />
					<input type='hidden' name='oculto2' value=1 />
				</form>";

	global $formulariohi;
	$formulariohi = "<form style=\"display:inline-block;\" name='modifica' action='Feedback_Admin_Recuperar_02.php' method='POST'>";

	global $formulariofi;
	$formulariofi = "<input type='submit' value='RECUPERAR BAJA' class='botonverde' />
					<input type='hidden' name='oculto2' value=1 />
				</form>
				</td>";

?>