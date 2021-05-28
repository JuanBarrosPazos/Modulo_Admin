<?php
	global $formularioh;
	$formularioh = "<td colspan=7 align='center' class='BorderInf'>
	<form style=\"display:inline-block;\" name='ver' action='".@$ruta."Admin_Ver_02.php' target='popup' method='POST' onsubmit=\"window.open('', 'popup', 'width=380px,height=500px')\">";

	global $formulariof;
	$formulariof = "<input type='submit' value='VER DETALLES' class='botonverde' />
					<input type='hidden' name='oculto2' value=1 />
					</form>";

	global $formulariohg;
	$formulariohg = "<form style=\"display:inline-block;\" name='modifica_img' action='".@$ruta."Admin_Modificar_img.php' target='popup' method='POST' onsubmit=\"window.open('', 'popup',  'width=380px,height=380px')\">";

	global $formulariofg;
	$formulariofg = "<input type='submit' value='MODIFICAR IMAGEN' class='botonnaranja' />
					 <input type='hidden' name='oculto2' value=1 />
						</form>";

	global $formulariohi;
	$formulariohi = "<form style=\"display:inline-block;\" name='modifica' action='".@$ruta."Admin_Modificar_02.php' method='POST' target='popup' onsubmit=\"window.open('', 'popup', 'width=680px,height=480px')\">";

	global $formulariofi;
	$formulariofi = "<input type='submit' value='MODIFICAR DATOS' class='botonnaranja' />
					<input type='hidden' name='oculto2' value=1 />
					</form>";

	if($_SESSION['Nivel'] == 'admin'){

	global $formulariohe;
	$formulariohe = "<form style=\"display:inline-block;\" name='borra' action='".@$ruta."Admin_Borrar_02.php' method='POST'>";

	global $formulariofe;
	$formulariofe = "<input type='submit' value='DAR DE BAJA' class='botonrojo' />
					<input type='hidden' name='oculto2' value=1 />
					</form>
					</td>";
	} else {	
		global $formulariohe;
		$formulariohe = "";
			
		global $formulariofe;
		$formulariofe = "</td>";
		}
	


?>